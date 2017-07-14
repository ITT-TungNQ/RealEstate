<?php
// ========== CHECK LOGIN ==========
require_once("./include/check-role.php");
require_once("./util/Constant.php");
checkRole(Constants::UPDATE_NEWS);

/* ========== GET NEWS FROM DB ========== */
require_once("./controller/dao/NewsDAO.php");
require_once("./controller/GetType.php");
require_once("./util/AccessDatabase.php");
require_once("./util/News.php");
require_once("./util/Type.php");
require_once("./util/Utils.php");
$lstNews = getAllNews();

$cookieModal = filter_input(INPUT_COOKIE, 'change_news_state');
if (isset($cookieModal)) {
    setcookie("change_news_state", "", time() - 3600, "/RealEstate/admin/quan-ly-bai-dang");
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
                    <a>
                        <i class="icon-file"></i> Quản lý bản tin
                    </a>
                    <a href="http://192.168.1.220:8080/RealEstate/admin/quan-ly-bai-dang" class="current">
                        <i class="icon-copy"></i> Danh sách bản tin
                    </a>
                </div>
                <h1>Quản lý bài đăng</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Danh sách bài đăng</h5>
                        <a href="http://192.168.1.220:8080/RealEstate/admin/them-bai-dang-moi" class="label label-danger" style="padding: 5px; margin-top: 6px;"><i class="icon-plus"></i> Thêm mới bản tin</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="list-user" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Loại nhà đất</th>
                                    <th>Ngày tạo</th>
                                    <th>Khu vực</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tmpStates = Constants::$STATES;
                                $tmpDirection = Constants::$DIRECTION;
                                $utils = new Utils();
                                foreach ($lstNews as $news) {
                                    $objContact = json_decode($news->getContact());
                                    $ownerName = $objContact->{'owner_name'};
                                    $phoneNumber = $objContact->{'phone_number'};
                                    if (isset($objContact->{'email'})) {
                                        $email = $objContact->{'email'};
                                    } else {
                                        $email = '';
                                    }

                                    $rooms = 'Liên hệ';
                                    if ($news->getRoom() > 0) {
                                        $rooms = $news->getRoom();
                                    }

                                    $hireOrSell = '';
                                    if ($news->getIsHire()) {
                                        $hireOrSell = 'Tin cho thuê';
                                    } else {
                                        $hireOrSell = 'Tin đăng bán';
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $news->getTitle() . "</td>";
                                    echo "<td>" . $hireOrSell . "</td>";
                                    echo "<td>" . $news->getNewTypeName() . "</td>";
                                    echo "<td>" . $news->getLocationName() . "</td>";
                                    echo "<td>" . $tmpStates[$news->getState()] . "</td>";
                                    echo "<td>";

                                    echo '      <div style="float: left;">
                                                    <a href="#viewAlert' . $news->getNewsID() . '" data-toggle="modal" class="btn btn-info tip-top" title="Xem chi tiết">
                                                        <i class="icon-eye-open"></i>
                                                    </a>
                                                </div>';
                                    echo '      <div id="viewAlert' . $news->getNewsId() . '" class="modal info hide">
                                                    <div class="modal-header">
                                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3>CHI TIẾT BẢN TIN</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>' . $news->getTitle() . '</b></p>
                                                        <div class="row-fluid">
                                                            <div class="span6 news-details-image" style="background-image: url(\'' . $news->getIllustrationURL() . '\')">
                                                            </div>

                                                            <div class="span6">
                                                                <div>
                                                                    <label class="span4 news-details-label">Loại tin: </label>
                                                                    <label class="span8">' . $hireOrSell . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Loại nhà đất: </label>
                                                                    <label class="span8">' . $news->getNewTypeName() . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Khu vực: </label>
                                                                    <label class="span8">' . $news->getLocationName() . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Diện tích: </label>
                                                                    <label class="span8">' . $news->getAcreage() . ' m<sup>2</sup></label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Giá bán: </label>
                                                                    <label class="span8">' . $utils->toStringMoney($news->getPrice()) . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Cập nhật: </label>
                                                                    <label class="span8">' . $news->getLastUpdated() . '</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <p class="news-details-des">' . $news->getDescription() . '</p>
                                                                <p class="news-details">' . $news->getDetail() . '</p>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span6">
                                                                <div class="widget-box">
                                                                    <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                                                                      <h5>Liên hệ</code></h5>
                                                                    </div>
                                                                    <div class="widget-content">
                                                                        <div class="form-horizontal">
                                                                            <div class="control-group">
                                                                                <label class="span4 news-details-label">Người bán: </label>
                                                                                <label class="span8">' . $ownerName . '</label>
                                                                            </div>
                                                                            <div class="control-group">
                                                                                <label class="span4 news-details-label">Điện thoại: </label>
                                                                                <label class="span8">' . $phoneNumber . '</label>
                                                                            </div>
                                                                            <div class="control-group">
                                                                                <label class="span4 news-details-label">Email: </label>
                                                                                <label class="span8">' . $email . '</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span6">
                                                                <div class="widget-box">
                                                                    <div class="widget-title"> <span class="icon"> <i class="icon-list"></i> </span>
                                                                      <h5>Thông tin khác</code></h5>
                                                                    </div>
                                                                    <div class="widget-content">
                                                                        <div class="form-horizontal">
                                                                            <div class="control-group">
                                                                                <label class="span4 news-details-label">Số phòng: </label>
                                                                                <label class="span8">' . $rooms . '</label>
                                                                            </div>
                                                                            <div class="control-group">
                                                                                <label class="span4 news-details-label">Hướng nhà: </label>
                                                                                <label class="span8">' . $tmpDirection[$news->getDirection()] . '</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"> 
                                                        <a data-dismiss="modal" class="btn btn-info" href="">Đóng</a>
                                                    </div>
                                                </div>';

                                    if ($news->getState() == 3) {
                                        echo '  <div style="float: left;">
                                                    <a href="#" data-toggle="modal" class="btn btn-danger tip-top disabled" data-original-title="Không thể cập nhật">
                                                        <i class="icon-remove-circle"></i>
                                                    </a>
                                                </div>';
                                    } else {
                                        $btnClass = 'success';
                                        if ($news->getState() == 2) {
                                            $btnClass = 'warning';
                                        }
                                        echo '  <div style="float: left;">
                                                    <a href="http://192.168.1.220:8080/RealEstate/admin/cap-nhat-bai-dang/' . $utils->makeURL($news->getTitle()) . '-' . $news->getNewsID() . '" class="btn btn-' . $btnClass . ' tip-top" data-original-title="Cập nhật">
                                                        <i class="icon-refresh"></i>
                                                    </a>
                                                </div>';

                                        if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
                                            echo '
                                                <div style="float: left;">
                                                    <a href="#toTrashAlert' . $news->getNewsId() . '" data-toggle="modal" title="Loại bỏ" class="btn btn-danger tip-top">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>';
                                            echo '
                                                <div id="toTrashAlert' . $news->getNewsId() . '" class="modal info hide">
                                                    <div class="modal-header">
                                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3>LOẠI BỎ BẢN TIN</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Loại bỏ bản tin <b>' . $news->getTitle() . '</b></p>
                                                        <p>Tin này sẽ được cho vào mục thùng rác và có thể phục hổi</p>
                                                        <div class="row-fluid">
                                                            <div class="span6 news-details-image" style="background-image: url(\'' . $news->getIllustrationURL() . '\')">
                                                            </div>

                                                            <div class="span6">
                                                                <div>
                                                                    <label class="span4 news-details-label">Loại tin: </label>
                                                                    <label class="span8">' . $hireOrSell . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Loại nhà đất: </label>
                                                                    <label class="span8">' . $news->getNewTypeName() . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Khu vực: </label>
                                                                    <label class="span8">' . $news->getLocationName() . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Diện tích: </label>
                                                                    <label class="span8">' . $news->getAcreage() . ' m<sup>2</sup></label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Giá bán: </label>
                                                                    <label class="span8">' . $utils->toStringMoney($news->getPrice()) . '</label>
                                                                </div>
                                                                <div>
                                                                    <label class="span4 news-details-label">Cập nhật: </label>
                                                                    <label class="span8">' . $news->getLastUpdated() . '</label>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer"> 
                                                        <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateNews.php" method="post">
                                                            <input type="hidden" name="newsID" value="' . $news->getNewsId() . '">
                                                            <button type="submit" class="btn btn-danger" name="move-news-to-trash" style="float: right; margin-left: 10px">
                                                                Xác nhận
                                                            </button>
                                                        </form>
                                                    &nbsp;
                                                        <a data-dismiss="modal" class="btn btn-info" href="">Hủy bỏ</a>
                                                    </div>
                                                </div>';
                                        }
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                        <div id="change_news_alert" class="modal hide">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>LOẠI BỎ BẢN TIN</h3>
                            </div>
                            <div class="modal-body">
                                <p>Loại bỏ bản tin thành công</p>
                                <p>Bản tin đã được chuyển vào thùng rác và có thể khôi phục lại</p>
                            </div>
                            <div class="modal-footer"> 
                                <a data-dismiss="modal" class="btn btn-primary" href="">Đóng</a> 
                            </div>
                        </div>
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
    echo "$('#change_news_alert').modal('show');";
}
?>
            });
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>


