<!-- header -->
<?php
// on démarre la session ici
    session_start();
    $title = "Afficher jeux"; // title for current page
    include('partials/_header.php'); //include header
    // petit rappel: La combinaison en dessous permet de voir le lien parfait 
    //   echo $_SERVER['PHP_SELF']
    include('helpers/functions.php'); //include function
    // inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
    require_once("helpers/pdo.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien

    // 1- On vérifie qu'on récupère id existant du jeu
    // On vérifie que id existe (cad pas vide) et qu'il est numérique
    if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    // 2- Je nettoie mon id contre xss
        // $id = trim(htmlspecialchars($_GET['id']));  //pareil en dessous
        $id = clear_xss($_GET['id']); //car créé dans functions.php
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
    } else {
        $_SESSION["error"]= "URL invalide !";
            header("Location: index.php");
    }
?>

<!-- main content -->
<main class="pt-16">
    <a href="index.php" class="text-blue-400 text-sm"><- retour</a>
    
    <h1 class="text-blue-500 text-5xl text-center uppercase font-black"><?= $game["name"] ?></h1>
    <?php 
      if($game["url_img"] != null) { ?>
        <img src="<?= $game["url_img"] ?>" alt="<?= $game["name"] ?>">
      <?php }
      ?>
    <p class="pt-4"><?= $game["description"] ?></p>
    <div class="pt-6 flex space-x-4">
        <p>Genre: <?= $game["genre"] ?></p>
        <p>Prix: <?= $game["price"] ?><span class="font-bold text-blue-500">€</span></p>
        <p>Note: <?= $game["note"] ?>/10</p>
    </div>
    <div class="">
        <!-- update btn bouton modifier -->
        <a href="modifier.php?id=<?= $game["id"] ?>&name=<?=$game["name"] ?>" class="btn btn-success text-white">Modifier</a>
       <!-- delete -->
        <?php include("partials/_modal.php") ?>
        
    </div>
</main>
<!-- end main content -->

<!-- footer -->
<?php 
    include('partials/_footer.php') //include footer
?> 