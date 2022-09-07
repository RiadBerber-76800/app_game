<!-- header -->
<?php

    
    // inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
    require_once("models/database.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien
    

    
    $game = getGame();

    $title = $game['name']; // title of current page
     /**
     * Show View
     */
     require("view/showPage.php");
    
?>



