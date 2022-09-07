<?php
require("utils/helpers/functions.php");
/**
* Get connexion with DB (database)
* @return PDO
*/
function getPDO(): PDO
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
    $id= getId();
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

/**
 * This function delet an item
 * @return void
 */
function delete(): void
{
    $pdo = getPDO();
    $id= getId();


    // 3- requête vers BDD
    $sql = "DELETE FROM jeux WHERE id=?";

    // 4- Je prépare ma requête (query)
    $query = $pdo->prepare($sql);

    // 5- On execute la requête (query)
    $query->execute([$id]);

    // redirect (6b- redirection (suite de la session))
    $_SESSION["success"] = "Le jeu est supprimé ! ";
    header("Location:index.php");
}


/**
 * This function create a new item
 * 
 * @param array $error
 * @return void
 */
function create($nom, $price, $tableau_propre_de_genre, $tableau_propre_de_plateforms, $note, $description, $pegi, $url_img): void
{
   
        $pdo = getPDO();
        // 1- Ecriture de la requête (attention: noter name etc... à partir du tableau phpmyadmin d'où PEGI)
        $sql = "INSERT INTO jeux(name, price, genre, note, plateforms, description, PEGI, created_at, url_img) VALUES(:name, :price, :genre, :note, :plateforms, :description, :PEGI, NOW(), :url_img)";

        // 2- On prépare la requête
        $query = $pdo->prepare($sql);

        // 3- On associe chaque requête à sa valeur et protection contre injection SQL
        $query->bindValue(':name', $nom, PDO::PARAM_STR);
        // STMT = Float, nombre à virgule)
        $query->bindValue(':price', $price, PDO::PARAM_STMT); 
        $query->bindValue(':genre', implode("|", $tableau_propre_de_genre), PDO::PARAM_STR); 
        $query->bindValue(':plateforms', implode("|", $tableau_propre_de_plateforms), PDO::PARAM_STMT);
        $query->bindValue(':note', $note, PDO::PARAM_STMT);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':PEGI', $pegi, PDO::PARAM_STR);
        $query->bindValue(':url_img', $url_img, PDO::PARAM_STR);

        // 4- On execute la requête
        $query->execute();

        // 5- Redirection vers home
        $_SESSION["success"] = "Le jeu a bien été ajouté";
        header("Location: index.php");
        die;
    
}

function update($nom, $price, $tableau_propre_de_genre, $tableau_propre_de_plateforms, $note, $description, $pegi, $url_img ): void
{
        $pdo = getPDO();
        $id= getId();
        //  1- On écrit la requête
        $sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, url_img = :url_img, PEGI = :PEGI, updated_at = NOW() WHERE id= :id";

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
        die;
    
}