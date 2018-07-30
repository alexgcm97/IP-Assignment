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
class ProductCatalog {

    private $catalogID, $productID, $type;

    function __construct($catalogID, $productID, $type) {
        $this->catalogID = $catalogID;
        $this->productID = $productID;
        $this->type = type;
    }

    function getCatalogID($catalogID) {
        return $this->$catalogID;
    }

    function getProductID($productID) {
        return $this->$productID;
    }

    function setCatalogID($catalogID, $value) {
        $this->catalogID = $value;
    }

    function setProductID($productID, $value) {
        $this->productID = $value;
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

}
