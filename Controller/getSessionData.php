<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of getSessionData
 *
 * @author Goh Chun Ming
 */
require '../Model/Orders.php';
require '../Model/OrdersDB.php';
require '../Model/Customer.php';

function startSession() {
    mb_http_output('UTF-8');
    session_start();
    $db = new OrdersDB();

    if (!isset($_SESSION['order'])) {
        $date = date('d-m-Y');
        if (!empty($_POST['custID']) and ! empty($_POST['password'])) {
            $custID = $_POST['custID'];
            $password = $_POST['password'];
            $result = $db->retrieveCustomerWithPW($custID, $password);
            if (isset($result)) {
                $customer = new Customer($result['custID'], $result['custType'], $result['custName'], $result['custEmail'], $result['creditLimit'], $result['creditBalance'], $result['creditStatus']);
                $customer->setPassword($password);
                $_SESSION['customer'] = $customer;
                if (!empty($_SESSION['customer']->getCustID())) {
                    $result = $db->getLastOrderID();
                    if (empty($result)) {
                        $orderID = 1001;
                    } else {
                        $orderID = $result['orderID'];
                        $orderID++;
                    }
                    $custID = $customer->getCustID();
                    $_SESSION['order'] = new Orders($orderID, $date, $custID, 0, null, null, null, 0);
                }
            }
        } else {
            header("Location: ../View/index.php");
        }
    }
}

?>