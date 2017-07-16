<?php
session_start();
require_once './util/Utils.php';
require_once ("data/truyvan.php");
$con = connect();

function unsetFilterSession() {
//    unset all look up session
    unset($_SESSION["search_type"]);
    unset($_SESSION["loai"]);
    unset($_SESSION["nha"]);
    unset($_SESSION["thanhpho"]);
    unset($_SESSION["huyen"]);
    unset($_SESSION["phuongXa"]);
    unset($_SESSION['dientich']);
    unset($_SESSION['gia']);
    unset($_SESSION['phong']);
    unset($_SESSION['huong']);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Trang thông tin bất động sản</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <div class="outer" id="loading-on-submit">
            <div class="middle">
                <div id="loading-box" >
                    <img src="http://192.168.1.220:8080/RealEstate/images/status_1.gif" alt="Logo Loading" />
                </div>
            </div>
        </div>

        <div class="container">
            <div class="box_wrapper">
                <div id="preloader">
                    <div id="status">&nbsp;</div>
                </div>
                <?php require_once("include/menu.php"); ?>
                <?php require_once("include/home_slider.php"); ?>

                <section id="contentbody">
                    <div class="row" id="datasearch">
                        <?php require_once ("include/left_banner.php"); ?>
                        <?php
                        $page = "";
                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];

                            switch ($page) {
                                case "home":
                                    require_once("index.php");
                                    break;
                                case "details":
                                    require_once("details.php");
                                    unsetFilterSession();
                                    break;
                                case "category_content":
                                    require_once ("category_archive.php");
                                    break;
                                case "tim-kiem":
                                    require_once ("include/search.php");
                                    break;
                                case "theloai":
                                    require_once ("include/theloai.php");
                                    break;
                            }
                        } else {
                            require_once("include/center_content.php");
                            unsetFilterSession();
                        }
                        ?>
                        <!--cái này là tìm kiếm là cái phần có mmaasy combobox tìm kiếm đứng ko?phải ok vậy trang kết quả sau tìm kiếm của c -->
                        <?php require_once ("include/filter_banner2.php"); ?>
                    </div>
                </section>
            </div>
        </div>

        <?php include("include/footer.php"); ?>

    </body>
</html>