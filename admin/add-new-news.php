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
$title = filter_input(INPUT_COOKIE, 'title');
$typeID = filter_input(INPUT_COOKIE, 'typeID');
$state = filter_input(INPUT_COOKIE, 'state');
$description = filter_input(INPUT_COOKIE, 'description');
$illustrationURL = filter_input(INPUT_COOKIE, 'illustrationURL');
$lineage = filter_input(INPUT_COOKIE, 'lineage');
$acreage = filter_input(INPUT_COOKIE, 'acreage');
$price = filter_input(INPUT_COOKIE, 'price');
$room = filter_input(INPUT_COOKIE, 'room');
if (!isset($room)) {
    $room = 0;
}
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/them-bai-dang-moi" class="current">
                        <i class="icon-plus-sign-alt"></i> Thêm bản tin mới
                    </a>
                </div>
                <h1>Thêm bài đăng mới</h1>
            </div>

            <div class="container-fluid">
                <hr>
                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/AddNews.php" method="post" id="form-add-news-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-list-ul"></i>
                                    </span>
                                    <h5>Thông tin cơ bản</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="control-group">
                                        <label class="control-label">Tiêu đề : </label>
                                        <div class="controls">
                                            <input type="text" id="title" class="span11" name="title" maxlength="255" value="<?php echo($title); ?>" placeholder="Nhập tiêu đề bài đăng" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hình thức gia dịch :</label>
                                        <div class="controls">
                                            <label> <input type="radio" value="0" id="isHire" name="isHire" checked />
                                                Bất động sản bán
                                            </label>
                                            <label> <input type="radio" value="1" id="isHire" name="isHire" <?php if ($isHire) echo 'checked'; ?>/>
                                                Bất động sản cho thuê
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Loại bất động sản : </label>
                                        <div class="controls">
                                            <select class="span11" name="typeID" id="typeID">
                                                <optgroup label="Căn hộ">
                                                    <option value="1">Căn hộ chung cư</option>
                                                    <option value="2">Nhà riêng</option>
                                                    <option value="3">Nhà mặt phố</option>
                                                    <option value="4">Tập thể</option>
                                                </optgroup>
                                                <optgroup label="Biệt thự">
                                                    <option value="5">Biệt thự cao cấp</option>
                                                    <option value="6">Biệt thự liền kề</option>
                                                </optgroup>
                                                <optgroup label="Dự án">
                                                    <option value="7">Khu nghỉ dưỡng</option>
                                                    <option value="8">Chung cư, khu đô thị</option> 
                                                    <option value="9">Trang trại</option>
                                                    <option value="10">Dự án khác</option>
                                                </optgroup>
                                                <optgroup label="Đất nền"> 
                                                    <option value="11">Đất nền dự án</option>
                                                    <option value="12">Bán đất</option>
                                                </optgroup>
                                                <option value="13" selected="">Loại khác</option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
                                        echo '  <div class="control-group">
                                                    <label class="control-label">Trạng thái bài đăng:</label>
                                                    <div class="controls">
                                                        <label> 
                                                           <input type="radio" value="0" id="state" name="state" checked/>
                                                           Chờ duyệt
                                                        </label>
                                                        <label>';
                                        if (isset($state) && $state == 1) {
                                            echo '          <input type="radio" value="1" id="state" name="state" checked />';
                                        } else {
                                            echo '          <input type="radio" value="1" id="state" name="state" />';
                                        }
                                        echo '
                                                            Được duyệt
                                                        </label>
                                                    </div>
                                                </div>';
                                    }
                                    ?>

                                    <div class="control-group">
                                        <label class="control-label">Mô tả chung : </label>
                                        <div class="controls">
                                            <span id="chars_left" class="chars_left">500</span>
                                            <textarea id="description" class="span11" name="description" rows="6"  maxlength="500" placeholder="Nhập mô tả chung..."><?php echo($description); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Hình ảnh minh hoạ : </label>
                                        <div class="controls">
                                            <div class="news-preview-img-container" id="news-preview-img-container" <?php if (isset($illustrationURL)) echo "style=\"background-image: url('$illustrationURL')\""; ?> >
                                            </div>
                                            <span class="help-block" id="img-message">Kích thước tối đa 5MB</span>
                                            <input id="illustrationURL" class="span11" name="illustrationURL" type="file" />
                                            <a id="imageClear" class="tip" data-original-title="Xóa ảnh"><i class="icon-remove"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="span6">
                            <div class="widget-box">
                                <div class="widget-title">
                                    <span class="icon">
                                        <i class="icon-list-ul"></i>
                                    </span>
                                    <h5>Thông tin vị trí</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <div class="control-group">
                                        <label class="control-label">Khu vực :</label>
                                        <div class="controls">
                                            <!--<input value="<?php echo($lineage); ?>" id="lineage" type="text" class="span11" name="lineage" placeholder="Nhập vị trí" />-->
                                            <select id="provinceID" name="provinceID" required="">
                                                <option value="0">--- Chọn thành phố/tỉnh ---</option>
                                            </select>
                                            <span id="provinceID_msg" class="help-block" style="display: none">Bạn cần chọn thành phố/tỉnh</span>
                                        </div>
                                        <div class="controls">
                                            <select class="form-control" id="districtID" name="districtID" required="">
                                                <option value="0">--- Chọn quận/huyện  ---</option>
                                            </select>
                                            <span id="districtID_msg" class="help-block" style="display: none">Bạn cần chọn quận/huyện</span>
                                        </div>
                                        <div class="controls">
                                            <select class="form-control" id="wardID" name="wardID">
                                                <option value="0">--- Chọn phường/xã ---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Diện tích :</label>
                                        <div class="controls">
                                            <label class="area-unit">
                                                <input type="radio" value="1" id="dien_tich" name="dien_tich" checked=""/> m<sup>2</sup>
                                            </label>
                                            <label class="area-unit">
                                                <input type="radio" value="2" id="dien_tich" name="dien_tich" value="2"/> ha</sup>
                                            </label>
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($acreage); ?>" type="number" id="acreage" class="span11" name="acreage" placeholder="Nhập diện tích">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"> Giá thành :</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input type="text" value="<?php echo($price); ?>" id="price" class="span11" name="price" placeholder="Nhập giá thành" >
                                                <span class="add-on">VNĐ</span>
                                            </div>
                                            <span id="price_msg" class="help-block" style="display: none">Giá là bội số của 1000</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Số phòng :</label>
                                        <div class="controls">
                                            <input value="<?php echo($room); ?>" type="number" id="room" class="span11" name="room" placeholder="Nhập số phòng">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hướng nhà:</label>
                                        <div class="controls">
                                            <select class="span11" id="direction" name="direction">
                                                <option value="0"> --- Liên hệ --- </option>
                                                <option value="1"> Đông </option>
                                                <option value="2"> Tây </option>
                                                <option value="3"> Nam  </option>
                                                <option value="4"> Bắc </option>
                                                <option value="5"> Đông Bắc </option>
                                                <option value="6"> Tây Bắc </option>
                                                <option value="7"> Đông Nam </option>
                                                <option value="8"> Tây Nam </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Thông tin liên hệ :</label>
                                        <div class="controls">
                                            <input value="<?php echo($contact_name); ?>" type="text" id="contact_name" class="span11" name="contact_name" placeholder="Họ và tên">
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($contact_phone); ?>" type="tel" id="contact_phone" class="span11" name="contact_phone" placeholder="Số điện thoại">
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($contact_mail); ?>" type="text" id="contact_mail" class="span11" name="contact_mail" placeholder="E-mail">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-list-ul"></i> </span>
                                <h5>Thông tin chi tiết</h5>
                            </div>
                            <div class="widget-content">
                                <div class="control-group">
                                    <div class="span12">
                                        <textarea id="detail" name="detail" class="textarea_editor span12 required" rows="20" placeholder="Nhập mô tả chi tiết ..."><?php echo($detail); ?></textarea>
                                        <span id="detail_msg" class="help-block" style="display: none">Bạn cần nhập nội dung chi tiết</span>
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
        </script>
        <!-- end-Highlight menu -->

        <script src="http://192.168.1.220:8080/RealEstate/admin/js/wysihtml5-0.3.0.js"></script> 
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap-wysihtml5.js"></script>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/news.form.validation.js"></script>
        <script>
            function setLocation() {
                
            };
            
            $(document).ready(function () {
                var maxLength = 500;
                $('.textarea_editor').wysihtml5();

                $('#description').bind('input propertychange', function () {
                    var length = $(this).val().length;
                    var length = maxLength - length;
                    $('#chars_left').text(length);
                });

                $('#imageClear').on('click', function () {
                    $('#news-preview-img-container').css({"backgroundImage": "url('<?php
        if (isset($illustrationURL)) {
            echo $illustrationURL;
        } else {
            echo 'http://192.168.1.220:8080/RealEstate/admin/img/illustration-no-image.png';
        }
        ?>'"});
                    $('#profile_picture').val('');
                    $('.filename').html('No file selected');
                });
            });
        </script>
    </body>
</html>