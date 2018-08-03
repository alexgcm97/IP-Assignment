<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author Goh Chun Ming
 */
class Customer {

    //put your code here

    private $custID, $custType, $custName, $custEmail, $creditLimit, $creditBalance, $creditStatus, $password;

    function __construct($custID, $custType, $custName, $custEmail, $creditLimit, $creditBalance, $creditStatus) {
        $this->custID = $custID;
        $this->custType = $custType;
        $this->custName = $custName;
        $this->custEmail = $custEmail;
        $this->creditLimit = $creditLimit;
        $this->creditBalance = $creditBalance;
        $this->creditStatus = $creditStatus;
    }

    function getCustID() {
        return $this->custID;
    }

    function getCustType() {
        return $this->custType;
    }

    function getCustName() {
        return $this->custName;
    }

    function getCustEmail() {
        return $this->custEmail;
    }

    function getCreditLimit() {
        return $this->creditLimit;
    }

    function getCreditBalance() {
        return $this->creditBalance;
    }

    function getCreditStatus() {
        return $this->creditStatus;
    }

    function setCustID($custID) {
        $this->custID = $custID;
    }

    function setCustType($custType) {
        $this->custType = $custType;
    }

    function setCustName($custName) {
        $this->custName = $custName;
    }

    function setCustEmail($custEmail) {
        $this->custEmail = $custEmail;
    }

    function setCreditLimit($creditLimit) {
        $this->creditLimit = $creditLimit;
    }

    function setCreditBalance($creditBalance) {
        $this->creditBalance = $creditBalance;
    }

    function setCreditStatus($creditStatus) {
        $this->creditStatus = $creditStatus;
    }

    function getPassword() {
        return $this->password;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
