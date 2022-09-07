<?php

$title = "Accueil"; 
ob_start();
require("partials/_create.php");

// crée une variable -> stock

$content = ob_get_clean();
// recupère sauvegarder dans un emplacement virtuel
// depose ici et nettoie le virtuel
require("layout.php"); 