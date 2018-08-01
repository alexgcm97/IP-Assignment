<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sales Order</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </head>
    <body>
        <?php
        // put your code here
        require '../Controller/generateSalesOrder.php';
        if (isset($_POST['orderID'])) {
            $orderID = $_POST['orderID'];
            generateSalesOrder($orderID);

            $doc = new DOMDocument();
            $doc->load('../xml/SalesOrder.xml');

            $xsl = new DOMDocument();
            $xsl->load('../xml/SalesOrder.xsl');

            $xslt = new XSLTProcessor();
            $xslt->importStylesheet($xsl);

            echo $xslt->transformToXml($doc);
        }
        ?>
    </body>
</html>
