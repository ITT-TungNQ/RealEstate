<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
require_once (__DIR__) . '/../util/Constant.php';
require_once (__DIR__) . '/dao/NewsDAO.php';
require_once (__DIR__) . '/../util/AccessDatabase.php';
require_once './../util/Utils.php';
checkRole(Constants::UPDATE_NEWS);

/* ========= PHÊ DUYỆT BÀI ĐĂNG ========= */
if (isset($_POST['activate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/phe-duyet-bai-dang');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/phe-duyet-bai-dang');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/phe-duyet-bai-dang");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
    }

    exit();
}

if (isset($_POST['deactivate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DISABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/phe-duyet-bai-dang');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/phe-duyet-bai-dang');
        }
        header("location: http://192.168.1.220:8080/RealEstate/admin/phe-duyet-bai-dang");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
    }

    exit();
}

/* ========= THÙNG RÁC ========= */
if (isset($_POST['recover-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE, true);

        setcookie('change_to', Constants::ENABLE, time() + 36000, '/RealEstate/admin/thung-rac');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/thung-rac');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/thung-rac');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/thung-rac");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
    }

    exit();
}

if (isset($_POST['delete-news'])) {

    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DETELED);

        setcookie('change_to', Constants::DETELED, time() + 36000, '/RealEstate/admin/thung-rac');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/thung-rac');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/thung-rac');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/thung-rac");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
    }

    exit();
}

if (isset($_POST['move-news-to-trash'])) {

    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DISABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/quan-ly-bai-dang');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/quan-ly-bai-dang');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/quan-ly-bai-dang");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
    }

    exit();
}

///DH

$conn = getConnection();
if (isset($_POST['update-news'])) {
    $conn = getConnection();
    $newsID = filter_input(INPUT_POST, 'newsID');
    $title = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'title'));
    $newsTypeID = filter_input(INPUT_POST, 'typeID');
    $lineage = "/0/" . filter_input(INPUT_POST, 'provinceID') . "/" . filter_input(INPUT_POST, 'districtID') . "/";
    if (filter_input(INPUT_POST, 'wardID') != '0') {
        $lineage .= filter_input(INPUT_POST, 'wardID') . "/";
    }
    $address = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'address'));
    $description = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'description'));
    $detail = mysqli_real_escape_string($conn, filter_input(INPUT_POST, 'detail'));
    $area_unit = filter_input(INPUT_POST, 'dien_tich');
    $acreage = filter_input(INPUT_POST, 'acreage');
    if ($area_unit == 2) {
        $acreage *= 10000;
    }

    $price = filter_input(INPUT_POST, 'price');
    $price = str_replace('.', '', $price);
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
    try {
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
            // Ko cập nhật ảnh
        }
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
    }
    /* ========== UPDATE TO DB ========== */
    mysqli_autocommit($conn, false);
    $sql = "UPDATE `news` SET `NewsTypeID`=$newsTypeID,`Lineage`='$lineage',`Title`='$title',`Description`='$description',`Details`='$detail',`LastUpdated`=now(),`ViewNumber`=0,`Acreage`='$acreage',`Price`=$price,`Contact`='$contact',`Direction`=$direction,`Rooms`=$room,`IsHire`=$isHire,`State`=$state ";
    
    if (isset($illustrationURL)) {
        $sql .= ", `IllustrationURL`='$illustrationURL' ";
    }
    $sql .=  " WHERE `NewsID` = " . $newsID . ";";
    
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn)) {
            if (insertNewsLog($newsID, Constants::LOG_UPDATING, $conn)) {
                // Commit transaction
                mysqli_commit($conn);
                closeConnect($conn);

                echo "Records inserted successfully.";
                header("location: http://192.168.1.220:8080/RealEstate/admin/quan-ly-bai-dang");
            }
        } else {
            // Không thay đổi gì
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
//        setcookie('insert_err', 'SQL ERROR: Đã xảy ra lỗi khi thêm bài đăng mới.', time() + 36000, '/RealEstate/admin');
        header("Location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
    }

    mysqli_close($conn);
    exit();
} else {
    mysqli_close($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
}
?>