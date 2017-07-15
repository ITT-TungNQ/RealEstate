<?php
require_once ('include/check-role.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trang chủ quản lý</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <?php include("include/top-header.php"); ?>

        <?php include("include/left-menu.php"); ?>

        <!--main-container-part-->
        <div id="content">
            <!--breadcrumbs-->
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="http://192.168.1.220:8080/RealEstate/admin/" title="Tới trang chủ" class="tip-bottom">
                        <i class="icon-home"></i> Trang chủ
                    </a>
                </div>
            </div>
            <!--End-breadcrumbs-->

            <div class="row-fluid">

                <iframe src="https://dashboard.tawk.to/#/dashboard" style="width: 100%; min-height: 600px"></iframe>

            </div>
        </div>
        <!--Footer-part-->
        <?php include("include/footer.php"); ?>
        <!--end-Footer-part-->

        <!-- Highlight menu -->
        <script type="text/javascript">
            $('div#sidebar ul li.header_menu_link').removeClass('active');
            $('div#sidebar ul li.header_menu_link:eq(0)').addClass('active');
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>