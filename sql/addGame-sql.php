<?php
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