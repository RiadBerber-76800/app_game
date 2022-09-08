<!-- header -->
<?php
    // inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
    
    require_once("models/Game.php");

    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien
    $model = new Game();
    
    $game= $model->getGame();
    $title = $game['name']; // title of current page
    require("view/showPage.php");
    
?>



