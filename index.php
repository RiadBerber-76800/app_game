<!-- header -->
<?php
/**
 * This file shows the home page
 */

    session_start();
    /**
     * get all games from models and stock it in array $games
     */
    
    require_once("models/Game.php");
    $model = new Game();
    $games = $model->getAllGames();
    
    /**
     * 
     * Show View
     */
    
    require("view/homePage.php");

?>
    
