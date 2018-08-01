<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../Model/Orders.php';
require '../Model/OrdersDB.php';
require '../Model/Customer.php';

function startSession() {
    session_start();
    $db = new OrdersDB();

    if (!isset($_SESSION['order'])) {
        $date = date('d-m-Y');
        if (!empty($_POST['custID'])) {
            $custID = $_POST['custID'];
            $result = $db->retrieveCustomer($custID);
            $_SESSION['customer'] = new Customer($result['custID'], $result['custType'], $result['custName'], $result['custEmail'], $result['creditLimit'], $result['creditBalance'], $result['creditStatus']);
            $customer = $_SESSION['customer'];
            if (!empty($customer)) {
                $result = $db->getLastOrderID();
                if (empty($result['orderID'])) {
                    $orderID = '1001';
                } else {
                    $orderID = $result['orderID'];
                    $orderID++;
                }
                $custID = $customer->getCustID();
                $_SESSION['order'] = new Orders($orderID, $date, $custID, 0, null, null, null, 0);
            }
        } else {
            header("Location: ../View/index.php");
        }
    }
}

?>