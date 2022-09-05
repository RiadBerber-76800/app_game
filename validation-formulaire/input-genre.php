<?php
//On vérifie que le user a selectionné quelque chose sinon message obligatoire
if (!empty($tableau_propre_de_genre)) {
  if(in_array("Aventure", $tableau_propre_de_genre) || in_array("Course", $tableau_propre_de_genre) || in_array("RPG", $tableau_propre_de_genre) || in_array("FPS", $tableau_propre_de_genre) ) {

  } else {
    $error["genre"] = "<span class=text-red-500>C'est bizarre ces valeurs, n'existent pas</span> ";
  }
} else {
  $error["genre"] = $errorMessage;
}