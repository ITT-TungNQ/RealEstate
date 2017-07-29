
<?php
ob_start();
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
        header("location: http://192.168.1.220:8080/RealEstate/unexpected-error");
    }
}

function TinMoi($con) {
    $sql = "select *from news where state = 1 order by NewsID desc limit 0,10";
    $kq = $con->query($sql);
    return $kq;
}

function TinNoiBat($con) {
    $sql = "select * from news where state = 1 order by ViewNumber desc limit 0,6";
    $kq = $con->query($sql);
    return $kq;
}

function NhaDatNoiBat($con) {
    $sql = "select * from news where state = 1 AND LastUpdated >= time(NOW()) - INTERVAL 7 DAY order by ViewNumber desc limit 0,4";
    $kq = $con->query($sql);
    return $kq;
}

function TheLoai($con, $idType) {
    $sql = "select *from news where ($idType) AND state = 1";
    $kq = $con->query($sql);
    return $kq;
}

function TheLoai_NoiBat($con) {
    $sql = "select * from news where state = 1 AND LastUpdated >= time(NOW()) - INTERVAL 7 DAY order by ViewNumber desc";
    $kq = $con->query($sql);
    return $kq;
}

function NhaDatNoiBat_PhanTrang($con, $from, $sotin1trang) {
    $sql = "select * from news where state = 1 AND LastUpdated >= time(NOW()) - INTERVAL 7 DAY order by ViewNumber desc limit $from,$sotin1trang";
    $kq = $con->query($sql);
    return $kq;
}

function TheLoai_PhanTrang($con, $idType, $from, $sotin1trang) {
    $sql = "select *from news where ($idType) AND state = 1 order by LastUpdated desc limit $from,$sotin1trang";
    $kq = $con->query($sql);
    return $kq;
}

function ChiTietTin($con, $id) {
    try {
        $sql = "select * from news where NewsID=$id AND  state = 1 ";
        $kq = $con->query($sql);

        if ($kq->rowCount() == 0) {
            throw new Exception();
        }
        return $kq;
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/page-not-found");
        exit();
    }
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


