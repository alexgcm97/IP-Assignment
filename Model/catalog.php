<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of catalog
 *
 * @author Teck Siong
 */
class catalog {
    private $catalogID, $date;
    
    function __construct($catalogID, $date) {
        $this->catalogID = $catalogID;
        $this->date = $date;
    }
    
    function getCatalogID($catalogID) {
        return $this->$catalogID;
    }

    function getDate($date) {
        return $this->$date;
    }

    function setCatalogID($catalogID, $value) {
        $this->catalogID = $value;
    }

    function setDate($date, $value) {
        $this->date = $value;
    }

}
