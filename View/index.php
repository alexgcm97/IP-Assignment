<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

    </head>
    <body style="position:fixed;left:40%;top:40%;text-align:center;background-color: background">
        <?php
// put your code here
        require '../Controller/getSessionOrder.php';
        ?>
        <form action="orderPage.php" method="post">
            <input type="text" name="custID" style="color:white" placeholder="Please Type Customer ID Here"/>
            <input type="submit" class="btn" width="500px" value="Proceed to Order" href="View/orderPage.php">
        </form>
    </body>
</html>
