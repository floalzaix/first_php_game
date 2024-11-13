<?php

require_once("bdd_manager.php");
require_once("personnage.php");

session_start();

if (!isset($_SESSION["perso_selected"])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php' />";
}

$bdd_manager = new BDDManager();
$personnages = $bdd_manager->getAllPersonnages();

?>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Battleground</title>
    </head>
    <body>
        <h1>Vous etes au champs de bataille !</h1>
        <form action="battleground.php" method="post">
            <h5>Vous avez choisi : <?php echo "<h6> Nom : ".$_SESSION['perso_selected']->getName()."<br/>"."Dégâts : ".$_SESSION["perso_selected"]->getDeg()."<br/> PV : ".$_SESSION["perso_selected"]->getPV()."</h6>"; ?></h5>
            <h3>Veuillez choisir votre cible</h3>
            <p>
                <select id="list_target" name="list_taget">
                    <?php
                        $names = $personnages[1];
                        if (isset($_SESSION['perso_selected'])) {
                            foreach ($names as $name) {
                                if ($name != $_SESSION['perso_selected']->getName()) {
                                    echo "<option value=\"{$name}\">{$name}</option>";
                                }
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <h3>Actions possibles</h3>
                <input type="submit" id="submit_button" name="submit_button" value="Attaquer" />
            </p>
        </form>
        <a href="index.php">
            <button type="button">Changer de personnage</button>
        </a>
    </body>
</html>

<?php
    if (isset($_POST["submit_button"])) {
        $target = $bdd_manager->getPersonnage($_POST["list_taget"]);
        if (isset($target)) {
            $_SESSION["perso_selected"]->hit($target, $bdd_manager);
        } else {
            echo "<br/>Cible non valide";
        }
        $personnages = $bdd_manager->getAllPersonnages();
    }
?>
