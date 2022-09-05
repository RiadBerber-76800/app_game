<?php
  if (!empty($price)) {
    if (!is_numeric($price) && !is_float($price)) {
      $error["price"] = "<span class=text-red-500>Veuillez rentrer un nombre !</span>";
    } elseif (
      $price < 0
    ) {
      $error["price"] = "<span class=text-red-500>Veuillez rentrer un prix supérieur à 0€ !</span>";
    } elseif ($price > 200) {
      $error["price"] = "<span class=text-red-500>Veuillez rentrer un prix inférieur à 200€ !</span>";
    }
  } else {
    $error["price"] = $errorMessage;
  }