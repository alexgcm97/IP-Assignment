<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of catalog
 *
 * @author Chun Ming
 */
class Product {

    private $productID, $name, $description, $price, $stock, $status;

    function __construct($productID, $name, $description, $price, $stock, $status) {
        $this->productID = $productID;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->status = $status;
    }

    function getProductID() {
        return $this->productID;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPrice() {
        return $this->price;
    }

    function getStock() {
        return $this->stock;
    }

    function setProductID($productID) {
        $this->productID = $productID;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
