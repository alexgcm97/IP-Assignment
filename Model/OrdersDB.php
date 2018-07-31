<?php

require "Database.php";

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
function retrieveCatalog() {
    try {
        $db = Database::getInstance();
        Database::setCharsetEncoding();
        $date = date('F Y');
        $sql_query = "SELECT c.catalogID, p.productID, p.name, p.description, p.price, p.status, pc.type from product p, catalog c, pdt_catalog pc where c.date = '$date'"
                . " AND c.catalogID = pc.catalogID AND pc.productID = p.productID";
        $stm = $db->prepare($sql_query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        print $e->getMessage();
    }
}
