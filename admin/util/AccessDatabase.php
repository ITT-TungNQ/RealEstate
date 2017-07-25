<?php

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'real_estate');

function getConnection() {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    mysqli_set_charset($conn, 'UTF8');
    if (!$conn) {
        if (isset($_SESSION['login_user']['FirstName'])) {
            header("location: http://batdongsansaigons.com/admin/unexpected-error");
        } else {
            header("location: http://batdongsansaigons.com/unexpected-error");
        }
        
        exit();
    }
    return $conn;
}

function closeConnect($conn) {
    if (isset($conn) && $conn != null) {
        mysqli_close($conn);
    }
}

?>