
<?php

static $luuTK = "";

function connect() {
    try {
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $con = "";
        $con = new PDO("mysql:host=localhost; dbname=real_estate", "root", "root", $options);
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        echo "Ket noi that bai!!! " . $e->getMessage();
    }
}

function TinMoi($con) {
    $sql = "select *from news order by NewsID desc limit 0,10";
    $kq = $con->query($sql);
    return $kq;
}

function TinNoiBat($con) {
    $sql = "select * from news order by ViewNumber desc limit 0,6";
    $kq = $con->query($sql);
    return $kq;
}

function NhaDatNoiBat($con) {
    $sql = "select *from news order by ViewNumber desc limit 0,4";
    $kq = $con->query($sql);
    return $kq;
}

function TheLoai($con, $idType) {
    $sql = "select *from news where $idType";
    $kq = $con->query($sql);
    return $kq;
}

function TheLoai_PhanTrang($con, $idType, $from, $sotin1trang) {
    $sql = "select *from news where $idType order by LastUpdated desc limit $from,$sotin1trang";
    $kq = $con->query($sql);
    return $kq;
}

function ChiTietTin($con, $id) {
    $sql = "select * from news where NewsID=$id ";
    $kq = $con->query($sql);
    return $kq;
}

function ViTri($con, $li) {
    $sql = "select (select LocationName from location where LocationID = substring_index(substring_index('" . $li . "', '/', -4), '/', 1)) as LocFirst,
                (select LocationName from location where LocationID = substring_index(substring_index('" . $li . "', '/', -3), '/', 1)) as LocMiddle,
                (select LocationName from location where LocationID = substring_index(substring_index('" . $li . "', '/', -2), '/', 1)) as LocLast";
    $result = $con->query($sql);
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }

    foreach ($result as $row) {
        $strLocation = $row['LocLast'];
        if (!empty($row['LocMiddle'])) {
            $strLocation .= ', ' . $row['LocMiddle'];
        }
        if (!empty($row['LocFirst'])) {
            $strLocation .= ', ' . $row['LocFirst'];
        }
    }

    return $strLocation;
}

function CapNhatView($con, $id) {
    $sql = "UPDATE news SET ViewNumber = ViewNumber + 1 WHERE NewsID =$id";
    $con->exec($sql);
}

function Type($con, $id) {
    $sql = "SELECT NewsTypeID FROM news WHERE NewsID=$id";
    $kq = $con->query($sql);
    return $kq;
}
?>


