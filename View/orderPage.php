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
        require '../Controller/getSessionData.php';
        require '../Model/Product.php';
        require '../Controller/generateOrderCatalog.php';
        require '../Controller/processOrder.php';
        if (session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            startSession();
        }
        if (empty($_SESSION['customer']->getCustID())) {
            header("Location: ../View/index.php?err=1");
        } else {
            $order = $_SESSION['order'];
            $customer = $_SESSION['customer'];
            $creditStatus = $customer->getCreditStatus();
            if ($creditStatus == false) {
                header("Location: ../View/index.php?errNo=1");
            }
        }
        ?>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/materialize.min.js"></script>

        <style>
            input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button{
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>

    <body style="margin:auto;width:70%;margin-top:30px">
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
                    <th style="padding:10px 10px 10px 10px;width:65%">Product</th>
                    <th style="padding:10px 10px 10px 10px;width:25%">Action</th>
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
        <div style="float:right;height:450px;width:550px;margin-top:-15px">
            <b><span style="text-decoration: underline;">Order Cart</span></b>
            <table style='width:500px'border="1">
                <tr>
                    <th style="width:5%;">No.</th>
                    <th style="width:50%;">Product</th>
                    <th style="width:20%;">Qty</th>
                    <th style="width:30%;text-align:center">Subtotal (RM)</th>
                </tr>
            </table>


            <?php
            echo "<div style='height:470px;width:500px;overflow-y:auto;'>" .
            "<table border='1'maxheight='470px' width='470px' style='table-layout:fixed'>";

            if (isset($_POST['add']) || isset($_POST['update']) || isset($_POST['delete']) || isset($_POST['clear'])) {
                processOrder();
            } else {
                if (empty($order->getAllOD())) {
                    echo "<tr style='height:430px'>"
                    . "<td style='width:10%'></td>"
                    . "<td style='width:40%'></td>"
                    . "<td style='width:30%'></td>"
                    . "<td style='width:30%'></td>"
                    . "</tr>";
                } else {
                    updateOrderCart();
                }
            }
            echo "</table></div>";

            $grandTotal = $order->getGrandTotal();
            echo "<form action='orderPage.php' method='post'>";
            echo "<input type='submit' name='clear' value='Clear Cart' class='btn blue-grey' style='margin:30px 0px 5px 300px;width:200px'/></form>";
            $custType = $customer->getCustType();
            if ($custType == 2) {
                $creditBalance = $customer->getCreditBalance();
                $remaining = (double) $creditBalance - (double) $grandTotal;
                if ($remaining >= 0) {
                    echo "<h5 style='text-align:right;width:500px;'>Remaining Credit Balance : RM" . number_format($remaining, 2, ".", ",") . "</h4>";
                }
            }
            echo "<h4 style='text-align:right;width:500px;'>Total Amount : RM" . number_format($grandTotal, 2, ".", ",") . "</h4>";
            ?>
            <form action="../View/orderConfirm.php" method="post">
                <?php
                if ($custType == 2) {
                    echo "<input type='hidden' value='$remaining' name='remaining'/>";
                }
                if ($grandTotal < 30) {
                    echo "<h6 style='text-align:right;width:500px'>*A minimum order of RM30 is required.</h6>";
                }
                ?>
                <input type="submit" name="submitOrder" value="Submit Order" class="btn blue" style="width:500px;height:50px;font-size:25px;margin-top:20px"  <?php if (empty($order->getAllOD()) || $grandTotal < 30) { ?> disabled <?php } ?> />
            </form>
        </div>
    </body>
</html>
