<?php
require ("helpers/functions.php");
/**
 * Get connexion with Data Base (DB)
 * 
 * @return PDO
 */
function getPDO()
{

// 1 on définie les variables suivantes ($blabla)
$serveur = "localhost";
$dbname = "app_game";
$login = "root";
$password = ""; // pour windows "", pour mac "root" ici c'est windows


try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $login, $password, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        // Ne pas récupérer les élements dupliqués (qui sont en double)
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Pour afficher les errors 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
    // affiche un message ok connexion
    // echo "Connexion établie !";

    return $pdo;


} catch (PDOException $e) {
   echo "Erreur de connexion: ".$e->getMessage(); 
}
}
/**
 * This function return all games in array
 *  
 * @return array
*/

function getAllGames(): array
{
    $pdo = getPDO();
    
    $sql =  "SELECT * FROM  jeux ORDER BY name DESC"; //si l'on veut plus spécifique on remplace * par name, genre...

    $query = $pdo->prepare($sql);

    $query->execute();

    $games = $query->fetchAll();

    return $games;

}
/**
 * This function return current id of item
 * @return int
 */
function getId(): int
{

    if(!empty($_GET['id']) && is_numeric($_GET['id'])){
       $id = clear_xss($_GET['id']);
    
    } else {
    $_SESSION["error"]= "URL invalide !";
       header("Location: index.php");
    }
    return $id;
}

/**
 * This function return a single game
 * @return array
 */

function getGame(): array
{
    $pdo = getPDO();
    $id = getId();
    $sql = "SELECT * FROM jeux WHERE id=:id";

    $query = $pdo->prepare($sql);

    $query->bindvalue(':id',$id, PDO::PARAM_INT);

    $query->execute();

    $game= $query->fetch();

    if(!$game){
        $_SESSION["error"]= "Ce jeu n'est pas disponible !";
        header("Location: index.php");
    }
    return $game;
}



    