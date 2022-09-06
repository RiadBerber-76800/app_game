<?php
require ("utils/helpers/functions.php");
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
/**
 * This function delete a item
 * @return void
 */
function delete(): void
{
    $pdo = getPDO();
    $id = getId();
    $id = clear_xss($_GET["id"]);

    $sql = "DELETE FROM jeux WHERE id=?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
// redirect

    $_SESSION["success"] = "Le jeu est supprimé ! ";
    header("Location:index.php");
}
/**
 * This function delete a item
 * @return void
 */
function create($error): void
{
   
     require_once("utils/security-form/include.php");
  
  if (count($error) == 0) {
$pdo = getPDO();
$sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at, url_img) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW(), :url_img)";
$query = $pdo->prepare($sql);
$query->bindValue(':name', $nom, PDO::PARAM_STR);
$query->bindValue(':price', $price, PDO::PARAM_STMT); 
$query->bindValue(':genre', implode("|", $tableau_propre_de_genre), PDO::PARAM_STR); 
$query->bindValue(':plateforms', implode("|", $tableau_propre_de_plateforms), PDO::PARAM_STMT);
$query->bindValue(':note', $note, PDO::PARAM_STMT);
$query->bindValue(':description', $description, PDO::PARAM_STR);
$query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);
$query->bindValue(':url_img', $url_img, PDO::PARAM_STR);

$query->execute();
$_SESSION["success"] = "Le jeu a bien été ajouté";
header("Location: index.php");
die;
  }
}
/**
 * 
 */

function update($error): void
{
    require_once("utils/security-form/include.php");
    if(count($error) == 0){
        $id = getId();    //  1- On écrit la requête
        $pdo = getPDO();
        $sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, PEGI = :PEGI, url_img = :url_img,  updated_at = NOW() WHERE id= :id";

        // 2- Preparatoin de la requête
        $query = $pdo->prepare($sql);

        // 3- protection SQL et en associant requête et valeur
        $query->bindvalue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':name', $nom, PDO::PARAM_STR);
        // STMT = Float, nombre à virgule)
        $query->bindValue(':price', $price, PDO::PARAM_STMT); 
        $query->bindValue(':genre', implode("|", $tableau_propre_de_genre), PDO::PARAM_STR); 
        $query->bindValue(':plateforms', implode("|", $tableau_propre_de_plateforms), PDO::PARAM_STMT);
        $query->bindValue(':note', $note, PDO::PARAM_STMT);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);
        $query->bindValue(':url_img', $url_img, PDO::PARAM_STR);

        // 4- execute la requête
        $query->execute();

        // 5- Redirection
        $_SESSION["success"] = "Le jeu a bien été updaté";
        header("Location: index.php");
    }
}

    