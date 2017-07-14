<script>
    $(function () {
        $('#search_type').change(function () {
            if ($(this).prop('checked')) {
                $('.advanced-search').show();
            } else {
                $('.advanced-search').hide();
            }
        })
    })
</script>
<?php
require_once ("data/truyvan.php");
$con = connect();
    $tinNoiBat=TinNoiBat($con);
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="float: right;">
    <div class="row">
        <div class="right_bar">
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Tìm kiếm</span></h2>

                <div class="singleleft_inner">
                    <form id="search_form" name="search_form" method="post" action="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=timkiem">
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['loai'])) {
                                $vt = $_SESSION['loai'];
                            }
                            ?>
                            <select class="form-control" id="select_adv_type" name="select_adv_type">
                                <option value="2" <?php if (strcmp($vt, "2") == 0) echo ("selected"); ?> >-- Chọn loại tin rao ---</option>
                                <option value="1"<?php if (strcmp($vt, "1") == 0) echo ("selected"); ?>>Nhà đất bán</option>
                                <option value="0"<?php if (strcmp($vt, "0") == 0) echo ("selected"); ?>>Nhà đất cho thuê</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['nha'])) {
                                $vt = $_SESSION['nha'];
                            }
                            ?>
                            <select class="form-control" id="select_adv_type" name="select_type">
                                <option value="0">--- Chọn loại nhà đất ---</option>
                                <optgroup label="Căn hộ">
                                    <option value="1"<?php if (strcmp($vt, "1") == 0) echo ("selected"); ?>>Căn hộ chung cư</option>
                                    <option value="2"<?php if (strcmp($vt, "2") == 0) echo ("selected"); ?>>Nhà riêng</option>
                                    <option value="3"<?php if (strcmp($vt, "3") == 0) echo ("selected"); ?>>Nhà mặt phố</option>
                                    <option value="4"<?php if (strcmp($vt, "4") == 0) echo ("selected"); ?>>Tập thể</option>
                                </optgroup>
                                <optgroup label="Biệt thự">
                                    <option value="5"<?php if (strcmp($vt, "5") == 0) echo ("selected"); ?>>Biệt thự cao cấp</option>
                                    <option value="6"<?php if (strcmp($vt, "6") == 0) echo ("selected"); ?>>Biệt thự liền kề</option>
                                </optgroup>
                                <optgroup label="Dự án">
                                    <option value="7"<?php if (strcmp($vt, "7") == 0) echo ("selected"); ?>>Khu nghỉ dưỡng</option>
                                    <option value="8"<?php if (strcmp($vt, "8") == 0) echo ("selected"); ?>>Chung cư, khu đô thị</option> 
                                    <option value="9"<?php if (strcmp($vt, "9") == 0) echo ("selected"); ?>>Trang trại</option>
                                    <option value="10"<?php if (strcmp($vt, "10") == 0) echo ("selected"); ?>>Dự án khác</option>
                                </optgroup>
                                <optgroup label="Đất nền"> 
                                    <option value="11"<?php if (strcmp($vt, "11") == 0) echo ("selected"); ?>>Đất nền dự án</option>
                                    <option value="12"<?php if (strcmp($vt, "12") == 0) echo ("selected"); ?>>Bán đất</option>
                                </optgroup>
                                <option value="13"<?php if (strcmp($vt, "13") == 0) echo ("selected"); ?>>Loại khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['thanhpho'])) {
                                $thanhpho = $_SESSION['thanhpho'];
                              }
                            ?>
                            <select class="form-control" id="select_province" name="select_province">
                                <option value="0">--- Chọn thành phố/tỉnh ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['huyen'])) {
                                $huyen = $_SESSION['huyen'];
                            }
                            ?>
                            <select class="form-control" id="select_district" name="select_district">
                                <option value="0">--- Chọn quận/huyện ---</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['phuongXa'])) {
                                $phuongXa = $_SESSION['phuongXa'];
                            }
                            ?>
                            <select class="form-control" id="select_ward" name="select_ward">
                                <option value="0">--- Chọn phường/xã ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['dientich'])) {
                                $vt = $_SESSION['dientich'];
                            }
                            ?>
                            <select class="form-control" id="select_acreage" name="select_acreage">
                                <option value="0"<?php if (strcmp($vt, "0") == 0) echo ("selected"); ?>>--- Chọn diện tích ---</option>
                                <option value="0-30"<?php if (strcmp($vt, "0-30") == 0) echo ("selected"); ?>>0m&sup2; - 30m&sup2;</option>
                                <option value="30-50"<?php if (strcmp($vt, "30-50") == 0) echo ("selected"); ?>>30m&sup2; - 50m&sup2;</option>
                                <option value="50-75"<?php if (strcmp($vt, "50-75") == 0) echo ("selected"); ?>>50m&sup2; - 75m&sup2;</option>
                                <option value="75-100"<?php if (strcmp($vt, "75-100") == 0) echo ("selected"); ?>>75m&sup2; - 100m&sup2;</option>
                                <option value="100-150"<?php if (strcmp($vt, "100-150") == 0) echo ("selected"); ?>>100m&sup2; - 150m&sup2;</option>
                                <option value="150-200"<?php if (strcmp($vt, "150-200") == 0) echo ("selected"); ?>>150m&sup2; - 200m&sup2;</option>
                                <option value="200-300"<?php if (strcmp($vt, "200-300") == 0) echo ("selected"); ?>>200m&sup2; - 300m&sup2;</option>
                                <option value="300-500"<?php if (strcmp($vt, "300-500") == 0) echo ("selected"); ?>>300m&sup2; - 500m&sup2;</option>
                                <option value="500-1000"<?php if (strcmp($vt, "500-1000") == 0) echo ("selected"); ?>>500m&sup2; - 1000m&sup2;</option>
                                <option value="1000-9999999"<?php if (strcmp($vt, "1000-9999999") == 0) echo ("selected"); ?>>&gt;= 1000&sup2;</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['gia'])) {
                                $vt = $_SESSION['gia'];
                            }
                            ?>
                            <select class="form-control" id="select_price" name="select_price">
                                <option value="0"<?php if (strcmp($vt, "0") == 0) echo ("selected"); ?>>--- Chọn mức giá ---</option>
                                <option value="0-0"<?php if (strcmp($vt, "0-0") == 0) echo ("selected"); ?>>Thỏa thuận</option>
                                <option value="0-500000000"<?php if (strcmp($vt, "0-500000000") == 0) echo ("selected"); ?>>0 - 500 triệu</option>
                                <option value="500000000-1000000000"<?php if (strcmp($vt, "500000000-1000000000") == 0) echo ("selected"); ?>>500 triệu - 1 tỷ</option>
                                <option value="1000000000-2000000000"<?php if (strcmp($vt, "1000000000-2000000000") == 0) echo ("selected"); ?>>1 tỷ - 2 tỷ</option>
                                <option value="2000000000-3000000000"<?php if (strcmp($vt, "2000000000-3000000000") == 0) echo ("selected"); ?>>2 tỷ - 3 tỷ</option>
                                <option value="3000000000-5000000000"<?php if (strcmp($vt, "3000000000-5000000000") == 0) echo ("selected"); ?>>3 tỷ - 5 tỷ</option>
                                <option value="5000000000-7000000000"<?php if (strcmp($vt, "5000000000-7000000000") == 0) echo ("selected"); ?>>5 tỷ - 7 tỷ</option>
                                <option value="7000000000-10000000000"<?php if (strcmp($vt, "7000000000-10000000000") == 0) echo ("selected"); ?>>7 tỷ - 10 tỷ</option>
                                <option value="10000000000-20000000000"<?php if (strcmp($vt, "10000000000-20000000000") == 0) echo ("selected"); ?>>10 tỷ - 20 tỷ</option>
                                <option value="20000000000-100000000000"<?php if (strcmp($vt, "20000000000-100000000000") == 0) echo ("selected"); ?>>&gt;= 20 tỷ</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['phong'])) {
                                $vt = $_SESSION['phong'];
                            }
                            ?>
                            <select class="form-control" id="select_rooms" name="select_rooms">
                                <option value="0"<?php if (strcmp($vt, "0") == 0) echo ("selected"); ?>>--- Chọn số phòng ---</option>
                                <option value="1"<?php if (strcmp($vt, "1") == 0) echo ("selected"); ?>>1+</option>
                                <option value="2"<?php if (strcmp($vt, "2") == 0) echo ("selected"); ?>>2+</option>
                                <option value="3"<?php if (strcmp($vt, "3") == 0) echo ("selected"); ?>>3+</option>
                                <option value="4"<?php if (strcmp($vt, "4") == 0) echo ("selected"); ?>>4+</option>
                                <option value="5"<?php if (strcmp($vt, "5") == 0) echo ("selected"); ?>>5+</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <?php
                            $vt = "";
                            if (isset($_SESSION['huong'])) {
                                $vt = $_SESSION['huong'];
                            }
                            ?>
                            <select class="form-control" id="select_direction" name="select_direction">
                                <option value="0"<?php if (strcmp($vt, "0") == 0) echo ("selected"); ?>>--- Chọn hướng nhà ---</option>
                                <option value="1"<?php if (strcmp($vt, "1") == 0) echo ("selected"); ?>>Đông</option>
                                <option value="2"<?php if (strcmp($vt, "2") == 0) echo ("selected"); ?>>Tây</option>
                                <option value="3"<?php if (strcmp($vt, "3") == 0) echo ("selected"); ?>>Nam</option>
                                <option value="4"<?php if (strcmp($vt, "4") == 0) echo ("selected"); ?>>Bắc</option>
                                <option value="5"<?php if (strcmp($vt, "5") == 0) echo ("selected"); ?>>Đông-Bắc</option>
                                <option value="6"<?php if (strcmp($vt, "6") == 0) echo ("selected"); ?>>Tây-Bắc</option>
                                <option value="7"<?php if (strcmp($vt, "7") == 0) echo ("selected"); ?>>Đông-Nam</option>
                                <option value="8"<?php if (strcmp($vt, "8") == 0) echo ("selected"); ?>>Tây-Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="search_type" type="checkbox" data-toggle="toggle" data-off="Cơ bản" data-on="Nâng cao">
                            <button type="submit" id="filter_news" name="submit" class="btn btn-primary" style="float: right;">
                                <span class="glyphicon glyphicon-search"></span> Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>   <!--tim kiem-->
           <div class="single_leftbar wow fadeInDown">
                <h2><span>Tin phổ biến</span></h2>
                <div class="singleleft_inner">
                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                        
                        <?php
                        foreach ($tinNoiBat as $a){
                        ?>
                        <li>
                            <div class="media">
                                <a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>" class="media-left"><img alt="" src="<?php echo ($a['IllustrationURL']); ?>"></a>
                                <div class="media-body">
                                    <a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>" class="catg_title"><?php echo ($a['Title']); ?> </a>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </div>
            </div> <!--tin noi bat-->

            <div class="single_leftbar wow fadeInDown">
                <h2><span>Quảng cáo</span></h2>
                <div class="singleleft_inner"> <a href="#"><img alt="" src="http://192.168.1.220:8080/RealEstate/images/lienhe.gif"></a></div>
            </div>

            
            
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Chủ đề được quan tâm</span></h2>
                <div class="singleleft_inner">
                    <ul class="label_nav">
                        <li><a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=datnen">Thị trường đất nền</a></li>
                      
                        <li><a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=duanmoi">Công trình, dự án mới</a></li>
                        <li><a href="#">Căn hộ 25m2</a></li>
                       
                        
                       
                    </ul>
                </div>
            </div>
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Trang liên kết</span></h2>
                <div class="singleleft_inner">
                    <ul class="link_nav">
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="https://www.facebook.com/chymchyck.bong">Facebook: Ngọc Như Ý </a></li>
                        <li><a href="#">https://lien_ket.com.vn</a></li>
                        <li><a href="#">https://lien_ket.com.vn</a></li>
                        <li><a href="#">https://lien_ket.com.vn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $lstProvinces = [];
    $lstDistricts = [];
    $lsrWards = [];
   

    //alert("Minh " + thanhPho);
    $.getJSON("http://192.168.1.220:8080/RealEstate/Location.json", function (data) {
        $.each(data, function (key, province) {
            $lstProvinces[province.locationID] = province;
            $("#select_province").append('<option value="' + province.locationID + '">' + province.locationName + '</option>');
        });
    });
    $('#select_province').on('change', function () {
        $("#select_district").html('<option value="0">--- Chọn quận/huyện ---</option>');
        if ($lstProvinces[this.value]) {
            $data = $lstProvinces[this.value].lstSubLocation;
            if ($data) {
                $.each($data, function (key, district) {
                    $lstDistricts[district.locationID] = district;
                    $("#select_district").append('<option value="' + district.locationID + '">' + district.locationName + '</option>');
                });
            }
        }
    });
    $('#select_district').on('change', function () {
        $("#select_ward").html('<option value="0">--- Chọn phường/xã ---</option>');
        if ($lstDistricts[this.value]) {
            $data = $lstDistricts[this.value].lstSubLocation;
            if ($data) {
                $.each($data, function (key, ward) {
                    $lsrWards[ward.locationID] = ward;
                    $("#select_ward").append('<option value="' + ward.locationID + '">' + ward.locationName + '</option>');
                });
            }
        }
    });
</script>