<?php
//plateforms
if (!empty($tableau_propre_de_plateforms)) {
   if(in_array("Switch", $tableau_propre_de_plateforms) || in_array("Xbox", $tableau_propre_de_plateforms) || in_array("PS4", $tableau_propre_de_plateforms) || in_array("PS5", $tableau_propre_de_plateforms) || in_array("PC", $tableau_propre_de_plateforms) ) {

  } else {
    $error["platforms"] = "<span class=text-red-500>C'est bizarre ces valeurs, n'existent pas</span> ";
  }
} else {
  $error["platforms"] = $errorMessage;
}
