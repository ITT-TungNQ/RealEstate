<style type="text/css">
    @media(max-width:767px ){
        #left-banner {
            display: none;
        }
    }
</style>
<?php

function toStringMoney($value) {
    $strMoney = "Thỏa thuận";
    if (is_numeric($value) && $value != 0 && bcmod($value, 1000) == 0) {
        if ($value > 999999999) {
            $value = $value / 1000000000;
            $strMoney = number_format((float) $value, 1, ",", ".");
            $strMoney .= " tỷ";
        } else {
            if ($value < 1000000) {
                // dưới 1 triệu giữ nguyên giá
                $strMoney = number_format((float) $value, 0, ",", ".");
                $strMoney .= "<sup>đ</sup>";
            } else {
                $value = $value / 1000000;
                $strMoney = number_format((float) $value, 1, ",", ".");
                $strMoney .= " triệu";
            }
        }
    }

    return $strMoney;
}
?>

<?php
$DIRECTION = array('Liên hệ', "Đông", "Tây", "Nam", "Bắc", "Đông-Bắc", "Tây-Bắc", "Đông-Nam", "Tây-Nam");
$loaiTin = array("Cho Thuê", "Bán");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    settype($id, "int");
    CapNhatView($con, $id);

    $row = ChiTietTin($con, $id);
    foreach ($row as $a) {
        $title = filter_input(INPUT_GET, 'title');
        if (makeURL($a['Title']) != $title) {
            header("location: http://192.168.1.220:8080/RealEstate/page-not-found");
            exit();
        }

        $objContact = json_decode($a['Contact']);
        $ownerName = $objContact->{'owner_name'};
        $phoneNumber = $objContact->{'phone_number'};
        if (isset($objContact->{'email'})) {
            $email = $objContact->{'email'};
        } else {
            $email = '';
        }

        $diachi = ViTri($con, $a['Lineage']);
    }
    ?>
    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12" >
        <div class="row">
            <div class="middle_bar">
                <div class="single_post_area">
                    <ol class="breadcrumb">
                        <li>
                            <a href="http://192.168.1.220:8080/RealEstate/index.php">
                                <i class="fa fa-home"></i>Trang chủ<i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                            $loai = "";
                            $link = "";
                            $type = Type($con, $id);
                            foreach ($type as $xx) {
                                $x = $xx['NewsTypeID'];
                            }
                            settype($x, "int");
                            switch ($x) {
                                case 1:
                                case 2:
                                case 3:
                                case 4:
                                    $idType = "NewsTypeID=1 or NewsTypeID=2 or NewsTypeID=3 or NewsTypeID=4";
                                    $link = " http://192.168.1.220:8080/RealEstate/the-loai/can-ho";
                                    $loai = "Căn Hộ";
                                    break;
                                case 5:
                                case 6:
                                    $idType = "NewsTypeID=5 or NewsTypeID=6";
                                    $link = " http://192.168.1.220:8080/RealEstate/the-loai/biet-thu";
                                    $loai = "Biệt Thự";
                                    break;
                                case 7:
                                case 8:
                                case 9:
                                case 10:
                                    $idType = "NewsTypeID=7 or NewsTypeID=8 or NewsTypeID=9 or NewsTypeID=10";
                                    $link = " http://192.168.1.220:8080/RealEstate/the-loai/du-an-moi";
                                    $loai = "Dự Án Mới";
                                    break;
                                case 11:
                                case 12:
                                    $idType = "NewsTypeID=11 or NewsTypeID=12";
                                    $link = " http://192.168.1.220:8080/RealEstate/the-loai/dat-nen";
                                    $loai = "Đất Nền ";
                                    break;

                                case 13:
                                    $idType = "NewsTypeID=13";
                                    $link = " http://192.168.1.220:8080/RealEstate/the-loai/loai-khac";
                                    $loai = "Loại khác ";
                                    break;

                                default :
                                    header("location: http://192.168.1.220:8080/RealEstate/page-not-found");
                                    exit();
                                    break;
                            }
                            ?>
                            <a href="<?php echo($link); ?>"><?php echo ($loai); ?>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="active"><?php echo($a['Title']); ?></li>
                    </ol>
                    <h2 class="post_title wow "><?php echo($a['Title']); ?></h2>

                    <a class="post_date"><i class="fa fa-clock-o"></i><?php echo date('d/m/Y', strtotime($a['LastUpdated'])); ?></a>
                    <a class="post_views"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
                    <div class="post_contact">
                        <ul class="post_contact_pager">
                            <li class="col-lg-6 col-md-12 col-sm-12 post_contact_left">
                                Khu vực: <?php echo($diachi); ?>.<br/>
                                Giá bán: <span class="post_highlight"><?php echo(toStringMoney($a['Price'])); ?></span><br/>
                                Diện tích: <span class="post_highlight"><?php echo($a['Acreage']); ?>m<sup>2</sup></span>
                            </li>
                            <li class="col-lg-6 col-md-12 col-sm-12 post_contact_right">
                                <i class="fa fa-user"></i> &nbsp;<?php echo ($ownerName); ?><br/>
                                <a href="tel:<?php echo ($phoneNumber); ?>"><i class="fa fa-phone"></i> &nbsp;<?php echo ($phoneNumber); ?><br/></a>
                                <?php
                                if ($email != '') {
                                    echo '<a href="mailTo:' . $email . '"><i class="fa fa-envelope"></i> &nbsp;' . $email . '</a>';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="single_post_content">
                        <p><?php echo($a['Details']) ?></p>
<!--                        <blockquote style="font-size: 15px">
                            <p>Thông Tin Khác:</p>
                            <p style="padding-left: 50px;">Hướng nhà:<?php echo ($DIRECTION[$a['Direction']]); ?> </p>
                            <p style="padding-left: 50px;">Số Phòng:
                                <?php
                                if ($a['Rooms'] == 0) {
                                    echo "Liên hệ";
                                } else {
                                    echo ($a['Rooms']);
                                }
                                ?> 
                                </p>
                            <p style="padding-left: 50px;">Loại Tin Rao: <?php echo ($loaiTin[($a['IsHire'])?0:1]); ?></p>
                        </blockquote>-->
                    </div>
                    <div class="related_post">
                        <h2 class="wow fadeInLeftBig"> Có thể bạn quan tâm 
                            <i class="fa fa-thumbs-o-up"></i>
                        </h2>
                        <ul class="recentpost_nav relatedpost_nav wow fadeInDown animated">
                            <?php
                            $lienquan = TheLoai_PhanTrang($con, $idType, 0, 3);
                            foreach ($lienquan as $a) {
                                ?>
                                <li>
                                    <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>">
                                        <div class="relate_post_image" style="background-image: url('<?php echo($a['IllustrationURL']); ?>');">

                                        </div>
                                    </a>
                                        <!--<img src="<?php echo($a['IllustrationURL']); ?>" alt=""></a>-->
                                        <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>" class="recent_title">
                                            <?php echo($a['Title']); ?>
                                        </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

