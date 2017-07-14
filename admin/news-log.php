<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once('./util/Constant.php');
require_once ('./include/check-role.php');
checkRole(Constants::VIEW_NEWS_LOG);
// ========== end - CHECK LOGIN AND ROLE ==========

require_once './util/NewsLog.php';
require_once './util/News.php';
require_once './util/User.php';
require_once './controller/dao/NewsLogDAO.php';
$listNewsLog = getAllLogs();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nhật ký đăng tin</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <?php include("include/top-header.php"); ?>
        <?php include("include/left-menu.php"); ?>

        <div id="content">
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="http://192.168.1.220:8080/RealEstate/admin/" title="Tới trang chủ" class="tip-bottom">
                        <i class="icon icon-home"></i> Trang chủ
                    </a>
                    <a>
                        <i class="icon icon-file"></i> Quản lý bản tin
                    </a>
                    <a href="http://192.168.1.220:8080/RealEstate/admin/nhat-ky-bai-dang" class="current">
                        <i class="icon icon-calendar"></i> Nhật ký đăng tin
                    </a>
                </div>
                <h1>Nhật ký đăng tin</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Danh sách nhật ký đăng tin</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="list-news" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Tiêu đề bản tin</th>
                                    <th>Loại tin rao</th>
                                    <th>Loại nhà đất</th>
                                    <th>Khu vực</th>
                                    <th>Thay đổi</th>
                                    <th>Người thay đổi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listNewsLog as $log) {
                                    $hireOrSell = '';
                                    if ($log->getNews()->getIsHire()) {
                                        $hireOrSell = 'Tin cho thuê';
                                    } else {
                                        $hireOrSell = 'Tin đăng bán';
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $log->getNews()->getTitle() . '</td>';
                                    echo '<td>' . $hireOrSell . '</td>';
                                    echo '<td>' . $log->getNews()->getNewTypeName() . '</td>';
                                    echo '<td>' . $log->getNews()->getLocationName() . '</td>';
                                    echo '<td style="text-align:center">' . $log->getLogTypeName() . '<br/>' . $log->getLogTime() . '</td>';
                                    echo '<td style="text-align:center"> <a data-toggle="modal" href="#userAlert' . $log->getUser()->getUserID() . '">' . $log->getUser()->getUserLevelName() . '<br/>' . $log->getUser()->getLastName() . ' ' . $log->getUser()->getMiddleName() . ' ' . $log->getUser()->getFirstName() . '</a>';
                                    echo '  <div id="userAlert' . $log->getUser()->getUserID() . '" class="modal hide" style="text-align:left">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">×</button>
                                                    <h3>Tài khoản quản lý</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="profile-image" style="background-image: url(\'' . $log->getUser()->getProfileImageURL() . '\')">
                                                    </div>
                                                    <div class="row-fluid manager">
                                                        <div class="widget-box manager">
                                                            <div class="widget-title">
                                                                <span class="icon">
                                                                    <i class="icon-list-ul"></i>
                                                                </span>
                                                                <h5>Thông tin tài khoản</h5>
                                                            </div>
                                                            <div class="widget-content nopadding manager">
                                                                <form class="form-horizontal">
                                                                    <div class="control-group">
                                                                        <label class="control-label manager">Họ và tên :</label>
                                                                        <div class="controls manager">
                                                                            <input value="' . $log->getUser()->getLastName() . ' ' . $log->getUser()->getMiddleName() . ' ' . $log->getUser()->getFirstName() . '" type="text" readonly="" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label manager">Ngày sinh :</label>
                                                                        <div class="controls manager">
                                                                            <input value="' . $log->getUser()->getDOB() . '" type="text" readonly="" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label manager">Email :</label>
                                                                        <div class="controls manager">
                                                                            <input value="' . $log->getUser()->getEmail() . '" type="text" readonly="" >
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"> 
                                                    <a data-dismiss="modal" class="btn btn-info" href="">Đóng</a>
                                                </div>
                                            </div>';
                                    echo '</td>';

                                    echo '</tr>';
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
                $('div#sidebar ul li.open ul li:eq(2)').addClass('active');
            });
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>
