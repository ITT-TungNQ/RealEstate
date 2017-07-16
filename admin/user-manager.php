<?php
// ========== CHECK LOGIN ==========
require_once("include/check-role.php");
require_once("util/Constant.php");

/* ========== CHECK ROLE ON SESSION ========== */
checkRole(Constants::UPDATE_USER_INFO);

/* ========== GET USERS FROM DB ========== */
require_once("util/AccessDatabase.php");
require_once("util/User.php");
require_once("controller/GetUser.php");
$lstUser = getAllUser();

/* ========= AFTER UPDATE ========== */
$cookieModal = filter_input(INPUT_COOKIE, 'user_modal');
$change_info_msg = filter_input(INPUT_COOKIE, 'change_info_msg');

if (isset($cookieModal)) {
    setcookie("user_modal", "", time()-3600, "/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
}
if (isset($change_info_msg)) {
    setcookie("change_info_msg", "", time()-3600,"/RealEstate/admin/danh-sach-tai-khoan-quan-ly");
} else {
    $change_info_msg = ' ';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý tài khoản quản lý</title>
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
                        <i class="icon-user-md"></i> Quản lý tài khoản
                    </a>
                    <a href="http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly" class="current">
                        <i class="icon-group"></i> Quản lý tài khoản
                    </a>
                </div>
                <h1>Quản lý tài khoản</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>Danh sách tài khoản quản lý</h5>
                        <a href="http://192.168.1.220:8080/RealEstate/admin/them-tai-khoan-quan-ly" class="label label-danger" style="padding: 5px; margin-top: 6px;"><i class="icon-plus"></i> Thêm mới tài khoản</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table id="list-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tài khoản</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Cấp độ</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($lstUser as $user) {
                                    if ($user->getUserID() == $_SESSION['login_user']['UserID'] || $user->getUserLevelId() == Constants::SUPER_ADMIN) {
                                        continue;
                                    }
                                    echo "<tr>";
                                    echo "<td><b>" . $user->getUserName() . "</b></td>";
                                    echo "<td>" . $user->getLastName() . "</td>";
                                    echo "<td>" . $user->getMiddleName() . ' ' . $user->getFirstName() . "</td>";
                                    echo "<td>" . $user->getDOB() . "</td>";
                                    echo "<td>" . $user->getUserLevelName() . "</td>";
                                    if ($user->getEnable() == 1) {
                                        $alertTitle = "<b>KHÓA TÀI KHOẢN</b>";
                                        $alertMsg = "Xác nhận khóa quyền truy cập hệ thống của tài khoản: ";
                                        echo "<td>KÍCH HOẠT</td> ";
                                    } else {
                                        $alertTitle = "<b>KÍCH HOẠT TÀI KHOẢN</b>";
                                        $alertMsg = "Xác nhận kích hoạt truy cập hệ thống của tài khoản: ";
                                        echo "<td>KHÓA</td>";
                                    }
                                    echo "<td>";
                                    echo '
                                            <div style="float: left;">
                                                <a href="#editAlert' . $user->getUserID() . '" data-toggle="modal" class="btn btn-info">
                                                    <i class="icon-pencil"></i>
                                                </a>
                                                <div id="editAlert' . $user->getUserID() . '" class="modal hide">
                                                    <div class="modal-header">
                                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3 style="font-size: 20px;"><b>CHỈNH SỬA TÀI KHOẢN QUẢN LÝ</b></h3>
                                                    </div>
                                                    <form id="form-user-info-validate" class="form-horizontal" action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateUser.php" method="post" novalidate="novalidate">
                                                        <div class="modal-body">
                                                            <div class="change-msg">'. $change_info_msg . '</div>
                                                            <div class="profile-image" style="background-image: url(\'' . $user->getProfileImageURL() . '\')">
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
                                                                        <div class="control-group">
                                                                            <label class="control-label manager">Họ và tên :</label>
                                                                            <div class="controls manager">
                                                                                <input value="' . $user->getLastName() . ' ' . $user->getMiddleName() . ' ' . $user->getFirstName() . '" type="text" readonly="" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label manager">Ngày sinh :</label>
                                                                            <div class="controls manager">
                                                                                <input value="' . $user->getDOB() . '" type="text" readonly="" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label manager">Email :</label>
                                                                            <div class="controls manager">
                                                                                <input value="' . $user->getEmail() . '" type="text" readonly="" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row-fluid">
                                                                <div class="widget-box">
                                                                    <div class="widget-title">
                                                                        <span class="icon">
                                                                            <i class="icon-user"></i>
                                                                        </span>
                                                                        <h5>Tài khoản quản lý</h5>
                                                                    </div>
                                                                    <div class="widget-content nopadding">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Tài khoản :</label>
                                                                            <div class="controls">
                                                                                <input value="' . $user->getUsername() . '" id="username"  type="text" name="username" readonly="" >
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Mật khẩu mới :</label>
                                                                            <div class="controls">
                                                                                <input id="pwd" name="pwd" type="password" placeholder="Nhập mật khẩu mới" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Xác nhận MK :</label>
                                                                            <div class="controls">
                                                                                <input id="pwd2" name="pwd2" type="password" placeholder="Xác nhận mật khẩu mới"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>';
                                                               
                                    if (in_array(Constants::DISTRIBUTION_USER_RIGHTS, $_SESSION['user_role'])) {
                                        echo '                  <div class="widget-box">
                                                                    <div class="widget-title">
                                                                        <span class="icon">
                                                                            <i class="icon-wrench"></i>
                                                                        </span>
                                                                        <h5>Quyền hạn truy cập</h5>
                                                                    </div>
                                                                    <div class="widget-content nopadding">
                                                                        <div class="control-group">
                                                                            <div class="controls">
                                                                                <label></label>
                                                                                <label>
                                                                                    <input type="radio" name="user_level' . $user->getUserID() . '" value="5" '; echo ($user->getUserLevelID() == 5) ? 'checked' : ''; echo '/>
                                                                                    Nhân viên hỗ trợ
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="user_level' . $user->getUserID() . '" value="4" '; echo ($user->getUserLevelID() == 4) ? 'checked' : ''; echo '/>
                                                                                    Nhân viên đăng tin
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="user_level' . $user->getUserID() . '" value="3" '; echo ($user->getUserLevelID() == 3) ? 'checked' : ''; echo '/>
                                                                                    Nhân viên giám sát
                                                                                </label>
                                                                                <label>
                                                                                    <input type="radio" name="user_level' . $user->getUserID() . '" value="2" '; echo ($user->getUserLevelID() == 2) ? 'checked' : ''; echo '/>
                                                                                    Quản trị viên hệ thống
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>        
                                                                </div>';
                                    }
                                    echo '                  </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="userID" value="' . $user->getUserID() . '">
                                                            <button type="submit" class="btn btn-danger" name="update-user-info" style="float: right; margin-left: 10px">
                                                                Xác nhận
                                                            </button>
                                                            &nbsp;
                                                            <a data-dismiss="modal" class="btn btn-info" href="">Hủy bỏ</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div style="float: left;">';
                                    if ($user->getEnable() == 1) {
                                        echo '  <a href="#removeAlert' . $user->getUserID() . '" data-toggle="modal" class="btn btn-danger">
                                                    <i class="icon-ban-circle"></i>';
                                    } else {
                                        echo '  <a href="#removeAlert' . $user->getUserID() . '" data-toggle="modal" class="btn btn-warning">
                                                    <i class="icon-ok-circle"></i>';
                                    }
                                    echo '
                                                </a>
                                                <div id="removeAlert' . $user->getUserID() . '" class="modal hide">
                                                    <div class="modal-header">
                                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                                        <h3 style="font-size: 20px;">' . $alertTitle . '</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="font-size: 14px;">' . $alertMsg . '<b>' . $user->getUserName() . '</b>' . '</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateUser.php" method="post">
                                                            <input type="hidden" name="userID" value="' . $user->getUserID() . '">
                                        ';
                                    if ($user->getEnable() == 1) {
                                        echo '
                                                            <button type="submit" class="btn btn-danger" name="deactivate-user" style="float: right; margin-left: 10px">
                                                                Xác nhận
                                                            </button>';
                                    } else {
                                        echo '
                                                            <button type="submit" class="btn btn-warning" name="activate-user" style="float: right; margin-left: 10px">
                                                                Xác nhận
                                                            </button>';
                                    }

                                    echo '		</form>
                                                        &nbsp;
                                                        <a data-dismiss="modal" class="btn btn-info" href="">Hủy bỏ</a>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                    echo "</td>";
                                    echo "</tr>";
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
                $('div#sidebar ul:eq(1)').slideDown();
                $('div#sidebar ul li.header_menu_link').removeClass('active');
                $('div#sidebar ul li.header_menu_link').removeClass('open');
                $('div#sidebar ul li.header_menu_link:eq(1)').addClass('open');
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