<div class="col-lg-7 col-md-7 col-sm-8 col-xs-12">
    <div class="row">
        <div class="middle_bar">
            <div class="featured_sliderarea">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $item = 0;
                        $tinMoiNhat = TinMoi($con);
                        foreach ($tinMoiNhat as $tin) {
                            ?>
                            <?php
                            if ($item == 0) {
                                ?>
                                <div class="item active"> 
                                    <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo ($tin['IllustrationURL']); ?>" alt="">
                                    <div class="carousel-caption">
                                        <h1><a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"><?php echo ($tin['Title']); ?></a></h1>
                                    </div>
                                </div>
                                <?php
                                $item++;
                            } else {
                                ?>
                                <div class="item"> 
                                    <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo ($tin['IllustrationURL']); ?>" alt="">
                                    <div class="carousel-caption">
                                        <h1><a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"><?php echo ($tin['Title']); ?></a></h1>
                                    </div>
                                </div>

                            <?php } ?><?php } ?>





                    </div>
                    <a class="left left_slide" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
                    </a> 
                    <a class="right right_slide" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <div class="single_category wow fadeInDown">
                <div class="category_title"> <a href="http://192.168.1.220:8080/RealEstate/category_archive.php">NHÀ ĐẤT NỔI BẬT</a></div>
                <div class="single_category_inner">
                    <ul class="catg_nav">

                        <?php
                        $nhadat = NhaDatNoiBat($con);
                        foreach ($nhadat as $a) {
                            ?>
                            <li>
                                <div class="catgimg_container"> <a class="catg1_img" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>">
                                        <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""> </a>
                                </div>
                                <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"><?php echo($a['Title']); ?></a>
                                <div class="sing_commentbox">
                                    <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                    <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="single_category  wow fadeInDown">
                <div class="category_title"> <a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloa&type=duanmoi">DỰ ÁN MỚI</a></div>
                <div class="single_category_inner">
                    <ul class="catg_nav catg_nav2">
                        <?php
                        $idType = "NewsTypeID=7 or NewsTypeID=8 or NewsTypeID=9 or NewsTypeID=10";
                        $duanmoi = TheLoai_PhanTrang($con, $idType, 0, 2);
                        foreach ($duanmoi as $a) {
                            ?>
                            <li>
                                <div class="catgimg_container"> <a class="catg1_img" href="#">
                                        <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""></a>
                                </div>
                                <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"><?php echo($a['Title']); ?></a>
                                <div class="sing_commentbox">
                                    <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                    <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
                                </div>
                                <p class="post-summary">
                                    <?php echo($a['Description']); ?>
                                </p>
                            </li>

                        <?php } ?>

                    </ul>
                </div>
            </div>

            <div class="category_three_fourarea wow fadeInDown">
                <div class="category_three">
                    <div class="single_category">
                        <div class="category_title">
                            <a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=canho">NHÀ BÁN</a>
                        </div>
                        <div class="single_category_inner">
                            <ul class="catg_nav catg_nav3">
                                <?php
                                $idType = "NewsTypeID=1 or NewsTypeID=2 or NewsTypeID=3 or NewsTypeID=4";
                                $nhaban = TheLoai_PhanTrang($con, $idType, 0, 1);
                                $nhaban2 = TheLoai_PhanTrang($con, $idType, 1, 4);
                                foreach ($nhaban as $a) {
                                    ?>
                                    <li>
                                        <div class="catgimg_container"> 
                                            <a class="catg1_img" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"> 
                                                <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""> 
                                            </a>
                                        </div>
                                        <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>">
                                            <?php echo ($a['Title']); ?>
                                        </a>
                                        <div class="sing_commentbox">
                                            <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                            <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
                                            <p class="post-summary">
                                                Vị trí: <?php
                                                $diachi = ViTri($con, $a['Lineage']);
                                                echo($diachi);
                                                ?> <br/>
                                                Diện tích: <span class="post_highlight"><?php echo($a['Acreage']); ?>m<sup>2</sup></span>
                                            </p>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="catg3_bottompost wow fadeInDown">
                                <ul class="catg3_snav">

                                    <?php foreach ($nhaban2 as $a) {
                                        ?>
                                        <li>
                                            <div class="media">
                                                <a class="media-left" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>">
                                                    <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""></a>
                                                <div class="media-body">
                                                    <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"> 
                                                        <?php echo ($a['Title']); ?>
                                                    </a>
                                                    <div class="sing_commentbox">
                                                        <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                                        <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="category_four wow fadeInDown">
                    <div class="single_category">
                        <div class="category_title"><a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=bietthu">BIỆT THỰ</a></div>
                        <div class="single_category_inner">
                            <ul class="catg_nav catg_nav3">
                                <?php
                                $idType = "NewsTypeID=5 or NewsTypeID=6";
                                $bietthu = TheLoai_PhanTrang($con, $idType, 0, 1);
                                $bietthu2 = TheLoai_PhanTrang($con, $idType, 1, 4);
                                foreach ($bietthu as $a) {
                                    ?>
                                    <li>
                                        <div class="catgimg_container"> 
                                            <a class="catg1_img" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"> 
                                                <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""> 
                                            </a>
                                        </div>
                                        <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>">
                                            <?php echo ($a['Title']); ?>
                                        </a>
                                        <div class="sing_commentbox">
                                            <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                            <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
                                            <p class="post-summary">
                                                Vị trí: <?php
                                                $diachi = ViTri($con, $a['Lineage']);
                                                echo($diachi);
                                                ?> <br/>
                                                Diện tích: <span class="post_highlight"><?php echo($a['Acreage']); ?>m<sup>2</sup></span>
                                            </p>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="catg3_bottompost wow fadeInDown">
                                <ul class="catg3_snav">

                                    <?php foreach ($bietthu2 as $a) {
                                        ?>
                                        <li>
                                            <div class="media">
                                                <a class="media-left" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>">
                                                    <img src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>" alt=""></a>
                                                <div class="media-body">
                                                    <a class="catg_title" href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>"> 
                                                        <?php echo ($a['Title']); ?>
                                                    </a>
                                                    <div class="sing_commentbox">
                                                        <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                                        <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="single_category wow fadeInDown">
                <div class="category_title"> <a href="http://192.168.1.220:8080/RealEstate/index.php?page=theloai&type=datnen">ĐẤT NỀN</a></div>
                <div class="single_category_inner">
                    <ul class="catg3_snav catg5_nav">
                        <?php
                        $idType = "NewsTypeID=11 or NewsTypeID=12";
                        $datnen = TheLoai_PhanTrang($con, $idType, 0, 6);
                        foreach ($datnen as $a) {
                           
                        ?>
                        <li>
                            <div class="media"> 
                                <a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>" class="media-left">
                                    <img alt="" src="http://192.168.1.220:8080/RealEstate/images/<?php echo($a['IllustrationURL']); ?>">
                                </a>
                                <div class="media-body"> 
                                    <a href="http://192.168.1.220:8080/RealEstate/index.php?page=details&id=<?php echo($a['NewsID']); ?>" class="catg_title"><?php echo($a['Title']);?></a>
                                    <div class="sing_commentbox">
                                         <p><i class="fa fa-calendar"></i><?php echo date('d-m-Y', strtotime($a['LastUpdated'])); ?></p>
                                                        <a href="#"><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?> Views</a>
  </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>