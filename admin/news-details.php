<?php
try {
    if (!file_exists((__DIR__) . '/util/Constant.php')) {
        throw new Exception ();
    }
    if (!file_exists((__DIR__) . '/include/check-role.php')) {
        throw new Exception ();
    }
    if (!file_exists((__DIR__) . '/util/News.php')) {
        throw new Exception ();
    }
    if (!file_exists((__DIR__) . '/util/Utils.php')) {
        throw new Exception ();
    }
    if (!file_exists((__DIR__) . '/controller/dao/NewsDAO.php')) {
        throw new Exception ();
    }
} catch (Exception $ex) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/404-file-not-found");
    exit();
}
// ========== start - CHECK LOGIN AND ROLE ==========
require_once (__DIR__) . '/util/Constant.php';
require (__DIR__) . '/include/check-role.php';
checkRole(Constants::UPDATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========

/* ========== GET NEWS FROM DB ========== */
require_once (__DIR__) . '/util/News.php';
require_once (__DIR__) . '/util/Utils.php';
require_once (__DIR__) . '/controller/dao/NewsDAO.php';

if (isset($_GET['newsID'])) {
    $newsID = $_GET['newsID'];
    $news = getNewsByID($newsID);

    if (!class_exists('Utils')) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
        exit();
    }
    $input_title = filter_input(INPUT_GET, 'title');
    if ((new Utils ())->makeURL($news->getTitle()) != $input_title) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/page-not-found");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cập nhật bài đăng</title>
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
                    <a href="http://192.168.1.220:8080/RealEstate/admin/news-detail.php" class="current">
                        <i class="icon-file-alt"></i> Cập nhật bài đăng
                    </a>
                </div>
                <h1>Cập nhật bài đăng</h1>
            </div>


            <div class="container-fluid">
                <hr>
                <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateNews.php" method="post" id="form-add-news-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
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
                                        <label class="control-label">Tiêu đề bài đăng :</label>
                                        <div class="controls">
                                            <input type="text" id="title" class="span11" name="title" maxlength="255" value="<?php echo($news->getTitle()); ?>" placeholder="Nhập tiêu đề bài đăng" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hình thức gia dịch :</label>
                                        <div class="controls">
                                            <label> <input type="radio" value="0" id="isHire" name="isHire" checked />
                                                Bất động sản bán
                                            </label>
                                            <label> <input type="radio" value="1" id="isHire" name="isHire" <?php echo ($news->getIsHire()) ? 'checked' : ''; ?>/>
                                                Bất động sản cho thuê
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Loại bất động sản : </label>
                                        <div class="controls">
                                            <select class="span11" name="typeID" id="typeID">
                                                <optgroup label="Căn hộ">
                                                    <option value="1" <?php echo($news->getNewsTypeID() == 1) ? 'selected' : ''; ?>>Căn hộ chung cư</option>
                                                    <option value="2" <?php echo($news->getNewsTypeID() == 2) ? 'selected' : ''; ?>>Nhà riêng</option>
                                                    <option value="3" <?php echo($news->getNewsTypeID() == 3) ? 'selected' : ''; ?>>Nhà mặt phố</option>
                                                    <option value="4" <?php echo($news->getNewsTypeID() == 4) ? 'selected' : ''; ?>>Tập thể</option>
                                                </optgroup>
                                                <optgroup label="Biệt thự">
                                                    <option value="5" <?php echo($news->getNewsTypeID() == 5) ? 'selected' : ''; ?>>Biệt thự cao cấp</option>
                                                    <option value="6" <?php echo($news->getNewsTypeID() == 6) ? 'selected' : ''; ?>>Biệt thự liền kề</option>
                                                </optgroup>
                                                <optgroup label="Dự án">
                                                    <option value="7" <?php echo($news->getNewsTypeID() == 7) ? 'selected' : ''; ?>>Khu nghỉ dưỡng</option>
                                                    <option value="8" <?php echo($news->getNewsTypeID() == 8) ? 'selected' : ''; ?>>Chung cư, khu đô thị</option> 
                                                    <option value="9" <?php echo($news->getNewsTypeID() == 9) ? 'selected' : ''; ?>>Trang trại</option>
                                                    <option value="10" <?php echo($news->getNewsTypeID() == 10) ? 'selected' : ''; ?>>Dự án khác</option>
                                                </optgroup>
                                                <optgroup label="Đất nền"> 
                                                    <option value="11" <?php echo($news->getNewsTypeID() == 11) ? 'selected' : ''; ?>>Đất nền dự án</option>
                                                    <option value="12" <?php echo($news->getNewsTypeID() == 12) ? 'selected' : ''; ?>>Bán đất</option>
                                                </optgroup>
                                                <option value="13" <?php echo($news->getNewsTypeID() == 13) ? 'selected' : ''; ?>>Loại khác</option>
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
                                        if ($news->getState() == 1) {
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
                                            <textarea id="description" class="span11" name="description" rows="6"  maxlength="500" placeholder="Nhập mô tả chung..."><?php echo($news->getDescription()); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Hình ảnh minh hoạ : </label>
                                        <div class="controls">
                                            <div class="news-preview-img-container" id="news-preview-img-container" <?php if ($news->getIllustrationURL() != '') echo "style=\"background-image: url('" . $news->getIllustrationURL() . "')\""; ?> >
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
                                            <input value="<?php echo($news->getAcreage()); ?>" type="number" id="acreage" class="span11" name="acreage" placeholder="Nhập diện tích">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"> Giá thành :</label>
                                        <div class="controls">
                                            <div class="input-append">
                                                <input value="<?php echo($news->getPrice()); ?>" type="text" id="price" class="span11" name="price" maxlength="18" placeholder="Nhập giá thành" >
                                                <span class="add-on">VNĐ</span>
                                            </div>
                                            <span id="price_msg" class="help-block" style="display: none">Giá là bội số của 1000</span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Số phòng :</label>
                                        <div class="controls">
                                            <input value="<?php echo($news->getRoom()); ?>" type="number" id="room" class="span11" name="room" placeholder="Nhập số phòng">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Hướng nhà :</label>
                                        <div class="controls">
                                            <select class="span11" id="direction" name="direction">
                                                <option value="0" <?php echo($news->getDirection() == 0) ? 'selected' : ''; ?>> --- Liên hệ --- </option>
                                                <option value="1" <?php echo($news->getDirection() == 1) ? 'selected' : ''; ?>> Đông </option>
                                                <option value="2" <?php echo($news->getDirection() == 3) ? 'selected' : ''; ?>> Tây </option>
                                                <option value="3" <?php echo($news->getDirection() == 3) ? 'selected' : ''; ?>> Nam  </option>
                                                <option value="4" <?php echo($news->getDirection() == 4) ? 'selected' : ''; ?>> Bắc </option>
                                                <option value="5" <?php echo($news->getDirection() == 5) ? 'selected' : ''; ?>> Đông Bắc </option>
                                                <option value="6" <?php echo($news->getDirection() == 6) ? 'selected' : ''; ?>> Tây Bắc </option>
                                                <option value="7" <?php echo($news->getDirection() == 7) ? 'selected' : ''; ?>> Đông Nam </option>
                                                <option value="8" <?php echo($news->getDirection() == 8) ? 'selected' : ''; ?>> Tây Nam </option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                    $objContact = json_decode($news->getContact());
                                    $contact_name = $objContact->{'owner_name'};
                                    $contact_phone = $objContact->{'phone_number'};
                                    if (isset($objContact->{'email'})) {
                                        $contact_mail = $objContact->{'email'};
                                    } else {
                                        $contact_mail = '';
                                    }
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label">Thông tin liên hệ :</label>
                                        <div class="controls">
                                            <input value="<?php echo($contact_name); ?>" type="text" id="contact_name" class="span11" name="contact_name" placeholder="Họ và tên">
                                        </div>
                                        <div class="controls">
                                            <input value="<?php echo($contact_phone); ?>" type="text" id="contact_phone" class="span11" name="contact_phone" placeholder="Số điện thoại">
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
                                        <textarea id="detail" name="detail" class="textarea_editor span12 required" rows="20" placeholder="Nhập mô tả chi tiết ..."><?php echo($news->getDetail()); ?></textarea>
                                        <span id="detail_msg" class="help-block" style="display: none">Bạn cần nhập nội dung chi tiết</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="hidden" value="<?php echo $newsID; ?>" name="newsID" id="newsID" >
                        <button type="submit" class="btn btn-success" name="update-news" style="float: right;">CẬP NHẬT BÀI ĐĂNG</button>
                    </div>
                </form>

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
                var maxLength = 500;
                $('.textarea_editor').wysihtml5();

                $('#description').bind('input propertychange', function () {
                    var length = $(this).val().length;
                    var length = maxLength - length;
                    $('#chars_left').text(length);
                });
                var length = $('#description').val().length;
                var length = maxLength - length;
                $('#chars_left').text(length);

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
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/wysihtml5-0.3.0.js"></script> 
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/bootstrap-wysihtml5.js"></script>
        <script src="http://192.168.1.220:8080/RealEstate/admin/js/news.form.validation.js"></script>

        <!-- SETUP SELECTED LOCATION -->
        <script type="text/javascript">
            function setLocation() {
                $provinceID = 0;
                $districtID = 0;
                $wardID = 0;
<?php
if ($news->getLineage() != '') {
    $fullLocation = $news->getLineage();
    $locations = explode("/", $fullLocation);
    echo '$provinceID = ' . $locations[2] . ";\n";
    echo '$districtID = ' . $locations[3] . ";\n";
    if (isset($locations[4]) && $locations[4] > 0) {
        echo '$wardID = ' . $locations[4] . ";\n";
    }
}
?>
                // Setup province
                $provinceName = $("#provinceID [value='" + $provinceID + "']").text();
                $('#s2id_provinceID span:eq(0)').text($provinceName);
                $('#provinceID').val($provinceID);


                // Setup district 
                $("#districtID").html('<option value="0">--- Chọn quận/huyện ---</option>');
                if ($lstProvinces[$provinceID]) {
                    $data = $lstProvinces[$provinceID].lstSubLocation;
                    if ($data) {
                        $.each($data, function (key, district) {
                            $lstDistricts[district.locationID] = district;
                            $("#districtID").append('<option value="' + district.locationID + '">' + district.locationName + '</option>');
                        });
                    }
                }
                $districtName = $("#districtID [value='" + $districtID + "']").text();
                $('#s2id_districtID span:eq(0)').text($districtName);
                $('#districtID').val($districtID);

                // Setup ward
                $("#wardID").html('<option value="0">--- Chọn phường/xã ---</option>');
                if ($lstDistricts[$districtID]) {
                    $data = $lstDistricts[$districtID].lstSubLocation;
                    if ($data) {
                        $.each($data, function (key, ward) {
                            $lsrWards[ward.locationID] = ward;
                            $("#wardID").append('<option value="' + ward.locationID + '">' + ward.locationName + '</option>');
                        });
                    }
                }
                $wardName = $("#wardID [value='" + $wardID + "']").text();
                $('#s2id_wardID span:eq(0)').text($wardName);
                $('#wardID').val($wardID);
            }
        </script>
    </body>
</html>
