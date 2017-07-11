<?php
// ========== CHECK LOGIN ==========
require_once("./include/check-role.php");
require_once("./util/Constant.php");

/* ========== CHECK ROLE ON SESSION ========== */
if (in_array(Constants::UPDATE_NEWS, $_SESSION['user_role'])) {
// Có thể check chéo db để đảm bảo. 
} else {
    header("location: http://192.168.1.220:8080/RealEstate/admin/");
}

/* ========== GET NEWS FROM DB ========== */
require_once("./util/AccessDatabase.php");
require("./util/News.php");
require_once("./controller/GetNews.php");
require("./util/Type.php");
require_once("./controller/GetType.php");
$lstNews = getAllNews();

/* ========= AFTER UPDATE ========== */
$cookieModal = filter_input(INPUT_COOKIE, 'user_modal');
$change_info_msg = filter_input(INPUT_COOKIE, 'change_info_msg');

if (isset($cookieModal)) {
    setcookie("user_modal", "", time() - 3600, "/RealEstate/admin/user-manager.php");
}
if (isset($change_info_msg)) {
    setcookie("change_info_msg", "", time() - 3600, "/RealEstate/admin/user-manager.php");
} else {
    $change_info_msg = ' ';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý bài đăng</title>
        <?php include("include/header.php"); ?>

    </head>
    <body>
        <?php include("include/top-header.php"); ?>
        <?php include("include/left-menu.php"); ?>

        <div id="content">
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="http://192.168.1.220:8080/RealEstate/admin/" title="Tới trang chủ" class="tip-bottom">
                        <i class="icon-home"></i> Trang chủ
                    </a>
                    <a href="http://192.168.1.220:8080/RealEstate/admin/news-manager.php" class="current">
                        <i class="icon-user"></i> Quản lý bài đăng
                    </a>
                </div>
                <h1>Quản lý bài đăng</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Danh sách bài đăng</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="list-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tiêu đề bài đăng</th>
                                    <th>Loại bài đăng </th>
                                    <th>Lượng người xem</th>
                                    <th>Giá</th>
                                    <th>Thời gian cập nhật</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($lstNews as $news) {
                                    $type = getTypeByID($news->getNewsTypeID());
                                    echo "<tr>";
                                    echo "<td><b>" . $news->getTitle() . "</b></td>";
                                    echo "<td>" . $type->getTypeName() . "</td>";
                                    echo "<td>" . $news->getViewNumber() . "</td>";
                                    echo "<td>" . $news->getPrice() . "</td>";
                                    echo "<td>" . $news->getLastUpdated() . "</td>";
                                    if ($news->getState() == 0) {
                                        $alertTitle = "<b>PENDDING</b>";
                                        $alertMsg = "Xác nhận bài đăng đang được bổ sung: ";
                                        echo "<td>PENDDING</td> ";
                                    } else {
                                        if ($news->getState() == 1) {
                                            $alertTitle = "<b>ENABLE</b>";
                                            $alertMsg = "Xác nhận bài đăng được đăng: ";
                                            echo "<td>ENABLE</td> ";
                                        } else {
                                            $alertTitle = "<b>DISABLE</b>";
                                            $alertMsg = "Xác nhận xoá bài đăng: ";
                                            echo "<td>DISABLE</td>";
                                        }
                                    }
                                    echo "<td>";


                                    echo '<div class = "widget-content">

                                        <a href = "http://192.168.1.220:8080/RealEstate/admin/news-details.php?newsID= ' . $news->getNewsID() . '"> Cập nhật</a>

                                    </div>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php include("include/footer.php"); ?>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/add-user.form_validation.js"></script>
        <!-- Highlight menu -->
        <script type="text/javascript">
            $(document).ready(function () {
                if ($('div#sidebar ul').length > 2) {
                    $('div#sidebar ul:eq(2)').slideDown();
                } else {
                    $('div#sidebar ul:eq(1)').slideDown();
                }
                $('div#sidebar ul li.header_menu_link').removeClass('active');
                $('div#sidebar ul li.header_menu_link').removeClass('open');
                if ($('div#sidebar ul').length > 2) {
                    $('div#sidebar ul li.header_menu_link:eq(2)').addClass('open');
                } else {
                    $('div#sidebar ul li.header_menu_link:eq(1)').addClass('open');
                }
                $('div#sidebar ul li.open ul li:eq(1)').addClass('active');
<?php
if (isset($cookieModal)) {
    echo "$('#$cookieModal').modal('show');";
}
?>
                $('.modal').on('hidden.bs.modal', function () {
                    $('.change-msg').html('');
                    location.reload();
                });
            });
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>


