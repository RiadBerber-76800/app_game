<?php

//  1- On écrit la requête
$sql = "UPDATE jeux SET name = :name, price = :price, genre = :genre, note = :note, plateforms = :plateforms, description = :description, PEGI = :PEGI, updated_at = NOW() WHERE id= :id";

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

// 4- execute la requête
$query->execute();

// 5- Redirection
$_SESSION["success"] = "Le jeu a bien été updaté";
header("Location: index.php");