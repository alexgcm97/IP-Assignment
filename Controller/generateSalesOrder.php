<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generateSalesOrder
 *
 * @author Goh Chun Ming
 */
require '../Model/OrdersDB.php';
require '../Model/Orders.php';
require '../Model/Customer.php';

function generateSalesOrder($orderID) {
    $db = new OrdersDB();
    $result = $db->retrieveOrder($orderID);
    $order = new Orders($result['orderID'], $result['orderDate'], $result['custID'], $result['shipMethod'], $result['shipAddress'], $result['shipDate'], $result['shipTime'], $result['grandTotal']);
    $result = $db->retrieveCustomer($order->getCustID());
    $customer = new Customer($result['custID'], $result['custType'], $result['custName'], $result['custEmail'], $result['creditLimit'], $result['creditBalance'], $result['creditStatus']);

    $result = $db->retrieveOrderDetails($order->getOrderID());
    foreach ($result as $row) {
        $od = new OrderDetails($row['orderID'], $row['productID'], $row['name'], $row['description'], $row['price'], $row['quantity'], $row['totalAmount']);
        $order->addODToList($od);
    }

    $dom = new DOMDocument();
    if (file_exists("../xml/SalesOrder.xml")) {
        $dom->load("../xml/SalesOrder.xml");
    } else {
        $imp = new DOMImplementation();
        $dtd = $imp->createDocumentType('SalesOrder', '', 'SalesOrder.dtd');
        $dom->appendChild($dtd);
        $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="SalesOrder.xsl"');
        $dom->appendChild($xslt);
        $dom->appendChild($dom->createElement("SalesOrder"));
    }
    $root = $dom->documentElement;
    while ($root->hasChildNodes()) {
        $root->removeChild($root->firstChild);
    }

    $root->appendChild($newNode = $dom->createElement("orderID", $order->getOrderID()));
    $date = $order->getOrderDate();
    $date = date("d F Y", strtotime($date));
    $root->appendChild($dom->createElement("orderDate", $date));
    $date = $order->getShipDate();
    $date = date("d F Y", strtotime($date));
    $root->appendChild($dom->createElement("shipDate", $date));
    $time = $order->getShipTime();
    $time = date("h:i a", strtotime($time));
    $root->appendChild($dom->createElement("shipTime", $time));
    $root->appendChild($dom->createElement("shipMethod", $order->getShipMethod()));
    $to = $dom->createElement("to");
    $to->appendChild($dom->createElement("custName", $customer->getCustName()));
    $to->appendChild($dom->createElement("custEmail", $customer->getCustEmail()));
    $to->appendChild($dom->createElement("shipAddress", $order->getShipAddress()));
    $root->appendChild($to);
    $index = 1;
    foreach ($order->getAllOD() as $od) {
        $product = $dom->createElement("product");
        $product->appendChild($dom->createElement("no", $index));
        $product->appendChild($dom->createElement("name", $od->getName()));
        $product->appendChild($dom->createElement("description", $od->getDescription()));
        $product->appendChild($dom->createElement("price", $od->getPrice()));
        $product->appendChild($dom->createElement("quantity", $od->getQuantity()));
        $product->appendChild($dom->createElement("totalAmount", $od->getTotalAmount()));
        $root->appendChild($product);
        $index++;
    }
    $root->appendChild($dom->createElement("grandTotal", $order->getGrandTotal()));

    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->save('../xml/SalesOrder.xml');
}

?>