<?php
require("database.php");
class Game
{
    /**
 * This function returns all games in array
 * @return array
 */
function getAllGames(): array
{
    $pdo = getPDO();
    // 1- Requête pour récupérer mes jeux / Query to get all games
    $sql =  "SELECT * FROM  jeux ORDER BY name DESC"; //si l'on veut plus spécifique on remplace * par name, genre...
    // 2- Prépare la requête (preformater la requête)
    $query = $pdo->prepare($sql);
    // 3- execute ma requête
    $query->execute();
    // 4- On stocke ma requête dans une variable / stock my query in variable
    $games = $query->fetchAll();
    // debug_array($games); //affiche le tabelau avec tous les objets
    return $games;
}
/**
 * !this function returns current id of item
 * @return int
 */
function getId(): int
{
    // 1- On vérifie qu'on récupère id existant du jeu
    // On vérifie que id existe (cad pas vide) et qu'il est numérique
    if(!empty($_GET['id']) && is_numeric($_GET['id'])){
         $id = clear_xss($_GET['id']); //car créé dans functions.php
    } else {
        $_SESSION["error"]= "URL invalide !";
            header("Location: index.php");
    }
    return $id;
}
/**
 * This function returns a single game
 * @return array
 */
function getGame(): array
{
    $pdo =getPDO();
    // 2- Je nettoie mon id contre xss
    // $id = trim(htmlspecialchars($_GET['id']));  //pareil en dessous
    $id= $this->getId();
    // 3- création la query (requête) vers BDD
    $sql = "SELECT * FROM jeux WHERE id=:id";
    // 4- Préparation de la requête
    $query = $pdo->prepare($sql);
    // 5- Sécuriser la query (requête) contre injection sql
    $query->bindvalue(':id',$id, PDO::PARAM_INT);
    // 6- Execute la query vers la base de donnée BDD
    $query->execute();
    // 7- On stocke tout dans une variable
    $game= $query->fetch();
    // debug_array($game);
    // $game=[]; //teste comment ça réagit lorsqu'il n'y a rien

    if(!$game){
        $_SESSION["error"]= "Ce jeu n'est pas disponible !";
        header("Location: index.php");
    }

    return $game;
}

}