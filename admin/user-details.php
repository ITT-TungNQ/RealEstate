<?php
// ========== CHECK LOGIN ==========
require_once("include/check-role.php");
require_once("util/Constant.php");

/* ========== GET USERS FROM DB ========== */
require_once("util/AccessDatabase.php");
require_once("util/User.php");
require_once("controller/GetUser.php");

$userID = $_SESSION['login_user']['UserID'];
$user = getUserByID($userID);

if (!isset($user)) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/pages/logout.php");
}

$username = $user->getUsername();
$first_name = $user->getFirstName();
$middle_name = $user->getMiddleName();
$last_name = $user->getLastName();
$user_dob = $user->getDOB();
$user_img = $user->getProfileImageURL();
$user_level = $user->getUserLevelID();
$user_email = $user->getEmail();

$change_info_msg = filter_input(INPUT_COOKIE, 'change_info_msg');
if (isset($change_info_msg)) {
    setcookie("change_info_msg", "", time() - 3600, "/RealEstate/admin/user-details.php");
} else {
    $change_info_msg = '';
}

$change_pwd_msg = filter_input(INPUT_COOKIE, 'change_pwd_msg');
if (!isset($change_pwd_msg)) {
    $change_pwd_msg = '';
} else {
    setcookie("change_pwd_msg", "", time() - 3600, "/RealEstate/admin/user-details.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Thông tin tài khoản</title>
        <?php include("include/header.php"); ?>
        <style type="text/css">
            #imageClear:hover {
                cursor: pointer;
            }
        </style>
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/user-details.php" class="current">
                        <i class="icon-user"></i> Thông tin tài khoản
                    </a>
                </div>
                <h1>Thông tin tài khoản</h1>
            </div>
            <div class="container-fluid">
                <hr>
                <div class="row-fluid">
                    <div class="span6">
                        <?php
                        if ($change_pwd_msg != '') {
                            echo '<div class="widget-box" style="text-align:center;font-weight:bold">' . $change_pwd_msg . '</div>';
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
                                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateUser.php" method="post" id="form-changepwd-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">Tài khoản :</label>
                                        <div class="controls">
                                            <input value="<?php echo($username); ?>" id="username" class="span11" type="text" name="username" placeholder="Nhập tên tài khoản" readonly="" >
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mật khẩu mới :</label>
                                        <div class="controls">
                                            <input value="" type="password" name="pwd" id="pwd" class="span11" placeholder="Nhập mật khẩu mới" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Xác nhận mật khẩu mới :</label>
                                        <div class="controls">
                                            <input value="" type="password" name="pwd2" id="pwd2" class="span11" placeholder="Xác nhận mật khẩu mới" />
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="change_pwd_id" value="<?php echo $userID ?>">
                                        <button type="submit" class="btn btn-success" name="change-pwd" style="float: right; margin-right: 10px;">ĐỔI MẬT KHẨU</button>
                                    </div>
                                </form>	
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <?php
                        if ($change_info_msg != '') {
                            echo '<div class="widget-box">' . $change_info_msg . '</div>';
                        }
                        ?>
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-list-ul"></i>
                                </span>
                                <h5>Thông tin tài khoản quản lý</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateUser.php" method="post" id="form-wizard-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
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
                                        <label class="control-label">E-mail :</label>
                                        <div class="controls">
                                            <input value="<?php echo($user_email); ?>" id="user_email" type="email" class="span11" name="user_email" placeholder="Nhập e-mail" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Ảnh đại diện</label>
                                        <div class="controls">
                                            <div class="preview-img-container" id="preview-img-container" style="background-image: url('<?php echo $user_img ?>')">
                                                <!--<img id="preview-img" class="preview-img" src="<?php echo $user_img ?>">-->
                                            </div>
                                            <span class="help-block" id="img-message">Kích thước tối đa 5MB</span>
                                            <input id="profile_picture" name="profile_picture" type="file" />
                                            <a id="imageClear" class="tip" data-original-title="Xóa ảnh"><i class="icon-remove"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="change_info_id" value="<?php echo $userID ?>">
                                        <button type="submit" class="btn btn-success" name="change-info" style="float: right; margin-right: 10px;">CẬP NHẬT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </div>


        <?php include("include/footer.php"); ?>

        <script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.wizard.js"></script>
        <!-- Highlight menu -->
        <script type="text/javascript">
            $('div#sidebar ul li.header_menu_link').removeClass('active');
            $('div#sidebar ul li.header_menu_link').removeClass('open');
        </script>
        <!-- end-Highlight menu -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#imageClear').on('click', function () {
                    //$('#preview-img').attr('src', '<?php echo $user_img ?>');
                    $('#preview-img-container').css({"backgroundImage": "url('<?php echo $user_img ?>'"});
                    $('#profile_picture').val('');
                    $('.filename').html('No file selected');
                });
            });
        </script>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/add-user.form_validation.js"></script>
    </body>
</html>