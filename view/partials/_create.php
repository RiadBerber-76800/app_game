<section class="py-12">
  <a href="index.php" class="text-blue-400 text-sm"><- retour</a>
  <h1 class="text-blue-500 text-5xl uppercase font-black text-center pb-8">Ajouter un jeu</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <!-- input for name -->
    <div class="mb-3">
      <label for="name" class="font-semibold text-blue-900">Nom</label>
      <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                if (!empty($_POST["name"])) {
                                                                                                  echo $_POST["name"];
                                                                                                } ?>" />
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
      <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                              if (!empty($_POST["price"])) {
                                                                                                                echo $_POST["price"];
                                                                                                              } ?>" />
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
    ]
    ?>
    <h2 class="font-semibold text-blue-900">Genre</h2>
    <div class="mt-2 mb-3 flex space-x-6">
      <?php foreach ($genreArray as $genre) : ?>
        <div class="flex item-center space-x-3">
          <label><?= $genre["name"] ?></label>
          <input type="checkbox" name="genre[]" class="checkbox" value="<?= $genre["name"] ?>" <?php if (!empty($_POST["genre"])){
            if (in_array($genre["name"], $_POST["genre"])) echo "checked";
          } ?> />
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
      <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                            if (!empty($_POST["note"])) {
                                                                                                              echo $_POST["note"];
                                                                                                            } ?>" />
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
    ]
    ?>
    <h2 class="font-semibold text-blue-900">Plateforme</h2>
    <div class="mt-2 mb-3 flex space-x-6">
      <?php foreach ($plateformArray as $plateform) : ?>
        <div class="flex item-center space-x-3">
          <label><?= $plateform["name"] ?></label>
          <input type="checkbox" name="platforms[]" class="checkbox" value="<?= $plateform["name"] ?>" <?php if (!empty($_POST["platforms"])) {
            if(in_array($plateform["name"], $_POST["platforms"])) echo "checked"; }?> />
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
      <textarea name="description" class="textarea textarea-bordered block" placeholder="Description du jeu"><?php if (!empty($_POST["description"])) {
                                                                                                                echo $_POST["description"];
                                                                                                              } ?></textarea>
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
          <option value="<?= $pegi["name"] ?>" 
          <?php 
            // Je sauvegarde en mémoire ce que le user a choisi
            if(!empty($_POST["pegi"])){
              if($_POST["pegi"] == $pegi["name"]) echo 'selected="selected"';
            }
            ?>>
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
    
    <!-- upload image img -->
    <div class="py-3 ">
      <label for="url_img" class="font-semibold text-blue-900 ">Votre image</label>
      <input type="file" class="block pt-3" id="url_img" name="url_img">
      <p>
        <?php
        if (!empty($error["url_img"])) {
          echo $error["url_img"];
        }
        ?>
      </p>
    </div>

    <!-- submit btn -->
    <div class="mt-4">
      <input type="submit" name="submited" value="Ajouter" class="btn bg-blue-500">
    </div>
  </form>
  
</section>
