<?php
// ========== start - CHECK LOGIN AND ROLE ==========
require_once('./util/Constant.php');
require ('./include/check-role.php');
checkRole(Constants::UPDATE_NEWS);
// ========== end - CHECK LOGIN AND ROLE ==========
// ========== start - GET LIST TYPE ==========
require_once("./util/AccessDatabase.php");
require_once("./util/Type.php");
require_once("./controller/GetType.php");
$lstType = getAllType();
// ========== end - GET LIST TYPE ==========

/* ========== GET NEWS FROM DB ========== */
require_once("util/News.php");
require_once("controller/GetNews.php");


if (isset($_GET['newsID'])) {
    $newsID = $_GET['newsID'];
    $news = getNewsByID($newsID);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Cập nhật bài đăng</title>
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
                        <a href="http://192.168.1.220:8080/RealEstate/admin/news-detail.php" class="current">
                            <i class="icon-user"></i> Cập nhật bài đăng
                        </a>
                    </div>
                    <h1>Cập nhật bài đăng</h1>
                </div>


                <div class="container-fluid">

                    <hr>

                    <form action="http://192.168.1.220:8080/RealEstate/admin/controller/UpdateNews.php" method="post" id="form-wizard-validate" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <span class="icon">
                                            <i class="icon-align-justify"></i>
                                        </span>
                                        <h5>Thông tin bài đăng</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <div class="control-group">
                                            <label class="control-label">Tiêu đề bài đăng :</label>
                                            <div class="controls">
                                                <input value="<?php echo($news->getTitle()); ?>" id="tittle" class="span11" name="tittle" placeholder="Nhập tiêu đề bài đăng" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Loại bài đăng:</label>
                                            <div class="controls">

                                                <select class="span11" name="typeID" id="typeID" >
                                                    <option value="<?php echo $news->getNewsTypeID() ?>"><?php echo getTypeByID($news->getNewsTypeID())->getTypeName() ?></option>
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
                                                    <option value="<?php echo $news->getState() ?>"> <?php
                                                        if ($news->getState() == 0)
                                                            echo "Pendding";
                                                        else {
                                                            if ($news->getState() == 1)
                                                                echo "Enable";
                                                            else
                                                                echo 'Disable';
                                                        }
                                                        ?> </option>
                                                    <option value="0"> Pendding </option>
                                                    <option value="1"> Enable </option>
                                                    <option value="2"> Disable  </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Mô tả:</label>
                                            <div class="controls">
                                                <textarea value="<?php echo($news->getDescription()); ?>" id="description" class="span11" name="description" rows="6" placeholder="Nhập mô tả ..."></textarea>
                                            </div>

                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Hình ảnh minh hoạ: </label>
                                            <img src="<?php echo($news->getIllustrationURL()); ?>" height="50" width="50">
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
                                        <h5>Thông tin bài đăng</h5>
                                    </div>
                                    <div class="widget-content nopadding">
                                        <div class="control-group">
                                            <label class="control-label">Vị trí :</label>
                                            <div class="controls">
                                                <input value="<?php echo($news->getLineage()); ?>" id="lineage" type="text" class="span11" name="lineage" placeholder="Nhập vị trí" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Diện tích :</label>
                                            <div class="controls">
                                                <input value="<?php echo($news->getAcreage()); ?>" type="text" id="acreage" class="span11" name="acreage" placeholder="Nhập diện tích">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"> Giá thành :</label>
                                            <div class="controls">
                                                <input value="<?php echo($news->getPrice()); ?>" type="text" id="price" class="span11" name="price" placeholder="Nhập giá thành" >
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Số phòng :</label>
                                            <div class="controls">
                                                <input value="<?php echo($news->getRoom()); ?>" type="text" id="room" class="span11" name="room" placeholder="Nhập số phòng">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Hướng nhà:</label>
                                            <div class="controls">

                                                <select class="span11" id="direction" name="direction">
                                                    <option value="<?php echo $news->getDirection() ?>"> <?php
                                                        if ($news->getDirection() == 1)
                                                            echo "Đông";
                                                        if ($news->getDirection() == 2)
                                                            echo "Tây";
                                                        if ($news->getDirection() == 3)
                                                            echo "Nam ";
                                                        if ($news->getDirection() == 4)
                                                            echo "Bắc ";
                                                        if ($news->getDirection() == 5)
                                                            echo "Đông bắc ";
                                                        if ($news->getDirection() == 6)
                                                            echo "Đông nam ";
                                                        if ($news->getDirection() == 7)
                                                            echo "Tây bắc ";
                                                        if ($news->getDirection() == 8)
                                                            echo "Tây nam ";
                                                        ?> </option>
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
                                                    <option value="<?php echo $news->getDirection() ?>"> <?php
                                                        if ($news->getDirection() == 1)
                                                            echo "Cho thuê";
                                                        if ($news->getDirection() == 2)
                                                            echo "Bán ";
                                                        ?> </option>
                                                    <option value="1"> Cho thuê </option>
                                                    <option value="2"> Bán </option>
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

                                        <div class="controls">
                                            <input type="hidden" name="newsID" value="<?php echo $newsID ?>">
                                        
                                            <textarea value="<?php echo($news->getDetail()); ?>" id="detail" name="detail" class="textarea_editor span12" rows="16" placeholder="Nhập mô tả chi tiết ..."></textarea>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" name="update-news" style="float: right;">CẬP NHẬT BÀI ĐĂNG</button>
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

    <?php
}
?>