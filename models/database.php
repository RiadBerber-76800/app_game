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