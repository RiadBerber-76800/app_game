<?php
if (!empty($description)) {
	if (strlen($description) <= 30) {
		$error["description"] = "<span class=text-danger>*30 caractères minimum</span>";
	}elseif (strlen($nom) > 300) {
		$error["description"] = "<span class=text-danger>*300 caractères maximun</span>";
	}
}else{
	$error["description"] = $errorMessage;
}
    // debug_array ($error);

    