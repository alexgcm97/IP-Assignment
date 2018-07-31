<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Completed</title>
    </head>
    <body>
        <?php
        require '../Controller/getSessionData.php';

        startSession();
        $order = $_SESSION['order'];
        $customer = $_SESSION['customer'];

        $custID = $customer->getCustID();
        $custName = $customer->getCustName();

        if (isset($_POST['shipMethod'])) {
            $order->setShipMethod($_POST['shipMethod']);
        }

        if (isset($_POST['shipDate'])) {
            $todayDate = date_create(date('Y-m-d'));
            $shipDate = date_create($_POST['shipDate']);
            $diff = date_diff($todayDate, $shipDate);
            $days = $diff->days;
            if ($days < 2) {
                echo '<script type="text/javascript">history.back(alert("Please select a date 2 days from now."));</script>';
            } else {
                $order->setShipDate($_POST['shipDate']);
            }
        }

        if ($order->getShipMethod() == 2) {
            if (isset($_POST['shipAddress'])) {
                $order->setShipAddress($_POST['shipAddress']);
            }
        } else {
            $order->setShipAddress('-');
        }

        if (isset($_POST['shipTime'])) {
            $order->setShipTime($_POST['shipTime']);
        }

        $db = new OrdersDB();
        $db->insertOrder($order);
        ?>
    </body>
</html>
