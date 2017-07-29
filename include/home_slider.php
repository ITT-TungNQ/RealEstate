<!-- MENU SLIDER -->
<div class="thumbnail_slider_area">
    <div class="owl-carousel">
        <?php
     $tinmoi = TinNoiBat($con);
        foreach ($tinmoi as $a) {
            ?>
            <div class="signle_iteam">
                <div class="slider_image" style="background-image: url('<?php echo($a['IllustrationURL']); ?>');">
                    
                </div>
                <!--<img src="http://192.168.1.220:8080/RealEstate/BDS/images/395x396_image_01.jpg" alt="<?php echo($a['Title']); ?>" >-->
                <div class="sing_commentbox slider_comntbox">
                    <p><i class="fa fa-calendar"></i><?php echo date('d/m/Y',strtotime($a['LastUpdated'])); ?></p>
                    <p><i class="fa fa-eye"></i><?php echo($a['ViewNumber']); ?></p>
                </div>
                <a class="slider_tittle" href="http://192.168.1.220:8080/RealEstate/chi-tiet/<?php echo(makeURL($a['Title'])); ?>-<?php echo($a['NewsID']); ?>"><?php echo($a['Title']); ?></a> 
            </div>
            <?php
        }
        ?>

    </div>
</div>