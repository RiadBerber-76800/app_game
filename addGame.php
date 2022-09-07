<?php
session_start();
/**
 * this file shows form for create a new game
 */
$title = "Afficher jeux"; // title for current page

// inclure PDO pour la connexion a la BDD dans mon script
require_once("models/database.php");

// création array error
$error = [];
$errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";

// 1- je verifie que le btn submit fonctionne en affichant un message echo "Hourra"
if (!empty($_POST["submited"])) {
    require_once("utils/secure-form/include.php");
    if (count($error) == 0){
    create($nom, $price, $tableau_propre_de_genre, $tableau_propre_de_plateforms, $note, $description, $pegi, $url_img);}
}

require("view/createPage.php");


