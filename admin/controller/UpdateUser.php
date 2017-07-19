<?php

require_once (__DIR__) . '/../util/AccessDatabase.php';
require_once (__DIR__) . '/../util/Constant.php';
require_once (__DIR__) . '/../util/Utils.php';

// ========== start - CHECK LOGIN AND ROLE ==========
require_once (__DIR__) . '/../include/check-role.php';
// ========== end - CHECK LOGIN AND ROLE ==========

/* ========== Deactivate user ========== */
if (isset($_POST['deactivate-user'])) {
    if (in_array(Constants::CHANGE_USER_STATE, $_SESSION['user_role'])) {
        $conn = getConnection();
        if (isset($_POST['userID'])) {
            $sql = "UPDATE user SET Enable=b'0' WHERE UserID=" . $_POST['userID'] . ";";
            if (mysqli_query($conn, $sql)) {
                if (mysqli_affected_rows($conn)) {
                    echo "Records updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    // setcookie('deactivate_err', 'SQL ERROR: Đã xảy ra lỗi khi khóa tài khoản.', time()+3600, Constants::PREFIX_PATH . '/admin', Constants::DOMAIN);
                }
            }
        }

        closeConnect($conn);
        header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page.php");
    }

    exit();
}

// Activate user:
if (isset($_POST['activate-user'])) {
    if (in_array(Constants::CHANGE_USER_STATE, $_SESSION['user_role'])) {
        $conn = getConnection();
        if (isset($_POST['userID'])) {
            $sql = "UPDATE user SET Enable=b'1' WHERE UserID=" . $_POST['userID'] . ";";
            if (mysqli_query($conn, $sql)) {
                if (mysqli_query($conn, $sql)) {
                    echo "Records updated successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
//                  setcookie('deactivate_err', 'SQL ERROR: Đã xảy ra lỗi khi kích hoạt tài khoản.', time()+3600, Constants::PREFIX_PATH . '/admin', Constants::DOMAIN);
                }
            }
        }

        closeConnect($conn);
        header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/");
    }

    exit();
}

/* ========== CHANGE PASSWORD ========== */
$inputPwd1 = filter_input(INPUT_POST, 'pwd');
$inputPwd2 = filter_input(INPUT_POST, 'pwd2');
$inputUserID = filter_input(INPUT_POST, 'change_pwd_id');
$btnChanePWD = filter_input(INPUT_POST, 'change-pwd');
if (isset($inputPwd1) && isset($inputPwd2) && isset($btnChanePWD)) {
    if ($inputPwd1 != $inputPwd2) {
        setcookie("change_pwd_msg", "Xác nhận mật khẩu không trùng khớp", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
        header("location: http://192.168.1.220:8080/RealEstate/admin/user-profile");
    } else {
        $conn = getConnection();
        $inputPwd1 = mysqli_real_escape_string($conn, $inputPwd1);
        $inputUserID = mysqli_real_escape_string($conn, $inputUserID);

        $sql = "UPDATE user SET Password = '" . sha1($inputPwd1) . "' "
                . "WHERE UserID = '$inputUserID';";
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) == 1) {
                setcookie("change_pwd_msg", "Đổi mật khẩu mới thành công", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
            } else {
                setcookie("change_pwd_msg", "Mật khẩu mới phải khác mật khẩu cũ", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
            }
        } else {
            setcookie("change_pwd_msg", "ERROR: Could not able to execute $sql.", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        closeConnect($conn);
        header("location: http://192.168.1.220:8080/RealEstate/admin/user-profile");
        exit();
    }
}

/* =========== UPDATE USER INFO - PERSONAL =========== */
$inputChangeInfo = filter_input(INPUT_POST, 'change-info');
if (isset($inputChangeInfo)) {
    $postUserID = filter_input(INPUT_POST, 'change_info_id');
    $postUserEmail = filter_input(INPUT_POST, 'user_email');
    $postDOB = filter_input(INPUT_POST, 'user_dob');
    $postFName = filter_input(INPUT_POST, 'first_name');
    $postMName = filter_input(INPUT_POST, 'middle_name');
    $postLName = filter_input(INPUT_POST, 'last_name');

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
        // Ko có ảnh
    }

    $sql = "UPDATE user "
            . "SET FirstName = '$postFName', MiddleName = '$postMName', LastName = '$postLName', "
            . "DOB = STR_TO_DATE('$postDOB', '%d/%m/%Y'), Email = '$postUserEmail' ";
    if (isset($profile_picture)) {
        $sql .= ", ProfileImageURL = '$profile_picture' ";
    }
    if (isset($user_level)) {
        $sql .= ", UserLevelID = $user_level ";
    }
    $sql .= "WHERE UserID = '$postUserID';";

    $conn = getConnection();
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) == 1) {
            $_SESSION['login_user']['LastName'] = $postLName;
            $_SESSION['login_user']['MiddleName'] = $postMName;
            $_SESSION['login_user']['FirstName'] = $postFName;
            setcookie("change_info_msg", "Thay đổi thông tin thành công", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
        } else {
            // Không thay đổi gì
            setcookie("change_info_msg", "", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
        }
    } else {
//        setcookie("change_info_msg", "ERROR: Could not able to execute $sql.", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
        setcookie("change_info_msg", "Đã có lỗi xảy ra", time() + 3600, Constants::PREFIX_PATH . '/admin/user-profile', Constants::DOMAIN);
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    closeConnect($conn);
    header("location: http://192.168.1.220:8080/RealEstate/admin/user-profile");
    exit();
}

/* =========== UPDATE USER INFO - ADMIN =========== */
$inputChangeInfo = filter_input(INPUT_POST, 'update-user-info');
if (isset($inputChangeInfo)) {
    checkRole(Constants::UPDATE_USER_INFO);
    $inputPwd1 = filter_input(INPUT_POST, 'pwd');
    $inputPwd2 = filter_input(INPUT_POST, 'pwd2');
    $inputUserID = filter_input(INPUT_POST, 'userID');
    $inputUserLevel = filter_input(INPUT_POST, 'user_level' . $inputUserID);

    // Có tham số cập nhật quyền --> check xem user được dùng không
    if (isset($inputUserLevel)) {
        checkRole(Constants::DISTRIBUTION_USER_RIGHTS);
    }

    if (isset($inputPwd1) && !empty($inputPwd1) && $inputPwd1 != $inputPwd2) {
        setcookie("user_modal", "editAlert" . $inputUserID, time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
        setcookie("change_info_msg", "Xác nhận mật khẩu không trùng khớp", time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
        header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
    } else {
        $conn = getConnection();
        $sql = "UPDATE `user` "
                . "SET ";

        if (isset($inputUserLevel)) {
            $sql .= "UserLevelID = '$inputUserLevel' ";
        } else {
            if (!isset($inputPwd1) || empty($inputPwd1)) {
                // Về trang quản lý:
                setcookie("change_info_msg", "Không có gì thay đổi", time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
                setcookie("user_modal", "editAlert" . $inputUserID, time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);

                closeConnect($conn);
                header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
                exit();
            }
        }

        if (isset($inputPwd1) && !empty($inputPwd1)) {
            $inputPwd1 = mysqli_real_escape_string($conn, $inputPwd1);
            if ($inputUserLevel) {
                $sql .= ",";
            }
            $sql .= " Password = '" . sha1($inputPwd1) . "' ";
        }

        $sql .= "WHERE UserID = '$inputUserID';";
        if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) == 1) {
                setcookie("change_info_msg", "Cập nhật thành công", time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
                setcookie("user_modal", "editAlert" . $inputUserID, time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
            } else {
                setcookie("change_info_msg", "Không có gì thay đổi", time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
                setcookie("user_modal", "editAlert" . $inputUserID, time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
            }
        } else {
            setcookie("change_info_msg", "ERROR: Could not able to execute $sql.", time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
            setcookie("user_modal", "editAlert" . $inputUserID, time() + 3600, Constants::PREFIX_PATH . '/admin/danh-sach-tai-khoan-quan-ly', Constants::DOMAIN);
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }

        closeConnect($conn);
        header("location: http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
        exit();
    }
}
?>
