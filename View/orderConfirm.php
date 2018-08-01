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
        <title>Order Confirmation Page</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/materialize.min.js"></script>

        <style>
            label {
                font-size:15px;
            }

            input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button,input[type="date"]::-webkit-outer-spin-button, input[type="date"]::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
        <script>
            function ShowHideDiv() {
                var deliver = document.getElementById("deliver");
                var shipAddress = document.getElementById("shipAddress");
                var addText = document.getElementById("addText");
                var dTime = document.getElementById("dTime");
                var dDate = document.getElementById("dDate");
                var pTime = document.getElementById("pTime");
                var pDate = document.getElementById("pDate");
                var shipDate = document.getElementById("shipDate");

                shipDate.style.display = "block";
                if (deliver.checked) {
                    shipAddress.style.display = "block";
                    addText.setAttribute("required", "required");
                    dTime.style.display = "inline";
                    dDate.style.display = "inline";
                    pTime.style.display = "none";
                    pDate.style.display = "none";
                } else {
                    shipAddress.style.display = "none";
                    addText.setAttribute("disabled", "disabled");
                    dTime.style.display = "none";
                    dDate.style.display = "none";
                    pTime.style.display = "inline";
                    pDate.style.display = "inline";
                }

            }
        </script>
    </head>
    <body style='left:20%;width:60%;position:fixed'>
        <h2 style="text-align: center">Order Confirmation Page</h2>
        <div style="height:700px;border-radius:10px;width:80%;margin:auto;border:1px solid black;">
            <div style='margin:auto;width:90%;margin-top:20px'>
                <form action='orderComplete.php' method="post">

                    <?php
                    require '../Controller/getSessionData.php';

                    startSession();

                    if (!isset($_SESSION['order'])) {
                        
                    }

                    $order = $_SESSION['order'];
                    $customer = $_SESSION['customer'];

                    $custID = $customer->getCustID();
                    $custName = $customer->getCustName();
                    $custType = $customer->getCustType();

                    // put your code here
                    echo "<div class='row'><div class='col s6'><label for='custID'>Customer ID:<input type='text' name='custID' value='$custID' readonly='readonly'/></label></div>"
                    . "<div class='col s6'><label for='custName'>Customer Name:<input type='text' name='custName' value='$custName'/></label></div></div>";
                    ?>
                    <div class="row">
                        <div class="col s3">
                            <label for="shipMethod">
                                Shipping Method:
                            </label>
                        </div>
                        <div class="col s2">
                            <label>
                                <input type="radio" name="shipMethod" value="1" onclick='ShowHideDiv()' checked required/><span style="color:black">Pick-up</span>
                            </label>
                        </div>
                        <?php
                        $grandTotal = $order->getGrandTotal();
                        if ($grandTotal < 30) {
                            echo " <span style='text-align:right'>*Minimum order of RM30 is required for delivery.</span>";
                        }
                        ?>
                        <div class = "col s2">
                            <label>
                                <input type = "radio" name = "shipMethod" id = 'deliver' value = "2" onclick = 'ShowHideDiv()'required /><span style = "color:gray" >Delivery</span>
                            </label>
                        </div>

                    </div>

                    <div class="row" id='shipAddress' style='display:none'>
                        <div class="col s12">
                            <label for='shipAddress'> Delivery Address: 
                                <input type='text' name="shipAddress" id='addText'/>
                            </label>
                        </div>
                    </div>

                    <div class="row" id='shipDate'>
                        <div class="col s6">
                            <label for='shipDate'><span id='pDate'>Pickup Date</span><span id='dDate' style='display: none'>Delivery Date</span><span> (At least 2 days later) : </span>
                                <?php
                                $date = date('Y-m-d');
                                $requiredDate = date('Y-m-d', strtotime(' +2 day'));
                                echo "<input type = 'date' name='shipDate' value='$date' min='$requiredDate' required/>";
                                ?>
                            </label>
                        </div>
                        <div class="col s6">
                            <label for='shipTime'><span id='pTime'>Pickup Time:</span><span id='dTime' style='display:none'>Delivery Time:</span>
                                <?php
                                echo "<input type = 'time' name='shipTime' value='08:00' min='08:00' max='20:00'/>";
                                ?>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s12">
                            <label for='shipTime'> Total Amount to be Paid:
                                <?php
                                $grandTotal = $order->getGrandTotal();
                                echo "<br/><input type='text' value='RM' style='width:3%' readonly='readonly'/><input type ='text' name='grandTotal' value='" . number_format($grandTotal, 2, ".", ",") . " ' style='width:97%;' readonly='readonly'/> ";
                                ?>
                            </label>
                        </div>
                    </div>

                    <?php
                    echo "<div class = 'row'><div class='col s6'>";
                    if ($custType == 2) {
                        $creditBalance = $customer->getCreditBalance();
                        $remaining = $_POST['remaining'];
                        echo "<label for='remaining'> Orignal Credit Balance:";
                        echo "<br/><input type='text' value='RM' style='width:6%' readonly='readonly'/><input type ='text' name='creditBalance' value='" . number_format($creditBalance, 2, ".", ",") . " ' style='width:94%;' readonly='readonly'/></label></div> ";
                        echo "<div class='col s6'>";
                        echo "<label for='remaining'> Remaining Credit Balance after Paid:";
                        echo "<br/><input type='text' value='RM' style='width:6%' readonly='readonly'/><input type ='text' name='remaining' value='" . number_format($remaining, 2, ".", ",") . " ' style='width:94%;' readonly='readonly'/></label></div> ";
                    }
                    echo "</div></div>";
                    ?>
                    <div class="col s6" style='text-align:center;margin-top:40px'>
                        <input type='submit' value='Confirm Order' class='btn brown' style='width:200px;height:45px;font-size:20px;'/>
                    </div>
                </form>
                <form action="orderPage.php" method="post">
                    <div class="col s6" style='text-align:center;margin-top:20px'>
                        <button type='submit' class='btn grey' style='width:130px;vertical-align: middle;height:45px;font-size:20px;'><span style='margin-left:-16px;'>Cancel</span>
                            <?php
                            echo "<input type='hidden' value='$custID' name='custID'/>";
                            ?>
                            <i class="material-icons left" style="vertical-align:middle">clear</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
