<?php
// 2- Je récupère id dans URL et je nettoie
$id = clear_xss($_GET["id"]);

// 3- requête vers BDD
$sql = "DELETE FROM jeux WHERE id=?";

// 4- Je prépare ma requête (query)
$query = $pdo->prepare($sql);

// 5- On execute la requête (query)
$query->execute([$id]);