<?php

/**
 * Description of order
 *
 * @author Chun Ming
 */
function processOrder() {
// put your code here
    $order = $_SESSION['order'];
    $customer = $_SESSION['customer'];
    if (isset($_POST['id'])) {
        $productID = $_POST['id'];
    }
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
    } elseif (isset($_POST['clear'])) {
        $order->clearODList();
    }
    updateOrderCart();
}

function updateOrderCart() {
    $order = $_SESSION['order'];
    $customer = $_SESSION['customer'];
    $observer = new OrdersObserver();
    $order->attach($observer);
    $order->notify();
    $remaining = $customer->getCreditBalance() - $order->getGrandTotal();

    if ($customer->getCustType() == 2 && $remaining < 0) {
        $order->clearODList();
        $order->setGrandTotal(0);
        echo '<script type="text/javascript">alert("Your order has exceeded your credit balance. Order cart is cleared.");</script>';
    } else {
        $index = 1;
        foreach ($order->getAllOD() as $od) {
            $productID = $od->getProductID();
            $name = $od->getName();
            $description = $od->getDescription();
            $quantity = $od->getQuantity();
            $totalAmount = $od->getTotalAmount();
            echo "<form action='orderPage.php' method='post'>"
            . "<tr style='text-align:center;height:70px'>"
            . "<td style='width:10%'>$index</td>"
            . "<td style='width:40%;word-wrap:break-word;'><span style='font-size:16px; font-style: oblique;'><b>$name</b></span><br/>$description</td>"
            . "<td style='width:30%;text-align:center'>"
            . "<input type='hidden' name='id' value='$productID'/>"
            . "<input type='number' name='newQty' value='$quantity' style='width:50px;text-align:center;vertical-align:middle'/> "
            . "<button type='submit' name='update' style='margin-left:-5px;width:20px;background:transparent;border:none;'><img src='../img/update.png' style='height:15px;width:15px;vertical-align:middle;'/></button>"
            . "<br/><input type='submit' class='btn-small pink' name='delete' value='Remove' style='margin-top:5px;margin-left:0px;font-size:12px'/></td>"
            . "<td style='width:25%;text-align:center'>" . sprintf('%.2f', $totalAmount) . "</td>"
            . "</tr></form>";
            $index++;
        }
    }
}

?>