<?php

require "Database.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrdersDB
 *
 * @author Goh Chun Ming
 */
class OrdersDB {

    private $db;

    function __construct() {
        $this->db = Database::getInstance();
        Database::setCharsetEncoding();
    }

    function retrieveCatalog($date) {
        try {
            $db = $this->db;
            $sql = "SELECT c.catalogID, p.productID, p.name, p.description, p.price, p.status, pc.type from product p, catalog c, pdt_catalog pc where c.date = '$date'"
                    . " AND c.catalogID = pc.catalogID AND pc.productID = p.productID";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function getLastOrderID() {
        try {
            $db = $this->db;
            $sql = "SELECT orderID from orders ORDER BY orderID DESC LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveCustomer($custID) {
        try {
            $db = $this->db;
            $sql = "SELECT * from customer WHERE custID = $custID";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveCustomerWithPW($custID, $password) {
        try {
            $db = $this->db;
            $sql = "SELECT * from customer WHERE custID = $custID AND password = '$password'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveCustomerOrders($custID) {
        try {
            $db = $this->db;
            $sql = "SELECT * from customer c, orders o WHERE c.custID = $custID AND o.custID = c.custID";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveCustomerOrdersWithDate($custID, $date) {
        try {
            $db = $this->db;
            $sql = "SELECT * from customer c, orders o WHERE c.custID = $custID AND o.custID = c.custID AND orderDate LIKE '%$date%'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function insertOrder($order) {
        try {
            $db = $this->db;
            $sql = "INSERT INTO orders (orderID, orderDate, custID, shipMethod, shipAddress, shipDate, shipTime, grandTotal) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($order->getOrderID(), $order->getOrderDate(), $order->getCustID(), $order->getShipMethod(), $order->getShipAddress(), $order->getShipDate(), $order->getShipTime(), $order->getGrandTotal()));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function insertOD($od) {
        try {
            $db = $this->db;
            $sql = "INSERT INTO orderdetails (orderID, productID, name, description, price, quantity, totalAmount) VALUES (?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($od->getOrderID(), $od->getProductID(), $od->getName(), $od->getDescription(), $od->getPrice(), $od->getQuantity(), $od->getTotalAmount()));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function updateCreditBalance($customer) {
        try {
            $db = $this->db;
            $custID = $customer->getCustID();
            $sql = "UPDATE customer SET creditBalance = ? , creditStatus = ? WHERE custId = $custID";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($customer->getCreditBalance(), $customer->getCreditStatus()));
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveOrder($orderID) {
        try {
            $db = $this->db;
            $sql = "SELECT * from orders WHERE orderID = $orderID";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveOrderDetails($orderID) {
        try {
            $db = $this->db;
            $sql = "SELECT * from orderDetails WHERE orderID = $orderID";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

}
