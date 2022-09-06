<div class="pt-16">
  <a href="index.php" class="text-blue-400 text-sm"><- retour</a>
    <?php $main_title = "Modifier le jeu";
      include("_h1.php") ?>
    <form action="" method="POST" enctype="multipart/form-data">
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
      
      <!-- upload image img -->
    <div class="py-3 ">
      <label for="url_img" class="font-semibold text-gray-100 ">Votre image</label>
      <input type="file" class="block mt-3 " id="url_img" name="url_img">
      <p>
        <?php
        if (!empty($error["url_img"])) {
          echo $error["url_img"];
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