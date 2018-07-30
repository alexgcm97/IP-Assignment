<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--
 * Description of orderPage
 *
 * @author Chun Ming
 *-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Page</title>
        <?php
        require '../Model/Orders.php';
        require '../Model/Product.php';
        require '../Controller/generateOrderCatalog.php';
        require '../Controller/processOrder.php';

        if (!isset($_POST['add']) && !isset($_POST['update']) && !isset($_POST['delete'])) {
            session_start();
            $_SESSION['order'] = new Orders('1001', null, null, null, null, null, null, 0);
        } else {
            session_start();
        }
        ?>
    </head>

    <body style="margin:auto;width:55%;margin-top:30px;">
        <div style="float:left;margin-right:20px;margin-top:30px;">
            <table border="1" width="680px" style="border-bottom:0" >
                <tr>
                    <th style="width:5%;text-align:center">No.</th>
                    <th style="padding:10px 10px 10px 10px;width:70%">Product</th>
                    <th style="padding:10px 10px 10px 10px;width:20%">Action</th>
                </tr>
            </table>
            <div style='height:480px;width:700px;overflow-y:auto;'>
                <table border="1" width="680px" style="border-top:0" >
                    <?php
                    generateCatalog();
                    ?>
                </table>
            </div>
        </div>
        <div style="float:right;width:30%">
            <b><span style="text-decoration: underline;">Order Cart</span></b>
            <table style='margin-top:10px;width:450px' border="1">
                <tr>
                    <th style="width:10%">No.</th>
                    <th style="width:45%">Product</th>
                    <th style="width:20%">Qty</th>
                    <th style="width:25%">Total Amount (RM)</th>
                </tr>
            </table>


            <?php
            echo "<div style='height:520px;width:470px;overflow-y:auto;'>" .
            "<table style='table-layout: fixed' border='1'maxheight='480px' width='450px' >";
            if (isset($_POST['add']) || isset($_POST['update']) || isset($_POST['delete'])) {
                processOrder();
            } else {
                echo "<tr style='height:480px'>"
                . "<td style='width:10%'></td>"
                . "<td style='width:45%'></td>"
                . "<td style='width:20%'></td>"
                . "<td style='width:25%'></td>"
                . "</tr>";
            }
            echo "</table></div>";
            $order = $_SESSION['order'];
            $observer = new OrdersObserver();
            $order->attach($observer);
            $order->notify();
            $grandTotal = $order->getGrandTotal();
            echo "<h2 style='float:right'>Total Amount : RM $grandTotal</h2>";
            ?>

            <form action="../index.php" method="post">
                <input type="submit" name="submitOrder" value="Submit Order" style="margin-left:20px;width:400px;height:50px;font-size:25px;"/>
            </form>
        </div>
    </body>
</html>
