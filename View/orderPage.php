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
        require '../Model/Product.php';
        require '../Controller/generateOrderCatalog.php';
        require '../Controller/processOrder.php';
        require '../Controller/getSessionOrder.php';


        /* if (!isset($_POST['add']) && !isset($_POST['update']) && !isset($_POST['delete'])) {
          session_start();
          $_SESSION['order'] = new Orders('1001', null, null, null, null, null, null, 0);
          } else {
          session_start();
          } */
        ?>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    </head>

    <body style="margin:auto;width:80%;margin-top:30px;">
        <script type="text/javascript" src="../js/materialize.min.js"></script>
        <div>
            <form action="index.php">
                <button class="btn waves-effect waves-light" type="submit" style="left:0;height:30;display:inline-block;">Back
                    <i class="material-icons left">arrow_back</i>
                </button>
            </form>
        </div>
        <div style="float:left;margin-right:20px;margin-top:10px;width:650px">
            <table border="1" width="600px" style="border-bottom:0" >
                <tr>
                    <th style="width:5%;text-align:center">No.</th>
                    <th style="padding:10px 10px 10px 10px;width:70%">Product</th>
                    <th style="padding:10px 10px 10px 10px;width:20%">Action</th>
                </tr>
            </table>
            <div style='height:430px;width:650px;overflow-y:auto;'>
                <table border="1" width="680px" style="border-top:0" >
                    <?php
                    generateCatalog();
                    ?>
                </table>
            </div>
        </div>
        <div style="float:right;height:450px;width:500px;margin-top:-15px   ">
            <b><span style="text-decoration: underline;">Order Cart</span></b>
            <table style='width:450px' border="1">
                <tr>
                    <th style="width:5%;">No.</th>
                    <th style="width:50%;">Product</th>
                    <th style="width:20%;">Qty</th>
                    <th style="width:30%;text-align:center">Subtotal (RM)</th>
                </tr>
            </table>


            <?php
            echo "<div style='height:430px;width:480px;overflow-y:auto;'>" .
            "<table border='1'maxheight='400px' width='450px' style='table-layout:fixed'>";
            if (isset($_POST['add']) || isset($_POST['update']) || isset($_POST['delete']) || isset($_POST['clear'])) {
                processOrder();
            } else {
                echo "<tr style='height:400px'>"
                . "<td style='width:10%'></td>"
                . "<td style='width:40%'></td>"
                . "<td style='width:30%'></td>"
                . "<td style='width:30%'></td>"
                . "</tr>";
            }
            echo "</table></div>";

            $order = $_SESSION['order'];
            $observer = new OrdersObserver();
            $order->attach($observer);
            $order->notify();
            $grandTotal = $order->getGrandTotal();
            echo "<form action='orderPage.php' method='post'>";
            echo "<input type='submit' name='clear' value='Clear Cart' class='btn blue-grey' style='margin:10px 0px 5px 250px;width:200px'/></form>";
            echo "<h4 style='text-align:right;width:450px;'>Total Amount : RM" . number_format($grandTotal, 2, ".", ",") . "</h4>";
            ?>
            <form action="../index.php" method="post">
                <input type="submit" name="submitOrder" value="Submit Order" class="btn blue" style="margin-left:50px;width:400px;height:50px;font-size:25px;"/>
            </form>
        </div>
    </body>
</html>
