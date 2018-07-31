<?php

require "Database.php";

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author Chun Ming
 */
class OrdersDB {

    private $db;

    function __construct() {
        $this->db = Database::getInstance();
        Database::setCharsetEncoding();
    }

    function retrieveCatalog() {
        try {
            $db = $this->db;
            $date = date('F Y');
            $sql_query = "SELECT c.catalogID, p.productID, p.name, p.description, p.price, p.status, pc.type from product p, catalog c, pdt_catalog pc where c.date = '$date'"
                    . " AND c.catalogID = pc.catalogID AND pc.productID = p.productID";
            $stm = $db->prepare($sql_query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function getLastOrderID() {
        try {
            $db = $this->db;
            $sql_query = "SELECT orderID from orders ORDER BY orderID DESC LIMIT 1";
            $stm = $db->prepare($sql_query);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function retrieveCustomer($custID) {
        try {
            $db = $this->db;
            $sql_query = "SELECT * from customer WHERE custID = '$custID'";
            $stm = $db->prepare($sql_query);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function insertOrder($order) {
        try {
            $db = $this->db;
            $sql = "INSERT INTO orders (orderID, orderDate, custID, shipMethod, shipAddress, shipDate, shipTime, grandTotal) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($order->getOrderID(), $order->getOrderDate(), $order->getCustID(), $order->getShipMethod(), $order->getShipAddress(), $order->getShipDate(), $order->getShipTime(), $order->getGrandTotal());
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    function insertOD($od) {
        try {
            $db = $this->db;
            $sql = "INSERT INTO orderdetails (orderID, orderDate, custID, shipMethod, shipAddress, shipDate, shipTime, grandTotal) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($order->getOrderID(), $order->getOrderDate(), $order->getCustID(), $order->getShipMethod(), $order->getShipAddress(), $order->getShipDate(), $order->getShipTime(), $order->getGrandTotal());
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

}
