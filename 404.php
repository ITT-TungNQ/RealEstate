<!DOCTYPE html>
<html>
    <head>
        <title>Trang thông tin bất động sản</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <div class="container">
            <div class="box_wrapper">
                <?php include("include/menu.php"); ?>
                <?php include("include/home_slider.php"); ?>
                <section id="errorpage_body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="errorpage_area">
                                <div class="error-title"><span>404</span></div>
                                <div class="error_content">
                                    <p>
                                        <i class="fa fa-hand-o-right "></i>
                                        Sorry, the page you were looking for in this blog does not exist.
                                    </p>
                                    <a href="index.php">Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php include("include/footer.php"); ?>
            </div>
        </div>
    </body>
</html>