
<?php
require_once ("data/truyvan.php");
$con = connect();

$tinmoi = TinMoi($con);
?>

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<a href="tel:+841643720393">
    <div class="make-a-call">
        <img src="http://192.168.1.220:8080/RealEstate/images/hotline.png" alt=""/>
        <p class="phone_number">0164 3720 393</p>
    </div>
</a>
<header id="header">
    <div class="header_top">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav custom_nav">
                        <li><a href="http://192.168.1.220:8080/RealEstate/index.html">Trang chủ</a></li>
                        <li><a href="http://192.168.1.220:8080/RealEstate/the-loai/du-an-moi">Dự án mới</a></li>
                        <li><a href="http://192.168.1.220:8080/RealEstate/the-loai/dat-nen">Đất nền</a></li>
                        <li><a href="http://192.168.1.220:8080/RealEstate/the-loai/can-ho">Căn hộ</a></li>
                        <li><a href="http://192.168.1.220:8080/RealEstate/the-loai/biet-thu">Biệt thự</a></li>
                        <li><a href="http://192.168.1.220:8080/RealEstate/the-loai/tin-moi">Tin mới</a></li>
                        <li><a href="#lien-he">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="header_search">
            <button id="searchIcon"><i class="fa fa-search"></i></button>
            <div id="shide">
                <div id="search-hide">
                    <form action="#">
                        <input type="text" size="40" placeholder="Search here ...">
                    </form>
                    <button class="remove"><span><i class="fa fa-times"></i></span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="header_bottom">
        <div class="logo_area"><a class="logo" href="#"><b>T</b>HE GOLDEN NQT<span>Không đâu bằng nhà mình</span></a></div>
        <div class="top_addarea"><a href="#"><img src="http://192.168.1.220:8080/RealEstate/images/addbanner.jpg" alt=""></a></div>
    </div>
</header>
<div class="latest_newsarea"> <span>Tin mới nhất</span>
    <ul id="ticker01" class="news_sticker">
        <?php
        foreach ($tinmoi as $a) {
            ?>
            <li><a href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>"><?php echo ($a['Title']); ?></a></li>
        <?php } ?>

    </ul>
</div>