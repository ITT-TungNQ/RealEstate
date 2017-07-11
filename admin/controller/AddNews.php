<?php

// ========== start - CHECK LOGIN AND ROLE ==========
require_once('../util/Constant.php');
require ('../include/check-role.php');
require_once('../util/AccessDatabase.php');
checkRole(Constants::CREATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========
// GET NEW NEWS DATA FROM CLIENT:
if (isset($_POST['new-news'])) {
    $conn = getConnection();
    $newsTypeID = $_POST['typeID'];
    $lineage = mysqli_real_escape_string($conn, $_POST['lineage']);
    $tittle = mysqli_real_escape_string($conn, $_POST['tittle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $illustrationURL = mysqli_real_escape_string($conn, $_POST['description']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $acreage = $_POST['acreage'];
    $price = $_POST['price'];
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $direction = $_POST['direction'];
    $room = $_POST['room'];
    $isHire = $_POST['isHire'];
    $state = $_POST['isHire'];

  

    /* ========== UPLOAD IMAGE TO SERVER ========== */
    if (isset($_FILES["profile_picture"]["type"]) && $_FILES["profile_picture"]["name"] != "") {
        $max_size = 5 * 1024 * 1024; // 5MB
        $destination_directory = "./../image/";
        $validextensions = array("jpeg", "jpg", "png");

        $temporary = explode(".", $_FILES["profile_picture"]["name"]);
        $file_extension = end($temporary);

        // We need to check for image format and size again, because client-side code can be altered
        if ((($_FILES["profile_picture"]["type"] == "image/png") ||
                ($_FILES["profile_picture"]["type"] == "image/jpg") ||
                ($_FILES["profile_picture"]["type"] == "image/jpeg") ) && in_array($file_extension, $validextensions)) {
            if ($_FILES["profile_picture"]["size"] < ($max_size)) {
                if ($_FILES["profile_picture"]["error"] > 0) {
                    echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">Lỗi: <strong>" . $_FILES["profile_picture"]["error"] . "</strong></div>";
                } else {
                    $util = new Utils();
                    $file_name = $util->gen_uuid() . '.jpg';
                    while (file_exists($destination_directory . $file_name)) {
                        $file_name = $util->gen_uuid() . '.jpg';
                    }

                    $sourcePath = $_FILES["profile_picture"]["tmp_name"];
                    $targetPath = $destination_directory . $file_name;
                    move_uploaded_file($sourcePath, $targetPath);

                    $illustrationURL = 'http://192.168.1.220:8080/RealEstate/image/' . $file_name;
                }
            } else {
                echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Kích thước ảnh của bạn: " + (file . size / 1024) . toFixed(2) + " KB<br/>Kích thước tối đa: " + (maxsize / 1024 / 1024) . toFixed(2) + " MB</div>";
            }
        } else {
            echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Định dạng ảnh không được hỗ trợ.<br/>- Định dạng cho phép: JPG, JPEG, PNG.</div>";
        }
    } else {
        $illustrationURL = "http://192.168.1.220:8080/RealEstate/image/310x150_001.jpg";
    }

    /* ========== ISERT TO DB ========== */
    $sql="INSERT INTO `news`(`NewsTypeID`, `Lineage`, `Title`, `IllustrationURL`, `Description`, `Details`, `LastUpdated`, `ViewNumber`, `Acreage`, `Price`, `Contact`, `Direction`, `Rooms`, `IsHire`, `State`) "
            . "VALUES ('$newsTypeID','$lineage','$tittle','$illustrationURL','$description','$detail','current_date()',0,'$acreage','$price','$contact','$direction','$room','$isHire','$state')";
    if (mysqli_query($conn, $sql)) {
        // echo "Records inserted successfully.";
        header("location: http://192.168.1.220:8080/RealEstate/admin/news-manager.php");
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        setcookie('insert_err', 'SQL ERROR: Đã xảy ra lỗi khi thêm bài đăng mới.', time() + 36000, '/RealEstate/admin');
        header("Location: http://192.168.1.220:8080/RealEstate/admin/add-new-news.php");
    }

    mysqli_close($conn);
    exit();
} else {
    mysqli_close($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/add-new-news.php");
}
?>