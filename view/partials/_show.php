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
        <a href="update.php?id=<?= $game["id"] ?>&name=<?=$game["name"] ?>" class="btn btn-success text-white">Modifier</a>
       <!-- delete -->
        <?php include("_modal.php") ?>
        
    </div>
</main>