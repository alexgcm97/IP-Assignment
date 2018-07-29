<?php

function generateCatalog() {
    $date = date('F Y');
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $sql_query = "SELECT p.productID, p.name, p.description, p.price from product p, catalog c, pdt_catalog pc where c.date = '$date'"
            . " AND c.catalogID = pc.catalogID AND pc.productID = p.productID";
    $result = $mysqli->query($sql_query);
    $row = mysqli_fetch_row($result);

    foreach ($result as $row) {
        $temp = new product(null, null, null, null, null);
        foreach ($row as $column => $data) {
            switch ($column) {
                case 'productID':
                    $temp->setProductID($data);
                    break;
                case 'name':
                    $temp->setName($data);
                    break;
                case 'description':
                    $temp->setDescription($data);
                    break;
                case 'price':
                    $temp->setPrice($data);
                    break;
            }
        }
        $productList[] = $temp;
    }

    if (!empty($productList)) {
        $position = 1;
        foreach ($productList as $product) {
            $name = $product->getName();
            $id = $product->getProductID();
            $price = $product->getPrice();
            $description = $product->getDescription();
            echo "<form action='orderPage.php' method='post'>";
            echo "<tr style='height:90px'>";
            echo "<td style='width:5%;text-align:center'> $position</td>";
            echo "<input type='hidden' value='$name' name='name'/>"
            . "<input type='hidden' value='$id' name='id'/>"
            . "<input type='hidden' value='$description' name='description'/>"
            . "<input type='hidden' value='$price' name='price'/>";
            echo "<td style='padding:5px 10px 10px 10px;width:70%'><b> Name: </b> $name <br/> <b> Description: </b> $description </br> <b> Price: </b>RM $price</td>";
            echo "<td style='padding:5px 0 10px 0;width:20%;text-align:center'>"
            . "<label for='quantity'>Qty: </label>"
            . "<input type='text' name='quantity' style='width:30px;margin-bottom:10px'/><br/>"
            . "<input type = 'submit' name = 'add' value = 'Add to Cart'/> </td>";
            echo "</tr></form>";
            $position ++;
        }
    } else {
        echo "<tr><td colspan='3' style='text-align:center'>No records in the catalog.</td><tr>";
    }
}

?>