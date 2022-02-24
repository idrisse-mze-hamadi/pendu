<?php
session_start();
session_destroy();

/**
 * REQUEST_URI correspond à l'url sur laquelle nous sommes actuellement 
 * Elle permet d'afficher les bons include dans le header
 */
$REQUEST_URI = explode("/", $_SERVER["REQUEST_URI"]);

/**
 * On stock les mots sous forme de tableau
 */
$listeDeMots = file("mots.txt");

/**
 * Si le formulaire d'ajout de mot est utilisé,
 * alors on ajoute le mot à la fin de la liste de mots
 */
if (isset($_REQUEST["mot"])) {
    $mot = $_REQUEST["mot"] . "\n";
    file_put_contents("mots.txt", $mot, FILE_APPEND);
    header("Location: admin.php");
}

/**
 * On supprime dans un premier temps tout le texte dans mots.txt
 * Puis nous rajoutons chaaque mot sauf celui qui est censé 
 * être supprimé
 */
if (isset($_REQUEST["supprimerMot"])) {
    file_put_contents("mots.txt", "");
    foreach ($listeDeMots as $mot) {
        if (trim($mot) != $_REQUEST["supprimerMot"]) {
            file_put_contents("mots.txt", trim($mot) . "\n", FILE_APPEND);
        }
    }
    header("Location:admin.php");
}

include("vue/header.php");
include("vue/footer.php");
