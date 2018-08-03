<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderDetails
 *
 * @author Goh Chun Ming
 */
class OrderDetails {

    //put your code here

    private $orderID, $productID, $name, $description, $price, $quantity, $totalAmount;

    function __construct($orderID, $productID, $name, $description, $price, $quantity, $totalAmount) {
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getProductID() {
        return $this->productID;
    }

    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
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
