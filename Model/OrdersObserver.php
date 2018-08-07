<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrdersObserver
 *
 * @author Goh Chun Ming
 */
abstract class AbstractObserver {

    abstract function update(AbstractSubject $subject_in);
}

abstract class AbstractSubject {

    abstract function attach(AbstractObserver $observer_in);

    abstract function detach(AbstractObserver $observer_in);

    abstract function notify();
}

class OrdersObserver extends AbstractObserver {

    private $grandTotal;

    public function __construct() {
        $this->grandTotal = 0;
    }

    public function update(AbstractSubject $subject) {
        foreach ($subject->getAllOD() as $od) {
            $this->setGrandTotal($this->getGrandTotal() + $od->getTotalAmount());
        }
        $subject->setGrandTotal($this->getGrandTotal());
    }

    function getGrandTotal() {
        return $this->grandTotal;
    }

    function setGrandTotal($grandTotal) {
        $this->grandTotal = $grandTotal;
    }

}

?>