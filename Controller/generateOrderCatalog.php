<?php
/**
 * Description of order
 *
 * @author Chun Ming
 */
require "../Model/OrdersCall.php";

function generateCatalog() {

    $results = retrieveCatalog();

    foreach ($results as $row) {
        $temp = new product($row['productID'], $row['name'], $row['description'], $row['price'], null, $row['status']);
        switch ($row['type']) {
            case "Monthly": {
                    $monthlyList[] = $temp;
                    break;
                }
            case "Bouquet": {
                    $bouquetList[] = $temp;
                    break;
                }
            case "Promotion": {
                    $promotionList[] = $temp;
                    break;
                }
        }
    }

    if (!empty($monthlyList)) {
        $position = 1;
        foreach ($monthlyList as $product) {
            $name = $product->getName();
            $id = $product->getProductID();
            $price = $product->getPrice();
            $description = $product->getDescription();
            $status = $product->getStatus();
            echo "<form action='orderPage.php' method='post'>";
            if ($position == 1) {
                echo "<tr><th colspan='3'>Monthly Item</th></tr>";
            }
            echo "<tr style='height:90px'>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:5px 10px 10px 10px;width:70%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:20%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='text' name='quantity' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
                . "<input type = 'submit' class='btn-small waves-light' name = 'add' value = 'Add to Cart'/> </td>";
            } else {
                echo "<span>Sorry.<br/>Out of Stock.</span>";
            }
            echo "</tr></form>";
            $position ++;
        }
    } else {
        echo "<tr><th colspan='3'>Promotion Item</th></tr>";
        echo "<tr><td height='50px' colspan='3' style='text-align:center'>Sorry, there are no item in this category.</td></tr>";
    }
    if (!empty($bouquetList)) {
        $position = 1;
        foreach ($bouquetList as $product) {
            $name = $product->getName();
            $id = $product->getProductID();
            $price = $product->getPrice();
            $description = $product->getDescription();
            $status = $product->getStatus();
            echo "<form action='orderPage.php' method='post'>";
            if ($position == 1) {
                echo "<tr><th colspan='3'>Flower Bouquet</th></tr>";
            }
            echo "<tr style='height:90px'>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:5px 10px 10px 10px;width:70%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:20%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='text' name='quantity' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
                . "<input type = 'submit' class='btn-small waves-light' name = 'add' value = 'Add to Cart'/> </td>";
            } else {
                echo "<span>Sorry.<br/>Out of Stock.</span>";
            }
            echo "</tr></form>";
            $position ++;
        }
    } else {
        echo "<tr><th colspan='3'>Promotion Item</th></tr>";
        echo "<tr><td height='50px' colspan='3' style='text-align:center'>Sorry, there are no item in this category.</td></tr>";
    }
    if (!empty($promotionList)) {
        $position = 1;
        foreach ($promotionList as $product) {
            $name = $product->getName();
            $id = $product->getProductID();
            $price = $product->getPrice();
            $description = $product->getDescription();
            $status = $product->getStatus();
            echo "<form action='orderPage.php' method='post'>";
            if ($position == 1) {
                echo "<tr><th colspan='3'>Promotion Item</th></tr>";
            }
            echo "<tr style='height:90px'>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:5px 10px 10px 10px;width:70%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:20%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='text' name='quantity' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
                . "<input type = 'submit' class='btn-small waves-light' name = 'add' value = 'Add to Cart'/> </td>";
            } else {
                echo "<span>Sorry.<br/>Out of Stock.</span>";
            }
            echo "</tr></form>";
            $position ++;
        }
    } else {
        echo "<tr><th colspan='3'>Promotion Item</th></tr>";
        echo "<tr><td height='50px' colspan='3' style='text-align:center'>Sorry, there are no item in this category.</td></tr>";
    }
}

?>