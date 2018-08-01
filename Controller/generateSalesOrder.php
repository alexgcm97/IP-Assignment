<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of orderCatalog
 *
 * @author Chun Ming
 */
require '../Model/Database.php';
require '../Model/product.php';
$date = date('F Y');

$db = Database::getInstance();
$mysqli = $db->getConnection();
$sql_query = "SELECT p.productID, p.name, p.description, p.price from product p, catalog c, pdt_catalog pc where c.date = '$date'"
        . " AND c.catalogID = pc.catalogID AND pc.productID = p.productID";
$result = $mysqli->query($sql_query);
$row = mysqli_fetch_row($result);

$dom = new DOMDocument();
if (file_exists("../xml/SalesOrder.xml")) {
    $dom->load("../xml/SalesOrder.xml");
} else {
    $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="SalesOrder.xsl"');
    $dom->appendChild($xslt);
    $dom->appendChild($dom->createElement("SalesOrder"));
}
$root = $dom->documentElement;
while ($root->hasChildNodes()) {
    $root->removeChild($root->firstChild);
}

foreach ($result as $row) {
    $temp = new product(null, null, null, null, null);
    foreach ($row as $column => $data) {
        switch ($column) {
            case 'productID':
                $temp->setProductID($data);
                break;
            case 'name':
                $temp->setName($data);
                break;
            case 'description':
                $temp->setDescription($data);
                break;
            case 'price':
                $temp->setPrice($data);
                break;
        }
    }
    $productList[] = $temp;
}

for ($i = 0; $i < sizeof($productList); $i++) {
    $newNode = $dom->createElement("product");
    $newNode->appendChild($dom->createElement("id", $productList[$i]->getProductID()));
    $newNode->appendChild($dom->createElement("name", $productList[$i]->getName()));
    $newNode->appendChild($dom->createElement("description", $productList[$i]->getDescription()));
    $newNode->appendChild($dom->createElement("price", $productList[$i]->getPrice()));
    $root->appendChild($newNode);
}

$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->save('../xml/SalesOrder.xml');
?>