<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderDetails
 *
 * @author Chun Ming
 */
class orderDetails {

    //put your code here

    private $orderID, $productID, $price, $quantity, $totalAmount;

    function __construct($orderID, $productID, $price, $quantity, $totalAmount) {
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getProductID() {
        return $this->productID;
    }

    function getPrice() {
        return $this->price;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getTotalAmount() {
        return $this->totalAmount;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setProductID($productID) {
        $this->productID = $productID;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }

}
