<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once (__DIR__) . '/../include/check-role.php';
// ========== end - CHECK LOGIN AND ROLE ==========

?>

<!DOCTYPE html>
<html>
    <head>
        <title>ERROR 404</title>
        <?php require_once (__DIR__) . '/../include/header.php'; ?>
    </head>
    <body>
        <?php require_once (__DIR__) . '/../include/top-header.php'; ?>
        <?php require_once (__DIR__) . '/../include/left-menu.php'; ?>

        <div id="content">
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="http://192.168.1.220:8080/RealEstate/admin/" title="Tới trang chủ" class="tip-bottom">
                        <i class="icon-home"></i> Trang chủ
                    </a>
                    <a href="" class="current">
                        <i class="icon-user"></i> Lỗi truy cập dữ liệu
                    </a>
                </div>
                <h1>Lỗi truy cập dữ liệu</h1>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                                <h5>Lỗi 500</h5>
                            </div>
                            <div class="widget-content">
                                <div class="error_ex">
                                    <h1>500</h1>
                                    <h3>Không thể truy cập dữ liệu</h3>
                                    <p>Vui lòng chọn "Trở về trang chủ" để quay về</p>
                                    <a class="btn btn-warning btn-big"  href="http://192.168.1.220:8080/RealEstate/admin/">Trở về trang chủ</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php require_once (__DIR__) . '/../include/footer.php'; ?>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/add-user.form_validation.js"></script>
        <!-- Highlight menu -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('div#sidebar ul li.header_menu_link').removeClass('active');
                $('div#sidebar ul li.header_menu_link').removeClass('open');
            });
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>