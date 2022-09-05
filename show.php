<!-- header -->
<?php
    require_once("models/database.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien

    // 1- On vérifie qu'on récupère id existant du jeu
    // On vérifie que id existe (cad pas vide) et qu'il est numérique
   $game = getGame();
   $title = $game['name'];
   require("view/showPage.php");
?>



 