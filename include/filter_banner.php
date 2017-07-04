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
                            <select class="form-control" id="sel1">
                                <option>-- Chọn loại tin rao ---</option>
                                <option>Nhà đất bán</option>
                                <option>Nhà đất cho thuê</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="sel1">
                                <option>--- Chọn loại nhà đất ---</option>
                                <optgroup label="Căn hộ">
                                    <option value="">Căn hộ chung cư</option>
                                    <option value="">Nhà riêng</option>
                                    <option value="">Nhà mặt phố</option>
                                    <option value="">Tập thể</option>
                                </optgroup>
                                <optgroup label="Biệt thự">
                                    <option>Biệt thự cao cấp</option>
                                    <option>Biệt thự liền kề</option>
                                </optgroup>
                                <optgroup label="Dự án">
                                    <option>Khu nghỉ dưỡng</option>
                                    <option>Chung cư, khu đô thị</option> 
                                    <option>Trang trại</option>
                                    <option>Dự án khác</option>
                                </optgroup>
                                <optgroup label="Đất nền"> 
                                    <option>Đất nền dự án</option>
                                    <option>Bán đất</option>
                                </optgroup>
                                <option>Loại khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="sel1">
                                <option>--- Chọn tỉnh/thành phố ---</option>
                                <option>Hà Nội</option>
                                <option>Hồ Chí Minh</option>
                                <option>Đà Nẵng</option>
                                <option>Hải Phòng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="sel1">
                                <option>--- Diện tích ---</option>
                                <option>0m&sup2; - 30m&sup2;</option>
                                <option>30m&sup2; - 50m&sup2;</option>
                                <option>50m&sup2; - 75m&sup2;</option>
                                <option>75m&sup2; - 100m&sup2;</option>
                                <option>100m&sup2; - 150m&sup2;</option>
                                <option>150m&sup2; - 200m&sup2;</option>
                                <option>200m&sup2; - 300m&sup2;</option>
                                <option>300m&sup2; - 500m&sup2;</option>
                                <option>500m&sup2; - 1000m&sup2;</option>
                                <option>&gt;= 1000&sup2;</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="sel1">
                                <option>--- Mức giá ---</option>
                                <option>Thỏa thuận</option>
                                <option>0 - 500 triệu</option>
                                <option>500 triệu - 1 tỷ</option>
                                <option>1 tỷ - 2 tỷ</option>
                                <option>2 tỷ - 3 tỷ</option>
                                <option>3 tỷ - 5 tỷ</option>
                                <option>5 tỷ - 7 tỷ</option>
                                <option>7 tỷ - 10 tỷ</option>
                                <option>10 tỷ - 20 tỷ</option>
                                <option>&gt;= 20 tỷ</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="sel1">
                                <option>--- Phường/Xã ---</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="sel1">
                                <option>--- Đường/Phố ---</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="sel1">
                                <option>--- Số phòng ---</option>
                                <option>1+</option>
                                <option>2+</option>
                                <option>3+</option>
                                <option>4+</option>
                                <option>5+</option>
                            </select>
                        </div>
                        <div class="form-group advanced-search">
                            <select class="form-control" id="sel1">
                                <option>--- Hướng nhà ---</option>
                                <option>Đông</option>
                                <option>Tây</option>
                                <option>Nam</option>
                                <option>Bắc</option>
                                <option>Đông-Bắc</option>
                                <option>Tây-Bắc</option>
                                <option>Đông-Nam</option>
                                <option>Tây-Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="search_type" type="checkbox" data-toggle="toggle" data-off="Cơ bản" data-on="Nâng cao">
                            <button type="submit" class="btn btn-primary" style="float: right;">
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