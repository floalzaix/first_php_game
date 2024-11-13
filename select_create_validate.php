<?php
    session_start();

    require_once("bdd_manager.php");
    require_once("personnage.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit_button"])) {
            $bdd_manager = new BDDManager();

            $perso = $bdd_manager->getPersonnage($_POST["name"]);

            if (isset($perso)) {
                $_SESSION['perso_selected'] = $perso;
            } else {
                $perso = new Personnage($_POST["name"]);

                $bdd_manager->savePersonnage($perso);

                $_SESSION['perso_selected'] = $perso;
            }

            echo "<meta http-equiv='refresh' content='0; url=battleground.php'>";
        }
    }
?>
