<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once('./util/Constant.php');
require ('./include/check-role.php');
checkRole(Constants::CREATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========

/* ========== ADD CALLBACK IF FAILED ========== */
$username = filter_input(INPUT_COOKIE, 'username');
$username_err = filter_input(INPUT_COOKIE, 'username_err');
$first_name = filter_input(INPUT_COOKIE, 'first_name');
$middle_name = filter_input(INPUT_COOKIE, 'middle_name');
$last_name = filter_input(INPUT_COOKIE, 'last_name');
$user_dob = filter_input(INPUT_COOKIE, 'user_dob');
$user_email = filter_input(INPUT_COOKIE, 'user_email');
$user_level = 5;
if ($username) {
    setcookie('username', '', time() - 36000, '/RealEstate/admin');
} else {
    $username = '';
}
if (isset($username_err)) {
    setcookie('username_err', '', time() - 36000, '/RealEstate/admin');
} else {
    $username_err = '';
}
if (isset($first_name)) {
    setcookie('first_name', '', time() - 36000, '/RealEstate/admin');
} else {
    $first_name = '';
}
if (isset($middle_name)) {
    setcookie('middle_name', '', time() - 36000, '/RealEstate/admin');
} else {
    $middle_name = '';
}
if (isset($last_name)) {
    setcookie('last_name', '', time() - 36000, '/RealEstate/admin');
} else {
    $last_name = '';
}
if (isset($user_dob)) {
    setcookie('user_dob', '', time() - 36000, '/RealEstate/admin');
} else {
    $user_dob = '';
}
if (isset($user_email)) {
    setcookie('user_email', '', time() - 36000, '/RealEstate/admin');
} else {
    $user_email = '';
}
if (isset($user_level)) {
    setcookie('user_level', '', time() - 36000, '/RealEstate/admin');
} else {
    $user_level = '';
}

$insert_err = filter_input(INPUT_COOKIE, '$insert_err');
if (isset($insert_err)) {
    setcookie('insert_err', '', time() - 36000, '/RealEstate/admin');
} else {
    $insert_err = '';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm tài khoản quản lý</title>
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/add-new-user.php" class="current">
                        <i class="icon-user"></i> Thêm tài khoản mới
                    </a>
                </div>
                <h1>Thêm tài khoản quản lý</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/AddUser.php" method="post" id="form-wizard-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="row-fluid">
                        <div class="span3">
                        </div>
                        <div class="span6">
                            <?php
                            if ($insert_err != '') {
                                echo '<div class="widget-box">' . $insert_err . '</div>';
                            }
                            ?>
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
                                            <input value="<?php echo($username); ?>" id="username" class="span11" type="text" name="username" placeholder="Nhập tên tài khoản">
                                            <span class="help-inline">
                                                <?php echo($username_err); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mật khẩu :</label>
                                        <div class="controls">
                                            <input value="" type="password" name="pwd" id="pwd" class="span11" placeholder="Nhập mật khẩu" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Xác nhận mật khẩu :</label>
                                        <div class="controls">
                                            <input value="" type="password" name="pwd2" id="pwd2" class="span11" placeholder="Xác nhận mật khẩu" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span3">

                        </div>

                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-align-justify"></i>
                                    </span>
                                    <h5>Thông tin tài khoản quản lý</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="control-group">
                                        <label class="control-label">Họ :</label>
                                        <div class="controls">
                                            <input value="<?php echo($last_name); ?>" id="last_name" type="text" class="span11" name="last_name" placeholder="Nhập họ" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tên đệm :</label>
                                        <div class="controls">
                                            <input value="<?php echo($middle_name); ?>" id="middle_name" type="text" class="span11" name="middle_name" placeholder="Nhập tên đệm" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tên :</label>
                                        <div class="controls">
                                            <input value="<?php echo($first_name); ?>" id="first_name" type="text" class="span11" name="first_name" placeholder="Nhập tên" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Ngày sinh :</label>
                                        <div class="controls">
                                            <input type="text" id="user_dob" class="datepicker span11" name="user_dob" data-date="" data-date-format="dd/mm/yyyy" value="<?php echo($user_dob); ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Email :</label>
                                        <div class="controls">
                                            <input type="email" id="user_email" name="user_email" value="<?php echo($user_email); ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Ảnh đại diện</label>
                                        <div class="controls">
                                            <div id="preview-img-container" class="preview-img-container">
                                                <!--<img id="preview-img" class="preview-img" src="http://192.168.1.220:8080/RealEstate/admin/img/noimage.png">-->
                                            </div>
                                            <span class="help-block" id="img-message">Kích thước tối đa 5MB</span>
                                            <input id="profile_picture" name="profile_picture" type="file" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Cấp độ tài khoản</label>
                                        <div class="controls">
                                            <label>
                                                <input type="radio" name="user_level" <?php if ($user_level == 5) echo 'checked=""' ?> value="5" />
                                                Nhân viên hỗ trợ
                                            </label>
                                            <label>
                                                <input type="radio" name="user_level" <?php if ($user_level == 4) echo 'checked=""' ?> value="4" />
                                                Nhân viên đăng tin
                                            </label>
                                            <label>
                                                <input type="radio" name="user_level" <?php if ($user_level == 3) echo 'checked=""' ?> value="3" />
                                                Nhân viên giám sát
                                            </label>
                                            <label>
                                                <input type="radio" name="user_level" <?php if ($user_level == 2) echo 'checked=""' ?> value="2" />
                                                Quản trị viên hệ thống
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="checkbox" name="user_enable" checked="" /> Được phép hoạt động
                                        <button type="submit" class="btn btn-success" name="new-user" style="float: right;">THÊM MỚI</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include("include/footer.php"); ?>

        <script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.wizard.js"></script>
        <!-- Highlight menu -->
        <script type="text/javascript">
            $('div#sidebar ul:eq(1)').slideDown();
            $('div#sidebar ul li.header_menu_link').removeClass('active');
            $('div#sidebar ul li.header_menu_link').removeClass('open');
            $('div#sidebar ul li.header_menu_link:eq(1)').addClass('open');
            $('div#sidebar ul li.open ul li:eq(0)').addClass('active');

            if ($("#user_dob").val() == "") {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm
                }
                ;
                $("#user_dob").val(dd + '/' + mm + '/' + yyyy);
            }
        </script>
        <!-- end-Highlight menu -->
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/add-user.form_validation.js"></script>
    </body>
</html>