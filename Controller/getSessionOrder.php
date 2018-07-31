<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../Model/Orders.php';
session_start();

if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = new Orders('1001', null, null, null, null, null, null, 0);
}
?>