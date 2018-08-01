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
    <body style="position:fixed;left:40%;top:40%;text-align:center;background-color: background">
        <?php
// put your code here
        if (isset($_GET['err'])) {
            echo '<script type="text/javascript">alert("Invalid Customer ID.");</script>';
        } elseif (isset($_GET['errNo'])) {
            echo '<script type="text/javascript">alert("You have finished up your monthly credit limit.");</script>';
        }
        session_start();
        $_SESSION = array();
        ?>
        <form action="../View/orderPage.php" method="post">
            <input type="text" name="custID" style="color:white" placeholder="Please Type Customer ID Here"/>
            <input type="submit" name='login' class="btn" width="500px" value="Proceed to Order"/>
        </form>
    </body>
</html>
