<?php

class Personnage {
    protected $id;
    protected $name;
    protected $deg;
    protected $pv;

    function __construct($name) {
        $this->name = $name;
        $this->deg = 0;
        $this->pv = 100;
    }
    function takeHit($deg) {
        $this->pv-= $deg;
        $this->deg+= mt_rant(3, 10);
    }
    function hit($target) : void {
        $target->takeHit($this->deg);
    }

    //Getters setters
    function setId($id) {
        $this->id = $id;
    }
    function getId() : int {
        return $this->id;
    }
    function setName($name) {
        $this->name = $name;
    }
    function getName() : string {
        return $this->name;
    }
    function setDeg($deg) {
        $this->deg = $deg;
    }
    function getDeg() : int {
        return $this->deg;
    }
    function setPv($pv) {
        $this->pv = $pv;
    }
    function getPv() : int {
        return $this->pv;
    }
}

?>