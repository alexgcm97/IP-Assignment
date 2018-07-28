<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdt_catalog
 *
 * @author Teck Siong
 */
class pdt_catalog {
    private $catalogID, $productID;

    function __construct($catalogID, $productID) {
        $this->catalogID = $catalogID;
        $this->productID = $productID;
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


}
