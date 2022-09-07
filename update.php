<?php
    session_start();
    $title = "Afficher jeux"; // title for current page
    
    // inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
    require_once("models/database.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien
    $game = getGame();

    $title = $game['name']; // title of current page
    // création array error
    $error = [];
    $errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";
    
    

    
    

    // 2- On envoie vers la BDD
    if (!empty($_POST["submited"])) {
        
            require_once("utils/secure-form/include.php");
        if (count($error) == 0){
            update($nom, $price, $tableau_propre_de_genre, $tableau_propre_de_plateforms, $note, $description, $pegi, $url_img);
        }
        
        
    }

    require("view/updatePage.php");

