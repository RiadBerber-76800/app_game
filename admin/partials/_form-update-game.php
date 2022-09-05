<?php
// on démarre la session ici
    session_start();
    $title = "Afficher jeux"; // title for current page
    include('partials/_header.php'); //include header
    // petit rappel: La combinaison en dessous permet de voir le lien parfait 
    //   echo $_SERVER['PHP_SELF']
    include('../helpers/functions.php'); //include function
    // inclure PDO (pdo.php) pour la connexion à la BDD dans mon script
    require_once("../helpers/pdo.php");
    // debug_array($_GET)  //on peut vérifier si ça prend bien enn compte dans le lien

    // création array error
    $error = [];
    $errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";
    // variable success
    $success = false;

    
    // 1- verifie qu'on recupere id existant du jeux 
    // On vérifie que id existe (cad pas vide) et qu'il est numérique
    if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    // 2- Je nettoie mon id contre xss
        // $id = trim(htmlspecialchars($_GET['id']));  //pareil en dessous
        $id = clear_xss($_GET['id']); //car créé dans functions.php
    // 3- faire la query (requête) vers BDD
        $sql = "SELECT * FROM jeux WHERE id=:id";
    // 4- Préparation de la requête
        $query = $pdo->prepare($sql);
    // 5- Sécuriser la query (requête) contre injection sql
        $query->bindvalue(':id',$id, PDO::PARAM_INT);
    // 6- Execute la query vers la base de donnée BDD
        $query->execute();
    // 7- On stocke tout dans une variable le jeu récupéré
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

    // 2- On envoie vers la BDD
    if (!empty($_POST["submited"])) {
        require_once("../validation-formulaire/include.php");
        if(count($error) == 0){
        require_once("../sql/updateGame-sql.php");
        }
    }
?>
<div class="pt-16">
  <a href="index.php" class="text-blue-400 text-sm"><- retour</a>
    <?php $main_title = "Modifier le jeu";
      include("partials/_h1.php") ?>
    <form action="" method="POST">
      <!-- input for name -->
        <div class="mb-3">
          <label for="name" class="font-semibold text-blue-900">Nom</label>
          <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?= $game["name"]  ?>" />
          <p>
            <?php
            if (!empty($error["nom"])) {
            echo $error["nom"];
            }
            ?>
          </p>
        </div>
      <!-- input for price -->
        <div class="mb-3">
          <label for="price" class="font-semibold text-blue-900">Prix</label>
          <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block" value="<?= $game["price"] ?>" />
          <p>
            <?php
            if (!empty($error["price"])) {
            echo $error["price"];
            }
            ?>
          </p>
        </div>
      <!-- input for genre -->
        <?php
        $genreArray = [
          ["name" => "Aventure", "checked" => "checked"],
          ["name" => "Course"],
          ["name" => "FPS"],
          ["name" => "RPG"],
        ];

      // création new array (nouveau tableau) avec valeur de BDD en utilisant avec méthode explode
        $arr_genre = explode("|",$game["genre"]);
      // debug_array($arr_genre);

      ?>
      <h2 class="font-semibold text-blue-900">Genre</h2>
      <div class="mt-2 mb-3 flex space-x-6">
        <?php foreach ($genreArray as $genre) : ?>
          <div class="flex item-center space-x-3">
            <label><?= $genre["name"] ?></label>
            <input type="checkbox" name="genre[]" class="checkbox" value="<?= $genre["name"] ?>" 
              <?php 
              if (in_array($genre["name"],$arr_genre)) echo "checked";
              ?> />
          </div>
        <?php endforeach ?>
      </div>
      <p>
        <?php
        if (!empty($error["genre"])) {
        echo $error["genre"];
        }
        ?>
      </p>
      <!-- input for note -->
      <div class="mb-3">
        <label for="note" class="font-semibold text-blue-900">Note</label>
        <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block" value="<?= $game["note"] ?>" />
        <p>
          <?php
          if (!empty($error["note"])) {
          echo $error["note"];
          }
          ?>
        </p>
      </div>
      <!-- input for plateforms -->
      <?php
      $plateformArray = [
        ["name" => "Switch", "checked" => "checked"],
        ["name" => "Xbox"],
        ["name" => "PS4"],
        ["name" => "PS5"],
        ["name" => "PC"],
      ];
    
      //cration new array avec value de BDD en utilisant methode explode 
      $arr_plateform = explode("|", $game["plateforms"]);
      // debug_array($arr_plateform);
      ?>
      <h2 class="font-semibold text-blue-900">Plateforme</h2>
      <div class="mt-2 mb-3 flex space-x-6">
        <?php foreach ($plateformArray as $plateform) : ?>
          <div class="flex item-center space-x-3">
            <label><?= $plateform["name"] ?></label>
            <input type="checkbox" name="platforms[]" class="checkbox" value="<?= $plateform["name"] ?>" <?php 
            if (in_array($plateform["name"], $arr_plateform)) echo "checked"; ?> />
          </div>
        <?php endforeach ?>
      </div>
      <p>
        <?php
        if (!empty($error["platforms"])) {
          echo $error["platforms"];
        }
        ?>
      </p>
      <!-- input description -->
      <div class="mt-5">
        <label for="description" class="font-semibold text-blue-900">Description</label>
        <textarea name="description" class="textarea textarea-bordered block" placeholder="Description du jeu"><?= $game["description"] ?></textarea>
        <p>
          <?php
          if (!empty($error["description"])) {
            echo $error["description"];
          }
          ?>
        </p>
      </div>
      <!-- select for PEGI -->
      <?php
      $pegiArr = [
        ["name" => 3],
        ["name" => 7],
        ["name" => 12],
        ["name" => 16],
        ["name" => 18],
      ]

      ?>
      <div class="">
        <h2 class="font-semibold text-blue-900 pt-4 pb-2">PEGI</h2>
        <select class="select select-bordered w-full max-w-xs" name="pegi">
          <option disabled selected>Choose ?</option>
          <?php foreach ($pegiArr as $pegi) : ?>
            <option value="<?= $pegi["name"] ?>" <?php 
                                                  //je sauvegarde en memoire ce que le user a choisi
                                                  if ($game["PEGI"] == $pegi["name"]) echo 'selected="selected"'?>>
              <?= $pegi["name"] ?>
            </option>
          <?php endforeach ?>
        </select>
        <p>
          <?php
          if (!empty($error["pegi"])) {
            echo $error["pegi"];
          }
          ?>
        </p>
      </div>
      <!-- input id -->
      <input type="hidden" name="id" value="<?= $game["id"] ?>">
      <!-- submit btn -->
      <div class="mt-4">
        <input type="submit" name="submited" value="Modifier" class="btn bg-blue-500">
      </div>
    </form>
</div>