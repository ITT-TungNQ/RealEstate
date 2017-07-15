<?php
$tl = "";
$check = FALSE;
if (isset($_GET["type"])) {
    $tl = $_GET["type"];
// $idType="NewsID != 0  ";
    switch ($tl) {
        case "dat-nen":
            $idType = "NewsTypeID=11 or NewsTypeID=12";
            unsetFilterSession();
            break;
        case "du-an-moi":
            $idType = "NewsTypeID=7 or NewsTypeID=8 or NewsTypeID=9 or NewsTypeID=10";
            unsetFilterSession();
            break;

        case "can-ho":
            $idType = "NewsTypeID=1 or NewsTypeID=2 or NewsTypeID=3 or NewsTypeID=4";
            unsetFilterSession();
            break;

        case "biet-thu":
            $idType = "NewsTypeID=5 or NewsTypeID=6";
            unsetFilterSession();
            break;

        case "tim-kiem":
            if (isset($_GET["trang"])) {
                $t = $_GET["trang"];
                settype($t, "int");
                if ($t >= 1 && isset($_SESSION['luu'])) {
                    $idType = $_SESSION['luu'];
                }
            } else {
                $idType = getSQL();
//                unsetFilterSession();
            }
            break;
        case "tin-moi":
            $idType = "NewsTypeID=11 or NewsTypeID=12 or NewsTypeID=7 or NewsTypeID=8 or NewsTypeID=9 or NewsTypeID=10 or NewsTypeID=1 or NewsTypeID=2 or NewsTypeID=3 or NewsTypeID=4 or NewsTypeID=5 or NewsTypeID=6";
            unsetFilterSession();
            break;
        case "noi-bat":
            $check = TRUE;
            unsetFilterSession();
            break;
        case "loai-khac":
            $idType = "NewsTypeID=13 ";
            unsetFilterSession();
            break;

        default :
            header("location: http://192.168.1.220:8080/RealEstate/page-not-found");
            unsetFilterSession();
            exit();
            break;
    }
}

$sotin1trang = 5;
if (isset($_GET["trang"])) {
    $trang = $_GET["trang"];
    settype($trang, "int");
} else {

    $trang = 1;
}

$from = ($trang - 1) * $sotin1trang;
if ($check) {
    $theloai = NhaDatNoiBat_PhanTrang($con, $from, $sotin1trang);
} else {
    $theloai = TheLoai_PhanTrang($con, $idType, $from, $sotin1trang);
}
?>

<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 ">
    <div class="row">
        <div class="middle_bar">
            <div class="category_archive_area">
                <?php
                foreach ($theloai as $a) {
                    ?>

                    <div class="single_archive wow fadeInDown">
                        <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>"><img src="<?php echo($a['IllustrationURL']); ?>" alt=""></a>
                        <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>" class="read_more">
                            Đọc tiếp
                            <i class="fa fa-angle-double-right"></i>
                        </a>
                        <div class="singlearcive_article">
                            <h2><a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>"><?php echo($a['Title']); ?></a></h2>

                            <a class="author_name" href="#">
                                <i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views
                            </a>
                            <p>
                                <?php echo($a['Description']); ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>	

    <hr>
    <div id="phantrang">
        <style type="text/css">
            #phantrang{text-align: center}
            #phantrang a:hover{background-color: #444}
            #phantrang a{background-color:#09c; color: #fff; padding: 7px; margin-right: 5px; font-size: 16px; border-radius: 90px}
        </style>


        <?php
        if ($check) {
            $tong = TheLoai_NoiBat($con);
        } else {
            $tong = TheLoai($con, $idType);
        }
        $sum = $tong->rowCount();
        if ($sum != 0) {
            $tongSoTrang = ceil($sum / $sotin1trang);
            for ($i = 1; $i <= $tongSoTrang; $i++) {
                ?>
                <a <?php if ($i == $trang) echo "style='background-color: #444'"; ?> href="http://192.168.1.220:8080/RealEstate/the-loai/<?php echo ($tl); ?>/trang-<?php echo ($i); ?>"><?php echo ( $i ); ?></a>
            <?php } ?> 
            <?php
        }
        else {
            echo '<h3>Không tìm thấy kết quả phù hợp!!!</h3>';
        }
        ?>




    </div>
</div>


<?php

function getSQL() {
    $sql = "NewsID != 0  ";
    if (isset($_POST["submit"])) {
        $loai = $_POST['select_adv_type'];
        $nha = $_POST['select_type'];
        $thanhpho = $_POST["select_province"];
        $huyen = $_POST['select_district'];
        $phuongXa = $_POST['select_ward'];
        $dientich = $_POST['select_acreage'];
        $gia = $_POST['select_price'];
        $phong = $_POST['select_rooms'];
        $huong = $_POST['select_direction'];
        $_SESSION['search_type'] = filter_input(INPUT_POST, 'search_type') == 'on';

        $linegae = "/0/";


        if ($loai != "2") {
            $_SESSION['loai'] = $loai;

            $loai = (int) $loai;
            $sql .= "AND IsHire=$loai ";
        } else {
            unset($_SESSION['loai']);
        }

        if ($nha != "0") {
            $_SESSION['nha'] = $nha;
            $nha = (int) $nha;
            $sql .= "AND NewsTypeID=$nha ";
        } else {
            unset($_SESSION['nha']);
        }

        if ($thanhpho != "0") {
            $_SESSION['thanhpho'] = $thanhpho;

            if ($huyen != "0") {
                $_SESSION['huyen'] = $huyen;
                if ($phuongXa != "0") {
                    $_SESSION['phuongXa'] = $phuongXa;
                    $sql .= "AND Lineage LIKE '/0/$thanhpho/$huyen/$phuongXa/%'";
                } else {
                    unset($_SESSION['phuongXa']);
                    $sql .= "AND Lineage LIKE '/0/$thanhpho/$huyen/%'";
                }
            } else {
                unset($_SESSION['huyen']);
                $sql .= "AND Lineage LIKE '/0/$thanhpho/%'";
            }
        } else {
            unset($_SESSION['thanhpho']);
        }
        if ($dientich != "0") {
            $_SESSION['dientich'] = $dientich;
            $dientich = explode('-', $dientich);

            $sql .= "AND Acreage BETWEEN '$dientich[0]' AND '$dientich[1]' ";
        } else {
            unset($_SESSION['dientich']);
        }
        if ($gia != "0") {
            $_SESSION['gia'] = $gia;
            $gia = explode('-', $gia);

            $sql .= "AND Price BETWEEN '$gia[0]' AND '$gia[1]' ";
        } else {
            unset($_SESSION['gia']);
        }

        if ($phong != "0") {
            $_SESSION['phong'] = $phong;
            $phong = (int) $phong;
            $sql .= "AND Rooms=$phong";
        } else {
            unset($_SESSION['phong']);
        }
        if ($huong != "0") {
            $_SESSION['huong'] = $huong;
            $huong = (int) $huong;
            $sql .= "AND Direction=$huong";
        } else {
            unset($_SESSION['huong']);
        }

// echo '<h1>' . $sql . '</h1>';
        $_SESSION['luu'] = $sql;
    }
    return $sql;
}
?>
