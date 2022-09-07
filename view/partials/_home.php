<div class=" pt-16 wrap_content" >
    <!-- head content -->
    <div class=" wrap_content-head text-center">
        <?php $main_title = "App Game";
        include("view/partials/_h1.php") ?>
        
        <p>L'app qui répertorie vos jeux</p>
        
        <!-- ajouter un jeu button for add game-->
        <div class="pt-4">
            <a href="addGame.php" class="btn bg-primary-500" >Add Game</a>
        </div>



        <?php require_once("view/partials/_alert.php") ?>
        
        
    </div>
    
    <!-- table -->
    <div class="overflow-x-auto mt-16">
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Plateforme</th>
                    <th>Prix</th>
                    <th>PEGI</th>
                    <th>voir</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $index = 1;
                    if(count($games) == 0 ) {
                        echo"<tr><td class='text-center'>Pas de jeux disponibles actuellement</td></tr>";
                    } else { ?>
                        <?php foreach($games as $game): ?>
                        <tr class="hover:text-blue-500">
                            <th><?= $index++ ?></th>
                            <td><a class="hover:text-blue-500 hover:underline" href="show.php?id=<?=$game['id'] ?>&name=<?= $game['name'] ?>&genre=<?= $game['genre']?>"><?= $game['name'] ?></a></td>
                            <td><?= $game['genre'] ?></td>
                            <td><?= $game['plateforms'] ?></td>
                            <td><?= $game['price'] ?></td>
                            <td><?= $game['PEGI'] ?></td>
                            <td>
                                <a href="show.php?id=<?=$game['id'] ?>&name=<?= $game['name']?>&genre=<?= $game['genre']?>"> 
                                    <img src="img/loupe.png" alt="loupe" class="w-4 hover:text-blue-500">
                                </a>
                            </td>
                            <td>
                                <?php include("view/partials/_modal.php") ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <!-- http://localhost/php/app_game/show.php -->
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</div>