<?php

session_start();

if (!(isset($_SESSION['login_user']) && isset($_SESSION['login_user']['UserID']))) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/login.php");
    exit();
}

if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > 0)) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/pages/logout.php");
    exit();
}

function checkRole($roleNum) {
    /* ========== CHECK ROLE ON SESSION ========== */
    if (in_array($roleNum, $_SESSION['user_role'])) {
        // Có thể check thêm trong db theo userID.	
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/403.php");
        exit();
    }
}

?>