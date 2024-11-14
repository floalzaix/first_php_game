<?php

require_once("personnage.php");
class BddManager {
    private $pdo;

    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost; dbname=first_php_game", "root", "");
    }

    function getPersonnage($name) : ?Personnage {
        $sql = "SELECT * FROM personnages WHERE name = :name";
        $query = $this->pdo->prepare($sql);
        $query->execute(["name" => $name]);
        if ($query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $personnage = new Personnage($row["name"]);
            $personnage->setId($row["id"]);
            $personnage->setDeg($row["deg"]);
            $personnage->setPv(($row["pv"]));
            return $personnage;
        } else if($query->rowCount() > 1) {
            echo "Erreur plus d'un robot enregistré dans la bdd avec le même nom";
            return null;
        } else {
            return null;
        }
    }

    function getAllPersonnages() : array {
        $sql = "SELECT * FROM personnages";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $personnages = [];
        $names = [];
        foreach ($query as $row) {
            $personnage = new Personnage($row["name"]);
            $names[] = $row["name"];
            $personnage->setId($row["id"]);
            $personnage->setDeg($row["deg"]);
            $personnage->setPv(($row["pv"]));
            $personnages[] = $personnage;
        }
        return [$personnages, $names];
    }

    function savePersonnage(Personnage $personnage) : void {
        $present = $this->getPersonnage($personnage->getName());
        if (isset($present)) {
            $sql = "UPDATE personnages SET pv = :pv, deg = :deg WHERE name = :nom";
        } else {
            $sql = "INSERT INTO personnages(name, deg, pv) VALUE (:nom, :deg, :pv)";
        }
        $query = $this->pdo->prepare($sql);
        $query->execute(["nom" => $personnage->getName(), "deg" => $personnage->getDeg(), "pv" => $personnage->getPv()]);
    }

    function delPersonnage(Personnage $name) : ?bool {
        $perso = $this->getPersonnage($name);
        if (!isset($perso)) {
            return false;
        } else {
            $sql = "DELETE FROM personnages WHERE name = :name";
            $query = $this->pdo->prepare($sql);
            $query->execute(["name" => $name]);
        }
        return true;
    }
}

?>
