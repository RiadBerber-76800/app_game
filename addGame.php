<!-- header -->
<?php
    // start session
    session_start();
    /**
     * This file show form for create a new page
     */
    $title = "Afficher jeux"; // title for current page
    // include("_header.php"); // include header
    require_once("models/database.php");

    $error = [];
    $errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";

    if (!empty($_POST["submited"]) && isset($_FILES["url_img"]) && $_FILES["url_img"]["error"] == 0) {
    create($error); 
    }
    require("view/createPage.php")
?>

