<?php
require_once ("data/truyvan.php");
$con = connect();
    $tinNoiBat=TinNoiBat($con);
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="float: right;">
    <div class="row">
        <div class="right_bar">
            <div class="single_leftbar wow fadeInDown">
                <h2><span>Tin phổ biến</span></h2>
                <div class="singleleft_inner">
                    <ul class="catg3_snav ppost_nav wow fadeInDown">
                        
                        <?php
                        foreach ($tinNoiBat as $a){
                        ?>
                        <li>
                            <div class="media">
                                <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>" class="media-left"><img alt="" src="<?php echo ($a['IllustrationURL']); ?>"></a>
                                <div class="media-body">
                                    <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>" class="catg_title"><?php echo ($a['Title']); ?> </a>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                        
                    </ul>
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