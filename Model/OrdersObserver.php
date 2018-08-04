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
        
    }

    public function update(AbstractSubject $subject) {
        $grandTotal = 0;
        foreach ($subject->getAllOD() as $od) {
            $grandTotal += $od->getTotalAmount();
        }
        $subject->setGrandTotal($grandTotal);
    }

}

?>