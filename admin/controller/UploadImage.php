<?php

session_start();

if (isset($_FILES["profile_picture"]["type"])) {
    $max_size = 5 * 1024 * 1024; // 5MB
    $destination_directory = "../img/user/";
    $validextensions = array("jpeg", "jpg", "png");

    $temporary = explode(".", $_FILES["profile_picture"]["name"]);
    $file_extension = end($temporary);

    // We need to check for image format and size again, because client-side code can be altered
    if ((($_FILES["profile_picture"]["type"] == "image/png") ||
            ($_FILES["profile_picture"]["type"] == "image/jpg") ||
            ($_FILES["profile_picture"]["type"] == "image/jpeg")
            ) && in_array($file_extension, $validextensions)) {
        if ($_FILES["profile_picture"]["size"] < ($max_size)) {
            if ($_FILES["profile_picture"]["error"] > 0) {
                echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">Lỗi: <strong>" . $_FILES["profile_picture"]["error"] . "</strong></div>";
            } else {
                if (file_exists($destination_directory . $_FILES["profile_picture"]["name"])) {
                    echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">Lỗi: File <strong>" . $_FILES["profile_picture"]["name"] . "</strong> đã tồn tại.</div>";
                } else {
                    $sourcePath = $_FILES["profile_picture"]["tmp_name"];
                    $targetPath = $destination_directory . $_FILES["profile_picture"]["name"];
                    move_uploaded_file($sourcePath, $targetPath);

                    echo 'http://192.168.1.220:8080/RealEstate/admin/img/user/' . $_FILES["profile_picture"]["name"];
                }
            }
        } else {
            echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Kích thước ảnh của bạn: " + (file . size / 1024) . toFixed(2) + " KB<br/>Kích thước tối đa: " + (maxsize / 1024 / 1024) . toFixed(2) + " MB</div>";
        }
    } else {
        echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Định dạng ảnh không được hỗ trợ.<br/>- Định dạng cho phép: JPG, JPEG, PNG.</div>";
    }
}
?>
