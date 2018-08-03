<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--
 * Description of orderComplete
 *
 * @author Goh Chun Ming
 *-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ordering Module</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
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
            $orderID = $order->getOrderID();
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
            $result = $db->retrieveOrder($orderID);
            while (!empty($result)) {
                unset($result);
                $orderID++;
                $result = $db->retrieveOrder($orderID);
            };

            $order->setOrderID($orderID);
            $db->insertOrder($order);
            foreach ($order->getAllOD() as $od) {
                $od->setOrderID($orderID);
                $db->insertOD($od);
            }


            if ($customer->getCustType() == 2) {
                $payMethod = $_POST['payMethod'];
                if ($payMethod == 2) {
                    $remaining = $_POST['remaining'];
                    $customer->setCreditBalance($remaining);
                    if ($remaining == 0) {
                        $customer->setCreditStatus(0);
                    }
                    $db->updateCreditBalance($customer);
                }
            }
        }
        ?>

    <body style='position:fixed;left:35%;top:30%;text-align:center;background-color: white'>
        <div style="height:320px;width:500px;border-radius:10px;border:1px solid black; background-color: white">
            <h5>Thank you for purchasing from us.<br/> I hope you enjoy our services.</h5>
            <form action="viewSalesOrder.php" method='post'>
                <?php echo "<input type='hidden' name='orderID' value='$orderID'/>" ?>
                <input type="submit" class="btn black" name="restart" style='font-size:25px;width:300px;height:80px;margin-top:30px' value="View Sales Order"/>
            </form>
            <form action="index.php" method='post'>
                <input type="submit" style='margin-top:30px;margin-bottom:30px'class="btn red" name="restart" value="Return to Order Page"/>
            </form>
        </div>
    </body>
</html>
