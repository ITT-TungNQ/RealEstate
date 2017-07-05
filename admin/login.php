<?php
include("util/AccessDatabase.php");
session_start();

$msg = '&nbsp;';
if (isset($_SESSION['login_user']['FirstName'])) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/index.php");
} else {
    $my_username = filter_input(INPUT_COOKIE, 'logged_username');
    $my_password = filter_input(INPUT_COOKIE, 'logged_pwd');
    if (isset($my_username) && isset($my_password)) {
        doLoggin($my_username, $my_password);
    }
}

/* ========== START: LOGIN ========== */
$btnLogin = filter_input(INPUT_POST, 'login');
$inputUsername = filter_input(INPUT_POST, 'username');
$inputPwd = filter_input(INPUT_POST, 'pwd');
if (isset($btnLogin) && !empty($inputUsername) && !empty($inputPwd)) {
    $conn = getConnection();
    $my_username = mysqli_real_escape_string($conn, $inputUsername);
    $my_password = sha1(mysqli_real_escape_string($conn, $inputPwd));
    doLoggin($my_username, $my_password);
}

function doLoggin($my_username, $my_password) {
    $conn = getConnection();
    $sql = "SELECT UserID, UserLevelID, Username, FirstName, LastName, MiddleName, ProfileImageURL, Enable FROM user WHERE username = '$my_username' and Password = '$my_password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1 && $my_username == $row['Username']) {
        if ($row['Enable'] == 0) {
            $GLOBALS['msg'] = 'Tài khoản của bạn đã bị khóa!';
        } else {
            // =========== SAVE USER IN SESSION ===========
            $_SESSION['login_user'] = $row;
            $_SESSION['timeout'] = time() + 1800;
            // =========== Update last login and online ===========
            $sql = "UPDATE user SET `Online`=b'1', LastLogin='" . date('Y-m-d H:i:s') . "' "
                    . "WHERE UserID = '" . $row['UserID'] . "'";
            if (mysqli_query($conn, $sql)) {
                echo "Records updated successfully.";
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }

            // =========== GET USER ROLE ===========
            $sql = "SELECT sys_function.FunctionID, FunctionName 
                    FROM sys_function, user_level, user_role 
                    WHERE user_level.UserLevelID = " . $row['UserLevelID'] . " AND 
                          user_level.UserLevelID = user_role.UserLevelID AND 
                          user_role.FunctionID = sys_function.FunctionID 
                          ORDER BY sys_function.FunctionID;";
            $result = mysqli_query($conn, $sql);
            $role = array();
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                array_push($role, $row['FunctionID']);
            }
            // Save in session:
            $_SESSION['user_role'] = $role;

            $GLOBALS['msg'] = 'Đăng nhập thành công!';
            $isRemember = filter_input(INPUT_POST, 'remember_login');
            if (isset($isRemember)) {
                if ($isRemember) {
                    setcookie('logged_username', $my_username, time() + 604800, '/RealEstate/admin/login.php');
                    setcookie('logged_pwd', $my_password, time() + 604800, '/RealEstate/admin/login.php');
                } else {
                    setcookie('logged_username', '', time() - 36000, '/RealEstate/admin/login.php');
                    setcookie('logged_pwd', '', time() - 36000, '/RealEstate/admin/login.php');
                }
            }
            closeConnect($conn);
            header("location: http://192.168.1.220:8080/RealEstate/admin/index.php");
        }
    } else {
        $GLOBALS['msg'] = 'Sai tài khoản hoặc mật khẩu!';
    }
}

/* ========== END: LOGIN ========== */

/* ========== START: RECOVER PWD ========== */
$recover_msg = '';
$inputEmail = filter_input(INPUT_POST, 'userEmail');
$btnRecoverPwd = filter_input(INPUT_POST, 'recover-pwd');
$isRecoverPwd = false;
if (isset($btnRecoverPwd) && !empty($inputUsername) && !empty($inputEmail)) {
    require './util/Utils.php';
    $new_pwd = (new Utils())->pwdGenerate();
    
    $isRecoverPwd = true;
    $conn = getConnection();
    $my_username = mysqli_real_escape_string($conn, $inputUsername);
    $new_pwd = mysqli_real_escape_string($conn, $new_pwd);
    $my_email = mysqli_real_escape_string($conn, $inputEmail);
    $sql = "UPDATE user SET Password = '" . sha1($new_pwd) . "' "
            . "WHERE email='$my_email' AND Username='$my_username';";
    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn) == 1) {
            $isRecoverPwd = false;
            require_once './util/SendMail.php';
            sendNewPwd($my_email, $new_pwd);
            $GLOBALS['msg'] = "Mật khẩu mới đã được gửi vào e-mail của bạn.";
            //echo "Password successfully!";
        } else {
            $GLOBALS['recover_msg'] = "Tài khoản và e-mail không trung khớp!";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
    }

    closeConnect($conn);
} else {
    $isRecoverPwd = false;
    $recover_msg = '';
}
/* ========== END: RECOVER PWD ========== */
?>

<?php
$bg = array('login_bg_01.jpg', 'login_bg_02.jpg', 'login_bg_03.jpg', 'login_bg_04.jpg', 'login_bg_05.jpg');

$i = rand(0, count($bg) - 1);
$selectedBg = "$bg[$i]";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ITT Team Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <style type="text/css">
            body{
                background: url('http://192.168.1.220:8080/RealEstate/admin/img/<?php echo $selectedBg; ?>');
            }
        </style>
    </head>
    <body>
        <div class="outer">
            <div class="middle">
                <div id="loginbox">            
                    <form class="form-vertical" id="login_form" name="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="control-group normal_text">
                            <h3><img src="http://192.168.1.220:8080/RealEstate/admin/img/logo.png" alt="Logo Admin" /></h3>
                        </div>
                        <div class="main_msg">
                            <span ><?php echo $msg; ?></span>
                        </div>
                        <div class="control-group" style="padding-top: 10px">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" id="username" name="username" placeholder="Nhập tài khoản" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" id="pwd" name="pwd" placeholder="Nhập mật khẩu" required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="remember_login">
                            <div class="">
                                <input type="checkbox" name="remember_login" id="remember_login">
                                <span id="remember_login_label">Ghi nhớ đăng nhập</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <span class="pull-left">
                                <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Quên mật khẩu?</a></span>
                            </span>
                            <span class="pull-right">
                                <input type="submit" class="btn btn-success" name="login" value="Đăng nhập" />
                            </span>
                        </div>
                    </form>

                    <!-- FORM RECOVER PWD -->
                    <form class="form-vertical" id="recover_form" name="recover_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <p class="normal_text">Điền tài khoản và e-mail để khôi phục mật khẩu.</p>
                        <div class="main_msg">
                            <span ><?php echo $recover_msg; ?></span>
                        </div>
                        <div class="control-group" style="padding-top: 10px">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" id="username" name="username" placeholder="Nhập tài khoản" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="main_input_box">
                                    <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input id="userEmail" name="userEmail" type="email" placeholder="Địa chỉ E-mail" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <span class="pull-left">
                                <a href="#" class="flip-link btn btn-success" id="to-login">
                                    <span class="icon"><i class="icon-arrow-left"></i></span> Trở lại Đăng nhập
                                </a>
                            </span>
                            <span class="pull-right">
                                <input type="submit" class="btn btn-info" name="recover-pwd" value="Khôi phục mật khẩu" />
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.min.js"></script>  
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap.min.js"></script> 
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/jquery.validate.js"></script> 
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.js"></script> 
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.login.js"></script> 
        <?php
        if ($isRecoverPwd) {
            echo '<script type="text/javascript">'
            . '$("#login_form").hide();'
            . '$("#recover_form").fadeIn();'
            . '</script>';
        }
        ?>
    </body>
</html>