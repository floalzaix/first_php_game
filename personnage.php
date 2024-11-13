<?php

require_once("bdd_manager.php");
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
    function takeHit($deg, BddManager $bdd_manager) {
        $this->pv-= $deg;
        $this->deg+= mt_rant(3, 10);
        if($this->pv <= 0) {
            $bdd_manager->delPersonnage($this->name);
        }
    }
    function hit($target, BddManager $bdd_manager) : void {
        $target->takeHit($this->deg, $bdd_manager);
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