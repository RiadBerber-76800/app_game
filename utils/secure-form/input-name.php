<?php
// name
if (!empty($nom)) {
  if (
    strlen($nom) <= 2
  ) {
    $error["nom"] = "<span class=text-red-500>*3 caractères minimum</span>";
  } elseif (strlen($nom) > 100) {
    $error["nom"] = "<span class=text-red-500>*100 caractères maximum</span>";
  }
} else {
  $error["nom"] = $errorMessage;
};