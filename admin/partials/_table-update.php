<?php 
include("../helpers/pdo.php");
require_once("../sql/selectAll-sql.php") 
?>
<!-- table -->
    <div class="overflow-x-auto mt-16">
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Prix</th>
                    <th>Modifier</th>
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
                            <td><?= $game['price'] ?></td>
                            <td>
                                <!-- update btn bouton modifier -->
                                <a href="modifier-game.php?id=<?= $game["id"] ?>&name=<?=$game["name"] ?>" class="btn btn-success text-white">Modifier</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    <!-- http://localhost/php/app_game/show.php -->
                <?php } ?>
            </tbody>
        </table>
    </div>