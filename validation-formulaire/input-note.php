<?php
//note
if (!empty($note)) {
  if (!is_numeric($note) && !is_float($note)) {
    $error["note"] = "<span class=text-danger>Veuillez rentrer un nombre !</span>";
  } elseif (
    $note < 0
  ) {
    $error["note"] = "<span class=text-danger>Veuillez rentrer une note sup à 0 !</span>";
  } elseif (
    $note > 10
  ) {
    $error["note"] = "<span class=text-danger>Veuillez rentrer une note inferieur à 10 !</span>";
  }
} else {
  $error["note"] = $errorMessage;
}
