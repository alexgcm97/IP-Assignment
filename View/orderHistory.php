<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--
 * Description of orderHistory
 *
 * @author Goh Chun Ming
 *-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Order History</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
    <body>
        <?php
        require '../Controller/getSessionData.php';

        // put your code here
        if (session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            startSession();
        }
        if (empty($_SESSION['customer']->getCustID())) {
            header("Location: ../View/index.php?err=1");
        }
        ?>
        <div style='margin:10px 0px 0px 100px'>
            <form action="index.php">
                <button class="btn red" type="submit" style="width:150px;left:0;height:30;display:inline-block;">Back
                    <i class="material-icons left">arrow_back</i>
                </button>
            </form>
        </div>
        <div style='margin:auto;width:55%;'>     
            <h2 style="text-align:center">View Order History</h2>
            <div style="height:500px;overflow-y:auto;resize:none">
                <table style="margin-right:20px;table-layout:fixed;">
                    <tr>
                        <th width='10%' style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Order No.</th>
                        <th width="30%" style='text-align:center'>Order Date</th>
                        <th width="20%" style='text-align:right;padding-right:50px'>Grand Total (RM)   </th>
                        <th width="30%" style='text-align:center'>View</th>
                    </tr>
                    <?php
                    $customer = $_SESSION['customer'];
                    $db = new OrdersDB();
                    $results = $db->retrieveCustomerOrders($customer->getCustID());
                    $index = 1;
                    foreach ($results as $row) {
                        $orderID = $row['orderID'];
                        $orderDate = $row['orderDate'];
                        $grandTotal = $row['grandTotal'];
                        echo "<form action='viewSalesOrder.php' method='post'>";
                        echo "<input type='hidden' value='$orderID' name='orderID'/>";
                        echo "<tr><td width='10%' style='text-align:center'>$index</td>"
                        . "<td width='15%' style='text-align:center'>$orderID</td>"
                        . "<td width='25%' style='text-align:center'>$orderDate</td>"
                        . "<td width='25%'  style='text-align:right;padding-right:50px'>".number_format($grandTotal, 2, ".", ",")."</td>"
                        . "<td style='text-align:center'><input type='submit' name='viewOrder' value='View Sales Order' class='btn grey darken-2'/></tr></form>";
                        $index++;
                    }

                    if (empty($results)) {
                        echo "<tr><td colspan='4' style='text-align:center'>There are no records.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

    </body>
</html>
