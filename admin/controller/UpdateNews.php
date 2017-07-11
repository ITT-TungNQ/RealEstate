<?php

require_once (__DIR__) . '/../util/Constant.php';
require_once (__DIR__) . '/dao/NewsDAO.php';
require_once (__DIR__) . '/../util/AccessDatabase.php';
/* ========= PHÊ DUYỆT BÀI ĐĂNG ========= */
if (isset($_POST['activate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/approval-news-page.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

if (isset($_POST['deactivate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DISABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        }
        header("location: http://192.168.1.220:8080/RealEstate/admin/approval-news-page.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

/* ========= THÙNG RÁC ========= */
if (isset($_POST['recover-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE, true);

        setcookie('change_to', Constants::ENABLE, time() + 36000, '/RealEstate/admin/news-trash.php');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/news-trash.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/news-trash.php');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/news-trash.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

if (isset($_POST['delete-news'])) {

    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DETELED);

        setcookie('change_to', Constants::DETELED, time() + 36000, '/RealEstate/admin/news-trash.php');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/news-trash.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/news-trash.php');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/news-trash.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

///DH

$conn = getConnection();
if (isset($_POST['update-news'])) {

    $newsTypeID = $_POST['typeID'];
    $lineage = mysqli_real_escape_string($conn, $_POST['lineage']);
    $tittle = mysqli_real_escape_string($conn, $_POST['tittle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $illustrationURL = mysqli_real_escape_string($conn, $_POST['description']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $acreage = $_POST['acreage'];
    $price = $_POST['price'];

    $direction = $_POST['direction'];
    $room = $_POST['room'];
    $isHire = $_POST['isHire'];
    $state = $_POST['isHire'];
    $newsID = $_POST['newsID'];
    $contact = "{";
    $contact .= '"owner_name" : "' . filter_input(INPUT_COOKIE, 'contact_name') . '",';
    $contact .= '"phone_number" : "' . filter_input(INPUT_COOKIE, 'contact_phone') . '",';
    $contact .= '"email" : "' . filter_input(INPUT_COOKIE, 'contact_mail') . '"';
    $contact .= "}";

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

    /* ========== UPDATE TO DB ========== */
    $sql = "UPDATE `news` SET `NewsTypeID`=$newsTypeID,`Lineage`='$lineage',`Title`='$tittle',`IllustrationURL`='$illustrationURL',`Description`='$description',`Details`='$detail',`LastUpdated`=current_date(),`ViewNumber`=0,`Acreage`='$acreage',`Price`=$price,`Contact`='$contact',`Direction`=$direction,`Rooms`=$room,`IsHire`=$isHire,`State`=$state "
            . "WHERE `NewsID` = " . $newsID . "";
    if (mysqli_query($conn, $sql)) {
        // echo "Records inserted successfully.";
        header("location: http://192.168.1.220:8080/RealEstate/admin/news-manager.php"); 
    } else {
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        setcookie('insert_err', 'SQL ERROR: Đã xảy ra lỗi khi thêm bài đăng mới.', time() + 36000, '/RealEstate/admin');
//         header("Location: http://192.168.1.220:8080/RealEstate/admin/news-details.php?newsID=' . $newsID . '");
    }

    mysqli_close($conn);
    exit();
} else {
    mysqli_close($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/news-details.php?newsID=' . $newsID . '");
}
?>