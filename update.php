<?php
// on démarre la session ici
    session_start();
    $title = "Afficher jeux"; // title for current page
    
    require_once("models/database.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien
    $game = getGame();
    // création array error
    $error = [];
    $errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";
   
    
    if (!empty($_POST["submited"])) {
        update($error);  
    }
     require_once("view/updatePage.php");
    
?>
