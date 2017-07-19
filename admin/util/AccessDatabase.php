<?php

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'real_estate');

function getConnection() {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    mysqli_set_charset($conn, 'UTF8');
    if (!$conn) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
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