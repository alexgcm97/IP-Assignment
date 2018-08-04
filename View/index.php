<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

-->
<!--
 * Description of index
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
    <body style="position:fixed;left:35%;top:25%;text-align:center;background-color: #4a5b9d">
        <?php
// put your code here
        if (isset($_GET['err'])) {
            switch ($_GET['err']) {
                case 1:
                    echo '<script type="text/javascript">alert("Invalid Customer ID & Password.");</script>';
                    break;
                case 2:
                    echo '<script type="text/javascript">alert("You have finished up your monthly credit limit.");</script>';
                    break;
            }
        }
        session_start();
        $_SESSION = array();
        ?>
        <form action="../View/orderPage.php" method="post">
            <h3  style="margin-top:20px;margin-bottom:40px; font-weight: bold; color: beige">Welcome To Fiore Flowershop</h3>
            <input type="text" name="custID" style='color:white;margin-bottom:20px;width:250px' placeholder="Customer ID" required/>
            <input type="password" name="password" style='color:white;margin-bottom:20px;width:250px' placeholder="Password" required/><br/>
            <input type="submit" name='login' class="btn" width="500px" value="Proceed to Order"/><br/>
            <input type="submit" name='viewOrder' class="btn" width="500px" value="View Order History" style="margin-top:20px;"/>
        </form>
    </body>
</html>
