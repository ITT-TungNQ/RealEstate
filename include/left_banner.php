<?php
require_once ("data/truyvan.php");
$con = connect();
$tinmoi = TinMoi($con);
?>

<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
    <div class="row">
        <div class="left_bar">
            <div class="single_leftbar">
                <h2><span>Tin mới</span></h2>
                <div class="singleleft_inner">
                    <ul class="recentpost_nav wow fadeInDown">

                        <?php
                        foreach ($tinmoi as $a) {
                            ?>
                            <li>
                                <a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>">
                                    <img src="<?php echo ($a['IllustrationURL']); ?> "alt=""></a>
                                <a class="recent_title" href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>"><?php echo ($a['Title']); ?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>

            <div class="single_leftbar wow fadeInDown">
                <h2><span>Quảng cáo</span></h2>
                <div class="singleleft_inner"> <a href="#"><img src="http://192.168.1.220:8080/RealEstate/images/150x250.jpg" alt=""></a></div>
            </div>
        </div>
    </div>
</div>