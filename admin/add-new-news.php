<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once('./util/Constant.php');
require ('./include/check-role.php');
checkRole(Constants::CREATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========
// ========== start - GET LIST TYPE ==========
require_once("./util/AccessDatabase.php");
require_once("./util/Type.php");
require_once("./controller/GetType.php");
$lstType = getAllType();
// ========== end - GET LIST TYPE ==========
// DEFINE NEWS PROPERTY
$tittle = filter_input(INPUT_COOKIE, 'tittle');
$typeID = filter_input(INPUT_COOKIE, 'typeID');
$state = filter_input(INPUT_COOKIE, 'state');
$description = filter_input(INPUT_COOKIE, 'description');
$illustrationURL = filter_input(INPUT_COOKIE, 'illustrationURL');
$lineage = filter_input(INPUT_COOKIE, 'lineage');
$acreage = filter_input(INPUT_COOKIE, 'acreage');
$price = filter_input(INPUT_COOKIE, 'price');
$room = filter_input(INPUT_COOKIE, 'room');
$direction = filter_input(INPUT_COOKIE, 'direction');
$isHire = filter_input(INPUT_COOKIE, 'isHire');
$detail = filter_input(INPUT_COOKIE, 'detail');
$contact = "{";
$contact .= '"owner_name" : "' . filter_input(INPUT_COOKIE, 'contact_name') . '",';
$contact .= '"phone_number" : "' . filter_input(INPUT_COOKIE, 'contact_phone') . '",';
$contact .= '"email" : "' . filter_input(INPUT_COOKIE, 'contact_mail') . '"';
$contact .= "}";
$contact_name = '';
$contact_phone = '';
$contact_mail = '';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm bài đăng mới</title>
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/add-new-news.php" class="current">
                        <i class="icon-user"></i> Thêm bài đăng mới
                    </a>
                </div>
                <h1>Thêm bài đăng mới</h1>
            </div>


            <div class="container-fluid">

                <hr>

                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/AddNews.php" method="post" id="form-wizard-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">

                    <div class="row-fluid">
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-align-justify"></i>
                                    </span>
                                    <h5>Thông tin bài đăng mới</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="control-group">
                                        <label class="control-label">Tiêu đề bài đăng :</label>
                                        <div class="controls">
                                            <input value="<?php echo($tittle); ?>" id="tittle" class="span11" name="tittle" placeholder="Nhập tiêu đề bài đăng" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Loại bài đăng:</label>
                                        <div class="controls">

                                            <select class="span11" name="typeID" id="typeID" >
<?php
foreach ($lstType as $type) {
    ?>
                                                    <option value="<?php echo $type->getTypeID() ?>"><?php echo $type->getTypeName() ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Trạng thái bài đăng:</label>
                                        <div class="controls">

                                            <select class="span11" id="state" name="state">
                                                <option value="0"> Pendding </option>
                                                <option value="1"> Enable </option>
                                                <option value="2"> Disable  </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label">Mô tả:</label>
                                        <div class="controls">
                                            <textarea value="<?php echo($description); ?>" id="description" class="span11" name="description" rows="6" placeholder="Nhập mô tả ..."></textarea>
                                        </div>

                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Hình ảnh minh hoạ: </label>
                                        <div class="controls">
                                            <span class="help-block" id="img-message">Kích thước tối đa 5MB</span>
                                            <input id="illustrationURL" class="span11" name="illustrationURL" type="file" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-align-justify"></i>
                                    </span>
                                    <h5>Thông tin bài đăng mới</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="control-group">
                                        <label class="control-label">Vị trí :</label>
                                        <div class="controls">
                                            <input value="<?php echo($lineage); ?>" id="lineage" type="text" class="span11" name="lineage" placeholder="Nhập vị trí" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Diện tích :</label>
                                        <div class="controls">
                                            <input value="<?php echo($acreage); ?>" type="text" id="acreage" class="span11" name="acreage" placeholder="Nhập diện tích">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"> Giá thành :</label>
                                        <div class="controls">
                                            <input value="<?php echo($price); ?>" type="text" id="price" class="span11" name="price" placeholder="Nhập giá thành" >
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Số phòng :</label>
                                        <div class="controls">
                                            <input value="<?php echo($room); ?>" type="text" id="room" class="span11" name="room" placeholder="Nhập số phòng">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hướng nhà:</label>
                                        <div class="controls">

                                            <select class="span11" id="direction" name="direction">

                                                <option value="1"> Đông </option>
                                                <option value="2"> Tây </option>
                                                <option value="3">Nam  </option>
                                                <option value="4"> Bắc </option>
                                                <option value="5"> Đông Bắc </option>
                                                <option value="6"> Đông Nam </option>
                                                <option value="7"> Tây Bắc </option>
                                                <option value="8"> Tây Nam </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Hình thức giao dịch:</label>
                                        <div class="controls">

                                            <select class="span11" id="isHire" name="isHire">

                                                <option value="1"> Cho thuê </option>
                                                <option value="2"> Bán </option>
                                            </select>
                                        </div>
                                    </div>  

                                    <div class="control-group">
                                        <label class="control-label">Liên hệ :</label>
                                        <div class="controls">
                                            <input value="<?php echo($contact_name); ?>" type="text" id="contact_name" class="span11" name="contact_name" placeholder="Nhập liên hệ">
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($contact_phone); ?>" type="text" id="contact_phone" class="span11" name="contact_phone" placeholder="Nhập liên hệ">
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($contact_mail); ?>" type="text" id="contact_mail" class="span11" name="contact_mail" placeholder="Nhập liên hệ">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row-fluid">

                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                                <h5>Nội dung chi tiết bài đăng</h5>
                            </div>
                            <div class="widget-content">
                                <div class="control-group">

                                    <div class="span12">
                                        <textarea value="<?php echo($detail); ?>" id="detail" name="detail" class="textarea_editor span12" rows="16" placeholder="Nhập mô tả chi tiết ..."></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success" name="new-news" style="float: right;">THÊM BÀI ĐĂNG</button>
                    </div>
                </form>

            </div>
        </div>

<?php include("include/footer.php"); ?>

        <script src="http://192.168.1.220:8080/RealEstate/admin/js/matrix.wizard.js"></script>
        <!-- Highlight menu -->
        <script type="text/javascript">
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
        <script src="js/jquery.min.js"></script> 
        <script src="js/jquery.ui.custom.js"></script> 
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/bootstrap-colorpicker.js"></script> 
        <script src="js/bootstrap-datepicker.js"></script> 
        <script src="js/jquery.toggle.buttons.js"></script> 
        <script src="js/masked.js"></script> 
        <script src="js/jquery.uniform.js"></script> 
        <script src="js/select2.min.js"></script> 
        <script src="js/matrix.js"></script> 
        <script src="js/matrix.form_common.js"></script> 
        <script src="js/wysihtml5-0.3.0.js"></script> 
        <script src="js/jquery.peity.min.js"></script> 
        <script src="js/bootstrap-wysihtml5.js"></script> 
        <script>
            $('.textarea_editor').wysihtml5();
        </script>
        <!-- end-Highlight menu -->
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/add-user.form_validation.js"></script>
    </body>
</html>