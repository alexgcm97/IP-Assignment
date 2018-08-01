<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ordering Module</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
    <body>
        <?php
        require '../Controller/getSessionData.php';
        startSession();
        if (empty($_SESSION['customer'])) {
            header("Location: ../View/index.php?err=1");
        } else {
            $order = $_SESSION['order'];
            $customer = $_SESSION['customer'];
            $custID = $customer->getCustID();
            $custName = $customer->getCustName();

            if (isset($_POST['shipDate'])) {
                $order->setShipDate($_POST['shipDate']);
            }

            if (isset($_POST['shipMethod'])) {
                $order->setShipMethod($_POST['shipMethod']);
                if ($order->getShipMethod() == 2) {
                    if (isset($_POST['shipAddress'])) {
                        $order->setShipAddress($_POST['shipAddress']);
                    }
                } else {
                    $order->setShipAddress('-');
                }
            }

            if (isset($_POST['shipTime'])) {
                $order->setShipTime($_POST['shipTime']);
            }

            $orderDate = date('Y-m-d');
            $order->setOrderDate($orderDate);
            $db = new OrdersDB();
            $db->insertOrder($order);
            foreach ($order->getAllOD() as $od) {
                $db->insertOD($od);
            }
            if ($customer->getCustType() == 2) {
                $remaining = $_POST['remaining'];
                if ($remaining == 0) {
                    $customer->setCreditBalance($remaining);
                    $customer->setCreditStatus(0);
                }
                $db->updateCreditBalance($customer);
            }
        }
        ?>

    <body style='position:fixed;left:35%;top:30%;text-align:center;background-color: white'>
        <div style="height:320px;width:500px;border-radius:10px;border:1px solid black; background-color: white">
            <h4>Order has been completed.</h4>
            <form action="viewSalesOrder.php" method='post'>
                <input type="submit" class="btn cyan" name="restart" style='font-size:25px;width:300px;height:80px;margin-top:30px' value="View Sales Order"/>
            </form>
            <form action="index.php" method='post'>
                <input type="submit" style='margin-top:30px;margin-bottom:30px'class="btn grey" name="restart" value="Return to Order Page"/>
            </form>
        </div>
    </body>
</html>
