<?php
// 6a- On démarre la session une fois les 5 parties faites
session_start();

include('../helpers/functions.php'); //include function
// 1- connection à ma BDD
// inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
require_once("../helpers/pdo.php");
require_once("../sql/delete-sql.php");



// 6b- redirection (suite de la session)
$_SESSION["success"] = "Le jeu est supprimé ! ";
header("Location:index.php");