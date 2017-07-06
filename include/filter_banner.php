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

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="float: right;">
    <div class="row">
        <div class="right_bar">
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Tìm kiếm</span></h2>

                <div class="singleleft_inner">
                    <form id="search_form" name="search_form" method="post" action="#">
                        <div class="form-group">
                            <select class="form-control" id="select_adv_type" name="select_adv_type">
                                <option value="0">-- Chọn loại tin rao ---</option>
                                <option value="1">Nhà đất bán</option>
                                <option value="2">Nhà đất cho thuê</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="select_adv_type" name="select_adv_type">
                                <option>--- Chọn loại nhà đất ---</option>
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
                                <option value="13">Loại khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="select_province" name="select_province">
                                <option value="0">--- Chọn thành phố/tỉnh ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="select_district" name="select_district">
                                <option value="0">--- Chọn quận/huyện ---</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="select_ward" name="select_ward">
                                <option value="0">--- Chọn phường/xã ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="select_acreage" name="select_acreage">
                                <option value="0">--- Chọn diện tích ---</option>
                                <option value="30">0m&sup2; - 30m&sup2;</option>
                                <option value="50">30m&sup2; - 50m&sup2;</option>
                                <option value="75">50m&sup2; - 75m&sup2;</option>
                                <option value="100">75m&sup2; - 100m&sup2;</option>
                                <option value="150">100m&sup2; - 150m&sup2;</option>
                                <option value="200">150m&sup2; - 200m&sup2;</option>
                                <option value="300">200m&sup2; - 300m&sup2;</option>
                                <option value="500">300m&sup2; - 500m&sup2;</option>
                                <option value="1000">500m&sup2; - 1000m&sup2;</option>
                                <option value="9999999">&gt;= 1000&sup2;</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="select_price" name="select_price">
                                <option value="0">--- Chọn mức giá ---</option>
                                <option value="1">Thỏa thuận</option>
                                <option value="5">0 - 500 triệu</option>
                                <option value="10">500 triệu - 1 tỷ</option>
                                <option value="20">1 tỷ - 2 tỷ</option>
                                <option value="30">2 tỷ - 3 tỷ</option>
                                <option value="50">3 tỷ - 5 tỷ</option>
                                <option value="70">5 tỷ - 7 tỷ</option>
                                <option value="100">7 tỷ - 10 tỷ</option>
                                <option value="200">10 tỷ - 20 tỷ</option>
                                <option value="9999999">&gt;= 20 tỷ</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="select_rooms" name="select_rooms">
                                <option value="0">--- Chọn số phòng ---</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="select_direction" name="select_direction">
                                <option value="0">--- Chọn hướng nhà ---</option>
                                <option value="1">Đông</option>
                                <option value="2">Tây</option>
                                <option value="3">Nam</option>
                                <option value="4">Bắc</option>
                                <option value="5">Đông-Bắc</option>
                                <option value="6">Tây-Bắc</option>
                                <option value="7">Đông-Nam</option>
                                <option value="8">Tây-Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="search_type" type="checkbox" data-toggle="toggle" data-off="Cơ bản" data-on="Nâng cao">
                            <button type="submit" id="filter_news" name="filter_news" class="btn btn-primary" style="float: right;">
                                <span class="glyphicon glyphicon-search"></span> Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="single_leftbar wow fadeInDown">
                <h2><span>Quảng cáo</span></h2>
                <div class="singleleft_inner"> <a href="#"><img alt="" src="http://192.168.1.220:8080/RealEstate/images/lienhe.gif"></a></div>
            </div>

            <div class="single_leftbar wow fadeInDown">
                <h2><span>Chủ đề được quan tâm</span></h2>
                <div class="singleleft_inner">
                    <ul class="label_nav">
                        <li><a href="#">Thị trường nhà đất Đông Anh</a></li>
                        <li><a href="#">Căn hộ 25m2</a></li>
                        <li><a href="#">Căn hộ Officetel</a></li>
                        <li><a href="#">Thị trường đất nền</a></li>
                        <li><a href="#">Sốt đất Tp.HCM năm 2017</a></li>
                        <li><a href="#">Công trình, dự án mới</a></li>
                        <li><a href="#">Bất động sản Tp.HCM</a></li>
                    </ul>
                </div>
            </div>
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Trang liên kết</span></h2>
                <div class="singleleft_inner">
                    <ul class="link_nav">
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Trang Facebook</a></li>
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
