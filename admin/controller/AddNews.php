<?php

// ========== start - CHECK LOGIN AND ROLE ==========
require_once './../util/Constant.php';
require './../include/check-role.php';
require_once './../util/AccessDatabase.php';
require_once './../util/Utils.php';
checkRole(Constants::CREATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========
// GET NEW NEWS DATA FROM CLIENT:
if (isset($_POST['new-news'])) {
    $conn = getConnection();
    $title = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'title'));
    $newsTypeID = filter_input(INPUT_POST, 'typeID');
    $lineage = "/0/" . filter_input(INPUT_POST, 'provinceID') . "/" . filter_input(INPUT_POST, 'districtID') . "/";
    if (filter_input(INPUT_POST, 'wardID') != '0') {
        $lineage .= filter_input(INPUT_POST, 'wardID') . "/";
    }
    $address = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'address'));
    $description = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'description'));
    $illustrationURL = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'description'));
    $detail = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'detail'));
    $area_unit = filter_input(INPUT_POST, 'dien_tich');
    $acreage = filter_input(INPUT_POST, 'acreage');
    if ($area_unit == 2) {
        $acreage *= 10000;
    }

    $price = filter_input(INPUT_POST, 'price');
    $direction = filter_input(INPUT_POST, 'direction');
    $room = filter_input(INPUT_POST, 'room');
    $isHire = filter_input(INPUT_POST, 'isHire') == 1 ? true : 0;
    $state = filter_input(INPUT_POST, 'state') == 1 ? true : 0;
    $contact = "{";
    $contact .= '"owner_name" : "' . filter_input(INPUT_POST, 'contact_name') . '",';
    $contact .= '"phone_number" : "' . filter_input(INPUT_POST, 'contact_phone') . '",';
    $contact .= '"email" : "' . filter_input(INPUT_POST, 'contact_mail') . '"';
    $contact .= "}";
    $contact = mysqli_real_escape_string($conn, $contact);

    /* ========== UPLOAD IMAGE TO SERVER ========== */
    if (isset($_FILES["illustrationURL"]["type"]) && $_FILES["illustrationURL"]["name"] != "") {
        $max_size = 5 * 1024 * 1024; // 5MB
        $destination_directory = (__DIR__) . "/../img/post/";
        $validextensions = array("jpeg", "jpg", "png");

        $temporary = explode(".", $_FILES["illustrationURL"]["name"]);
        $file_extension = end($temporary);

        // We need to check for image format and size again, because client-side code can be altered
        if ((($_FILES["illustrationURL"]["type"] == "image/png") ||
                ($_FILES["illustrationURL"]["type"] == "image/jpg") ||
                ($_FILES["illustrationURL"]["type"] == "image/jpeg") ) && in_array($file_extension, $validextensions)) {
            if ($_FILES["illustrationURL"]["size"] < ($max_size)) {

                if ($_FILES["illustrationURL"]["error"] > 0) {
                    echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">Lỗi: <strong>" . $_FILES["illustrationURL"]["error"] . "</strong></div>";
                } else {
                    $util = new Utils();
                    $file_name = $util->gen_uuid() . '.jpg';
                    while (file_exists($destination_directory . $file_name)) {
                        $file_name = $util->gen_uuid() . '.jpg';
                    }

                    $sourcePath = $_FILES["illustrationURL"]["tmp_name"];
                    $targetPath = $destination_directory . $file_name;
                    move_uploaded_file($sourcePath, $targetPath);

                    $illustrationURL = 'http://192.168.1.220:8080/RealEstate/admin/img/post/' . $file_name;
                }
            } else {
                echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Kích thước ảnh của bạn: " + (file . size / 1024) . toFixed(2) + " KB<br/>Kích thước tối đa: " + (maxsize / 1024 / 1024) . toFixed(2) + " MB</div>";
            }
        } else {
            echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Định dạng ảnh không được hỗ trợ.<br/>- Định dạng cho phép: JPG, JPEG, PNG.</div>";
        }
    } else {
        $illustrationURL = "http://192.168.1.220:8080/RealEstate/admin/img/illustration-no-image.png";
    }

    /* ========== ISERT TO DB ========== */
    mysqli_autocommit($conn, false);
    $sql = "INSERT INTO `news`  (`NewsTypeID`, `Lineage`, `Title`, `IllustrationURL`, `Description`, `Details`, `LastUpdated`, `ViewNumber`, `Acreage`, `Price`, `Contact`, `Direction`, `Rooms`, `IsHire`, `State`) "
            . "VALUES           ('$newsTypeID','$lineage','$title','$illustrationURL','$description','$detail', now(), 0,           '$acreage','$price','$contact','$direction','$room', $isHire, $state);";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn)) {
            $newsID = $conn->insert_id;
            if (insertNewsLog($newsID, Constants::LOG_CREATING, $conn)) {
                // Commit transaction
                mysqli_commit($conn);
                closeConnect($conn);
                
                echo "Records inserted successfully.";
                header("location: http://192.168.1.220:8080/RealEstate/admin/quan-ly-bai-dang");
            }
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        header("Location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
    }

    mysqli_close($conn);
    exit();
} else {
    mysqli_close($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/them-bai-dang-moi");
}

function insertNewsLog($newsID, $type, $conn) {
    $sql = "INSERT INTO news_log (`UserID`, `NewsID`, `LogType`, `LogTime`) "
            . "VALUES ('" . $_SESSION['login_user']['UserID'] . "', '" . $newsID . "', '" . $type . "', '" . date('Y-m-d H:i:s') . "');";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn)) {
            return true;
        } else {
            return false;
        }
    }
}
?>