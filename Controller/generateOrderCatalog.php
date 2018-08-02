<?php

/**
 * Description of order
 *
 * @author Chun Ming
 */
function generateCatalog() {

    $db = new OrdersDB();
    $date = date('F Y');
    do {
        $time = strtotime($date);
        $results = $db->retrieveCatalog($date);
        $date = date("F Y", strtotime("-1 month", $time));
    } while (empty($results));

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
                echo "<tr><th colspan='3' style='font-style: italic; font-size:18px'>Monthly Item<img src='img/single.png' style='width:25px; height:25px; vertical-align:middle; margin-left:5px'/></th></tr>";
            }
            echo "<tr style='height:70px'>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:10px 10px 10px 17px;width:65%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:25%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='number' name='quantity' min='1' max='99' step='1' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
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
                echo "<tr style='height:50px'><th colspan='3' style='font-style: italic; font-size:18px'>Flower Bouquet<img src='img/bouquet.png' style='vertical-align:middle;width:25px; height:25px; margin-left:5px'/></th></tr>";
            }
            echo "<tr>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:10px 10px 10px 17px;width:65%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:10px 0 10px 0;width:25%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='number' name='quantity' min='1' max='99' step='1' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
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
                echo "<tr><th colspan='3' style='font-style: italic; font-size:18px;'>Promotion Item<img src='img/promotion.png' style='vertical-align:bottom;width:35px; height:20px; margin-left:5px'/></th></tr>";
                ;
            }
            echo "<tr style='height:90px'>";
            echo "<td style='width:5%;text-align:center'> $position </td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:10px 10px 10px 17px;width:65%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:25%;text-align:center'>";
            if ($status == 1) {
                echo "<label for='quantity'>Qty: </label>"
                . "<input type='number' name='quantity' min='1' max='99' step='1' style='width:30px;margin-bottom:10px;text-align:center'/><br/>"
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