<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author Chun Ming
 */
class orders {

    private $orderID, $orderDate, $custID, $orderType, $shipAddress, $shipDate, $shipTime;

    function __construct($orderID, $orderDate, $custID, $orderType, $shipAddress, $shipDate, $shipTime) {
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->custID = $custID;
        $this->orderType = $orderType;
        $this->shipAddress = $shipAddress;
        $this->shipDate = $shipDate;
        $this->shipTime = $shipTime;
    }

    function getOrderID() {
        return $this->orderID;
    }

    function getOrderDate() {
        return $this->orderDate;
    }

    function getCustID() {
        return $this->custID;
    }

    function getOrderType() {
        return $this->orderType;
    }

    function getShipAddress() {
        return $this->shipAddress;
    }

    function getShipDate() {
        return $this->shipDate;
    }

    function getShipTime() {
        return $this->shipTime;
    }

    function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
    }

    function setCustID($custID) {
        $this->custID = $custID;
    }

    function setOrderType($orderType) {
        $this->orderType = $orderType;
    }

    function setShipAddress($shipAddress) {
        $this->shipAddress = $shipAddress;
    }

    function setShipDate($shipDate) {
        $this->shipDate = $shipDate;
    }

    function setShipTime($shipTime) {
        $this->shipTime = $shipTime;
    }

}
