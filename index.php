<!-- header -->
<?php
/**
 * This file show the home page
 */
// session_start();
/**
 * get all games from models and stock it in array $games 
 */
require_once("models/database.php");
$games = getAllGames();
/**
 * Show view
 */
    require("view/homePage.php");
?>