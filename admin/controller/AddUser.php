<?php

require_once (__DIR__) . '/../util/AccessDatabase.php';
require_once (__DIR__) . '/../util/Utils.php';

// ========== start - CHECK LOGIN AND ROLE ==========
require_once (__DIR__) . '/../util/Constant.php';
require_once (__DIR__) . '/../include/check-role.php';
checkRole(Constants::CREATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========
// GET NEW USER DATA FROM CLIENT:
if (isset($_POST['new-user'])) {
    $conn = getConnection();
    $my_username = mysqli_real_escape_string($conn, $_POST['username']);
    $my_password = mysqli_real_escape_string($conn, $_POST['pwd']);
    $my_password = sha1($my_password);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $user_dob = $_POST['user_dob'];
    $user_email = filter_input(INPUT_POST, 'user_email');
    $user_level = $_POST['user_level'];
    $enable = 0;
    if (isset($_POST['user_enable'])) {
        $enable = true;
    }

    /* ========== CHECK USERNAME EXIST ========== */
    $sql = "SELECT Username FROM user WHERE username = '$my_username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count >= 1) {
// username exist
// CHECK DADA IF FAILED
        setcookie('username', $my_username, time() + 36000, '/RealEstate/admin');
        setcookie('username_err', "Tài khoản đã tồn tại trong hệ thống", time() + 36000, '/RealEstate/admin');
        setcookie('last_name', $last_name, time() + 36000, '/RealEstate/admin');
        setcookie('first_name', $first_name, time() + 36000, '/RealEstate/admin');
        setcookie('middle_name', $middle_name, time() + 36000, '/RealEstate/admin');
        setcookie('user_dob', $user_dob, time() + 36000, '/RealEstate/admin');
        setcookie('user_email', $user_email, time() + 36000, '/RealEstate/admin');
        setcookie('user_level', $_POST['user_level'], time() + 36000, '/RealEstate/admin');

        closeConnect($conn);
        header("Location: http://192.168.1.220:8080/RealEstate/admin/them-tai-khoan-quan-ly");
        exit();
        return;
    }

    /* ========== UPLOAD IMAGE TO SERVER ========== */
    if (isset($_FILES["profile_picture"]["type"]) && $_FILES["profile_picture"]["name"] != "") {
        $max_size = 5 * 1024 * 1024; // 5MB
        $destination_directory = "../img/user/";
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

                    $profile_picture = 'http://192.168.1.220:8080/RealEstate/admin/img/user/' . $file_name;
                }
            } else {
                echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Kích thước ảnh của bạn: " + (file . size / 1024) . toFixed(2) + " KB<br/>Kích thước tối đa: " + (maxsize / 1024 / 1024) . toFixed(2) + " MB</div>";
            }
        } else {
            echo "<div class=\"alert alert-danger img-upload\" role=\"alert\">- Định dạng ảnh không được hỗ trợ.<br/>- Định dạng cho phép: JPG, JPEG, PNG.</div>";
        }
    } else {
        $profile_picture = "http://192.168.1.220:8080/RealEstate/admin/img/noimage.png";
    }

    /* ========== ISERT TO DB ========== */
    $sql = "INSERT INTO User (UserLevelID, UserName, Password, FirstName, MiddleName, LastName, DOB, Email, ProfileImageURL, Enable)
  				VALUES ($user_level, 
  				'$my_username', '$my_password', '$first_name', '$middle_name', '$last_name', STR_TO_DATE('$user_dob', '%d/%m/%Y'), '$user_email','$profile_picture', $enable)";
    if (mysqli_query($conn, $sql)) {
//        echo "Records inserted successfully.";
        header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
    } else {
//        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        setcookie('insert_err', 'SQL ERROR: Đã xảy ra lỗi khi thêm tài khoản mới.', time() + 36000, '/RealEstate/admin');
        header("Location: http://192.168.1.220:8080/RealEstate/admin/them-tai-khoan-quan-ly");
    }

    mysqli_close($conn);
    exit();
} else {
    mysqli_close($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/them-tai-khoan-quan-ly");
}
?>