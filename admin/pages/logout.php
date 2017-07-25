<?php
ob_start();
session_start();

// ========== SET OFFLINE TO DATABASE ==========
require_once '../util/AccessDatabase.php';
require_once '../util/Constant.php';

$conn = getConnection();
$sql = "UPDATE user SET `Online`=b'0', LastLogin='" . date('Y-m-d H:i:s') . "' "
        . "WHERE UserID = '" . $_SESSION['login_user']['UserID'] . "'";
if (mysqli_query($conn, $sql)) {
    echo "Records updated successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

unset($_SESSION["login_user"]);
unset($_SESSION["timeout"]);
setcookie('logged_username', '', time() - 36000, Constants::PREFIX_PATH . '/admin/dang-nhap', Constants::DOMAIN);
setcookie('logged_pwd', '', time() - 36000, Constants::PREFIX_PATH . '/admin/dang-nhap', Constants::DOMAIN);
// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("Location: http://192.168.1.220:8080/RealEstate/admin/trang-chu");
exit();
?>