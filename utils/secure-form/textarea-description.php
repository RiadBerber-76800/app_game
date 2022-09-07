<?php
// description
if (!empty($description)) {
  if (strlen($description) <= 30) {
    $error["description"] = "<span class=text-red-500>*30 caractères minimum</span>";
  } elseif (strlen($description) > 300) {
    $error["description"] = "<span class=text-red-500>*300 caractères maximum</span>";
  }
} else {
  $error["description"] = $errorMessage;
}