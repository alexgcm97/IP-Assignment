<?php

/**
 * Description of order
 *
 * @author Chun Ming
 */
function getSessionOrder() {
    $order = $_SESSION['order'];
    return $order;
}

function processOrder() {
// put your code here
    $order = getSessionOrder();
    $productID = $_POST['id'];
    if (isset($_POST['update'])) {
        if (!empty($_POST['newQty'])) {
            $newQty = $_POST['newQty'];
            foreach ($order->getAllOD() as $od) {
                if (strcmp($od->getProductID(), $productID) == 0) {
                    $od->setQuantity($newQty);
                    $od->setTotalAmount((double) $newQty * (double) $od->getPrice());
                }
            }
        } else {
            echo '<script type="text/javascript">alert("Invalid Quantity Input.");</script>';
        }
    } elseif (isset($_POST['delete'])) {
        $productID = $_POST['id'];
        $order->removeODFromList($productID);
    } elseif (isset($_POST['add'])) {
        if (!empty($_POST['quantity'])) {
            if ($order->contain($productID)) {
                foreach ($order->getAllOD() as $od) {
                    if (strcmp($od->getProductID(), $productID) == 0) {
                        $newQuantity = (int) $od->getQuantity() + (int) $_POST['quantity'];
                        $od->setQuantity($newQuantity);
                        $od->setTotalAmount((double) $newQuantity * (double) $od->getPrice());
                    }
                }
            } else {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                $quantity = $_POST['quantity'];
                $totalAmount = (Double) $price * (Double) $quantity;
                $od = new OrderDetails($order->getOrderID(), $productID, $name, $description, $price, $quantity, $totalAmount);
                $order->addODToList($od);
            }
        } else {
            echo '<script type="text/javascript">alert("Invalid Quantity Input.");</script>';
        }
    }
    updateOrderCart();
}

function updateOrderCart() {
    $order = getSessionOrder();

    if (!empty($order->getAllOD())) {
        $index = 1;
        $grandTotal = 0;
        foreach ($order->getAllOD() as $od) {
            $productID = $od->getProductID();
            $name = $od->getName();
            $description = $od->getDescription();
            $quantity = $od->getQuantity();
            $price = $od->getPrice();
            $totalAmount = $od->getTotalAmount();
            echo "<form action='orderPage.php' method='post'>"
            . "<tr style='text-align:center;'>"
            . "<td style='width:10%;height:90px'>$index</td>"
            . "<td style='width:45%'>$name<br/>$description</td>"
            . "<td style='width:20%'>"
            . "<input type='hidden' name='id' value='$productID'/>"
            . "<input type='number' name='newQty' value='$quantity' style='width:50px;text-align:center;vertical-align:middle'/> "
            . "<button type='submit' name='update' style='margin-left:-5px;width:20px;background:transparent;border:none;'><img src='../img/update.png' style='height:15px;width:15px;vertical-align:middle;'/></button>"
            . "<br/><input type='submit' name='delete' value='Remove' style='margin-top:5px'/></td>"
            . "<td style='width:25%'>" . sprintf('%.2f', $totalAmount) . "</td>"
            . "</tr></form>";
            $index++;
        }
        $order->setGrandTotal($grandTotal);
    }
}

?>