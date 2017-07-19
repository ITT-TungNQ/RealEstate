<?php
session_start();
require_once (__DIR__) . '/../util/Utils.php';

if (!isset($_FILES['local-image'])) {
    header('location: http://192.168.1.220:8080/RealEstate/page-not-found');
    exit();
}

if (isset($_FILES["local-image"]["type"]) && $_FILES["local-image"]["name"] != "") {
    $max_size = 5 * 1024 * 1024; // 5MB
    $destination_directory = (__DIR__) . "/../img/post/";
    $validextensions = array("jpeg", "jpg", "png");

    $temporary = explode(".", $_FILES["local-image"]["name"]);
    $file_extension = end($temporary);

    // We need to check for image format and size again, because client-side code can be altered
    if ((($_FILES["local-image"]["type"] == "image/png") ||
            ($_FILES["local-image"]["type"] == "image/jpg") ||
            ($_FILES["local-image"]["type"] == "image/jpeg") ) && in_array($file_extension, $validextensions)) {
        if ($_FILES["local-image"]["size"] < ($max_size)) {
            if ($_FILES["local-image"]["error"] > 0) {
                echo 'error';
            } else {
                $util = new Utils();
                $file_name = $util->gen_uuid() . '.jpg';
                while (file_exists($destination_directory . $file_name)) {
                    $file_name = $util->gen_uuid() . '.jpg';
                }

                $sourcePath = $_FILES["local-image"]["tmp_name"];
                $targetPath = $destination_directory . $file_name;
                move_uploaded_file($sourcePath, $targetPath);

                echo 'http://192.168.1.220:8080/RealEstate/admin/img/post/' . $file_name;
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'error';   
}
?>
