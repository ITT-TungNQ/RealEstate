<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once('./util/Constant.php');
require_once ('./include/check-role.php');
checkRole(Constants::CHANGE_NEWS_STATE);
// ========== end - CHECK LOGIN AND ROLE ==========

require_once './util/Utils.php';
require_once './util/News.php';
require_once './controller/dao/NewsDAO.php';
$listNews = getNewsBySate(Constants::DISABLE);

/* ========= AFTER UPDATE ========== */
$modalTitle = '';
$modalDetails = '';

$cookieModal = filter_input(INPUT_COOKIE, 'change_news_state');
if (isset($cookieModal)) {
    setcookie("change_news_state", "", time() - 3600, Constants::PREFIX_PATH . '/admin/thung-rac', Constants::DOMAIN);

    $changeTo = filter_input(INPUT_COOKIE, 'change_to');
    if (isset($changeTo)) {
        setcookie("change_to", "", time() - 3600, Constants::PREFIX_PATH . '/admin/thung-rac', Constants::DOMAIN);

        if (isset($changeTo)) {
            switch ($changeTo) {
                case Constants::ENABLE:
                    $modalTitle = 'KHÔI PHỤC ĐĂNG';
                    if ($cookieModal == 'true') {
                        $modalDetails = '<p>Khôi phục bài đăng thành công</p>'
                                . '<p>Bài đăng đã được khôi phục và hiển thị trên trang thông tin</p>';
                    } else {
                        $modalDetails = '<p>Khôi phục bài đăng không thành công</p> '
                                . '<p>Bài đăng trong trạng thái <b>Ẩn</b></p>';
                    }

                    break;
                case Constants::DETELED:
                    $modalTitle = 'XÓA BÀI ĐĂNG';
                    if ($cookieModal == 'true') {
                        $modalDetails = '<p>Xóa bài đăng thành công</p>'
                                . '<p>Bài đăng đã được xóa và không thể khôi phục để hiển thị trên trang thông tin</p>';
                    } else {
                        $modalDetails = '<p>Xóa bài đăng không thành công</p> '
                                . '<p>Bài đăng trong trạng thái <b>Ẩn</b></p>';
                    }
                    break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý thùng rác</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <div class="outer" id="loading-on-submit">
            <div class="middle">
                <div id="loading-box" >
                    <div class="control-group normal_text">
                        <img src="http://192.168.1.220:8080/RealEstate/admin/img/status.gif" alt="Logo Admin" />
                    </div>
                </div>
            </div>
        </div>
        
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/thung-rac" class="current">
                        <i class="icon-trash"></i> Thùng rác
                    </a>
                </div>
                <h1>Quản lý thùng rác</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Danh sách bản tin trong thùng rác</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="list-news" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Loại tin rao</th>
                                    <th>Loại nhà đất</th>
                                    <th>Ngày tạo</th>
                                    <th>Khu vực</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $utils = new Utils();
                                $tmpDirection = Constants::$DIRECTION;
                                foreach ($listNews as $news) {
                                    //  { "owner_name": "Đào Thị Thu Hương", "phone_number": "0972675028", "email": "huongdtt@gmail.com" }
                                    $objContact = json_decode($news->getContact());
                                    $ownerName = $objContact->{'owner_name'};
                                    $phoneNumber = $objContact->{'phone_number'};
                                    if (isset($objContact->{'email'})) {
                                        $email = $objContact->{'email'};
                                    } else {
                                        $email = '';
                                    }
                                    
                                    $hireOrSell = '';
                                    if ($news->getIsHire()) {
                                        $hireOrSell = 'Tin cho thuê';
                                    } else {
                                        $hireOrSell = 'Tin đăng bán';
                                    }
                                    
                                    $rooms = 'Liên hệ';
                                    if ($news->getRoom() > 0) {
                                        $rooms = $news->getRoom();
                                    }
                                    
                                    echo '<tr>';
                                    echo '<td>' . $news->getTitle() . '</td>';
                                    echo '<td>' .  $hireOrSell . '</td>';
                                    echo '<td>' . $news->getNewTypeName() . '</td>';
                                    echo '<td>' . $news->getLastUpdated() . '</td>';
                                    echo '<td>' . $news->getLocationName() . '</td>';
                                    echo '<td>';
                                    echo '  <div style="float: left;">
                                                <a href="#viewAlert' . $news->getNewsId() . '" data-toggle="modal" class="btn btn-info tip-top" title="Xem chi tiết">
                                                    <i class="icon-eye-open"></i>
                                                </a>
                                            </div>';
                                    echo '  <div id="viewAlert' . $news->getNewsId() . '" class="modal info hide">
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
                                                                <label class="span8">'. $hireOrSell . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Loại nhà đất: </label>
                                                                <label class="span8">'. $news->getNewTypeName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Khu vực: </label>
                                                                <label class="span8">'. $news->getLocationName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Diện tích: </label>
                                                                <label class="span8">'. $news->getAcreage(). ' m<sup>2</sup></label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Giá bán: </label>
                                                                <label class="span8">'. $utils->toStringMoney($news->getPrice()) . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Cập nhật: </label>
                                                                <label class="span8">'. $news->getLastUpdated() . '</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="news-details-des">' . $news->getDescription() . '</div>
                                                            <div class="news-details">' . $news->getDetail() . '</div>
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
                                                                            <label class="span8">'. $ownerName . '</label>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="span4 news-details-label">Điện thoại: </label>
                                                                            <label class="span8">'. $phoneNumber . '</label>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="span4 news-details-label">Email: </label>
                                                                            <label class="span8">'. $email . '</label>
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
                                                                            <label class="span8">'. $rooms . '</label>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="span4 news-details-label">Hướng nhà: </label>
                                                                            <label class="span8">'. $tmpDirection[$news->getDirection()] . '</label>
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
                                    echo '
                                            <div style="float: left;">
                                                <a href="#recocerAlert' . $news->getNewsId() . '" data-toggle="modal" title="Khôi phục" class="btn btn-warning tip-top">
                                                    <i class="icon-undo"></i>
                                                </a>
                                            </div>';
                                    echo '
                                            <div id="recocerAlert' . $news->getNewsId() . '" class="modal info hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>KHÔI PHỤC BẢN TIN</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Khôi phục lại bản tin: <b>' . $news->getTitle() . '</b></p>
                                                    <p>Bản tin sẽ được tiếp tục hiển thị trên trang chủ</p>
                                                    <div class="row-fluid">
                                                        <div class="span6 news-details-image" style="background-image: url(\'' . $news->getIllustrationURL() . '\')">
                                                        </div>

                                                        <div class="span6">
                                                            <div>
                                                                <label class="span4 news-details-label">Loại tin: </label>
                                                                <label class="span8">'. $hireOrSell . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Loại nhà đất: </label>
                                                                <label class="span8">'. $news->getNewTypeName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Khu vực: </label>
                                                                <label class="span8">'. $news->getLocationName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Diện tích: </label>
                                                                <label class="span8">'. $news->getAcreage(). ' m<sup>2</sup></label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Giá bán: </label>
                                                                <label class="span8">'. $utils->toStringMoney($news->getPrice()) . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Cập nhật: </label>
                                                                <label class="span8">'. $news->getLastUpdated() . '</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"> 
                                                    <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateNews.php" method="post">
                                                        <input type="hidden" name="newsID" value="' . $news->getNewsId() . '">
                                                        <button type="submit" class="btn btn-warning" name="recover-news" style="float: right; margin-left: 10px">
                                                            Xác nhận
                                                        </button>
                                                    </form>
                                                &nbsp;
                                                    <a data-dismiss="modal" class="btn btn-info" href="">Hủy bỏ</a>
                                                </div>
                                            </div>';
                                    echo '
                                            <div style="float: left;">
                                                <a href="#deleteAlert' . $news->getNewsId() . '" data-toggle="modal" title="Xóa" class="btn btn-danger tip-top">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            </div>';
                                    echo '
                                            <div id="deleteAlert' . $news->getNewsId() . '" class="modal info hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>XÓA BẢN TIN</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Xóa bản tin <b>' . $news->getTitle() . '</b></p>
                                                    <p>Tin này sẽ được xóa và không thể phục hồi</p>
                                                    <div class="row-fluid">
                                                        <div class="span6 news-details-image" style="background-image: url(\'' . $news->getIllustrationURL() . '\')">
                                                        </div>

                                                        <div class="span6">
                                                            <div>
                                                                <label class="span4 news-details-label">Loại tin: </label>
                                                                <label class="span8">'. $hireOrSell . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Loại nhà đất: </label>
                                                                <label class="span8">'. $news->getNewTypeName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Khu vực: </label>
                                                                <label class="span8">'. $news->getLocationName(). '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Diện tích: </label>
                                                                <label class="span8">'. $news->getAcreage(). ' m<sup>2</sup></label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Giá bán: </label>
                                                                <label class="span8">'. $utils->toStringMoney($news->getPrice()) . '</label>
                                                            </div>
                                                            <div>
                                                                <label class="span4 news-details-label">Cập nhật: </label>
                                                                <label class="span8">'. $news->getLastUpdated() . '</label>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer"> 
                                                    <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateNews.php" method="post">
                                                        <input type="hidden" name="newsID" value="' . $news->getNewsId() . '">
                                                        <button type="submit" class="btn btn-danger" name="delete-news" style="float: right; margin-left: 10px">
                                                            Xác nhận
                                                        </button>
                                                    </form>
                                                &nbsp;
                                                    <a data-dismiss="modal" class="btn btn-info" href="">Hủy bỏ</a>
                                                </div>
                                            </div>';

                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>

                        <div id="change_news_alert" class="modal hide">
                            <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3><?php echo $modalTitle ?></h3>
                            </div>
                            <div class="modal-body">
                                <?php echo $modalDetails ?>
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
                $('div#sidebar ul li.open ul li:eq(4)').addClass('active');

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
