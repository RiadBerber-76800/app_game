<?php
 // nom des variables
    $files_name = $_FILES["url_img"]["name"];
    $files_size = $_FILES["url_img"]["size"];
    $files_tmp = $_FILES["url_img"]["tmp_name"];
    $files_type = $_FILES["url_img"]["type"];

    //2- Verifie la taille de l'image
    $sizeMax = 2000000; //2mo pour la taille de l'image
    if($files_size <= $sizeMax) {
        // 3- on vérifie l'extention du fichier
        // 3a je récupère le chemin du fichier
        $fileInfo = pathinfo($files_name); //tomate.jpeg
        // 3b Je récupère l'extension du fichier
        $extension = $fileInfo["extension"];
        // 3c je choisis les extensions autorisées, est ce que l'extension du fichier fait parti du tableau ci dessous
        $allowed_extensions = ["jpg", "jpeg", "png", "svg"];
        // 3d je vérifie que l'extension du fichier à ulploader est dans le tableau allowed_extensions
        if (in_array($extension,$allowed_extensions)) {
            $new_img_name = uniqid('IMG-',true).".".$extension;
            // $GLOBALS[]
            $img_upload_path = 'public/uploads/'.$new_img_name;  //uploads/Img-dskdhfksdj.jpg mettre dans le dossier uploads!!
            move_uploaded_file($files_tmp, $img_upload_path);
        } else {
            $error ["url_img"] = "<span class=text-red-500>Type de fichier incorrect (jpg,jprg,png,svg)</span>";
        }

    } else {
        $error["url_img"] = "<span class=text-red-500>File too big (max 2mo)</span>";
    }