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
require '../Model/OrderDetails.php';
require 'OrdersObserver.php';

class Orders extends AbstractSubject {

    private $orderID, $orderDate, $custID, $orderType, $shipAddress, $shipDate, $shipTime, $grandTotal;
    private $odList = array();

    function __construct($orderID, $orderDate, $custID, $orderType, $shipAddress, $shipDate, $shipTime, $grandTotal) {
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->custID = $custID;
        $this->orderType = $orderType;
        $this->shipAddress = $shipAddress;
        $this->shipDate = $shipDate;
        $this->shipTime = $shipTime;
        $this->grandTotal = $grandTotal;
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

    function getGrandTotal() {
        return $this->grandTotal;
    }

    function setGrandTotal($grandTotal) {
        $this->grandTotal = $grandTotal;
    }

    function addODToList($od) {
        $this->odList[] = $od;
    }

    function getAllOD() {
        return $this->odList;
    }

    function clearODList() {
        unset($this->odList);
        $this->odList = array();
    }

    function removeODFromList($productID) {
        for ($i = 0; $i < sizeof($this->odList); $i++) {
            if (strcmp($this->odList[$i]->getProductID(), $productID) == 0) {
                unset($this->odList[$i]);
            }
        }
    }

    function contain($productID) {
        $od = new OrderDetails(null, null, null, null, null, null, null);
        foreach ($this->odList as $od) {
            if (strcmp($od->getProductID(), $productID) == 0) {
                return true;
            }
        }
    }

    public function attach(AbstractObserver $observer_in) {
        $this->observers[] = $observer_in;
    }

    public function detach(AbstractObserver $observer_in) {
        foreach ($this->observers as $okey => $oval) {
            if ($oval == $observer_in) {
                unset($this->observers[$okey]);
            }
        }
    }

    public function notify() {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

}
