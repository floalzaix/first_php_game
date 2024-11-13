<?php

require_once("personnage.php");
class BddManager {
    private $pdo;

    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=first_php_game", "flooooo", "0");
    }

    function getPersonnage($name) : ?Personnage {
        $sql = "SELECT * FROM personnages WHERE name = :name";
        $query = $this->pdo->prepare($sql);
        $query->execute(["name" => $name]);
        if ($query->rowCount() == 1) {
            $personnage = new Personnage($query[0]["name"]);
            $personnage->setId($query[0]["id"]);
            $personnage->setDeg($query[0]["deg"]);
            $personnage->setPv(($query[0]["pv"]));
            return $personnage;
        } else if($query->rowCount() > 1) {
            echo "Erreur plus d'un robot enregistré dans la bdd avec le même nom";
            return null;
        } else {
            return null;
        }
    }

    function savePersonnage(Personnage $personnage) : void {
        $sql = "INSERT INTO personnages(name, deg, pv) VALUE (:nom, :deg, :pv)";
        $query = $this->pdo->prepare($sql);
        $query->execute(["nom" => $personnage->getName(), "deg" => $personnage->getDeg(), "pv" => $personnage->getPv()]);
    }
}

?>
