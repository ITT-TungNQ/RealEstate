<?php
require_once ('include/check-role.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trang chủ quản lý</title>
        <?php include("include/header.php"); ?>
    </head>
    <body>
        <?php include("include/top-header.php"); ?>

        <?php include("include/left-menu.php"); ?>

        <!--main-container-part-->
        <div id="content">
            <!--breadcrumbs-->
            <div id="content-header">
                <div id="breadcrumb">
                    <a href="http://192.168.1.220:8080/RealEstate/admin/" title="Tới trang chủ" class="tip-bottom">
                        <i class="icon-home"></i> Trang chủ
                    </a>
                </div>
            </div>
            <!--End-breadcrumbs-->

            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2">
                            <span class="icon"><i class="icon-chevron-down"></i></span>
                            <h5>Bản tin mới</h5>
                        </div>
                        <div class="widget-content nopadding collapse in" id="collapseG2">
                            <ul class="recent-posts">
                                <li>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="img/demo/av1.jpg"> </div>
                                    <div class="article-post">
                                        <span class="user-info"> Đăng bởi: TùngNQ | Ngày đăng: 30/07/2017 | Giờ: 09:27 Sáng </span>
                                        <p>
                                            <a href="#">This is a much longer one that will go on for a few lines.It has multiple paragraphs and is full of waffle to pad out the comment.</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="img/demo/av1.jpg"> </div>
                                    <div class="article-post">
                                        <span class="user-info"> Đăng bởi: TùngNQ | Ngày đăng: 30/07/2017 | Giờ: 09:27 Tối </span>
                                        <p>
                                            <a href="#">This is a much longer one that will go on for a few lines.It has multiple paragraphs and is full of waffle to pad out the comment.</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="user-thumb"> <img width="40" height="40" alt="User" src="img/demo/av1.jpg"> </div>
                                    <div class="article-post">
                                        <span class="user-info"> Đăng bởi: TùngNQ | Ngày đăng: 30/07/2017 | Giờ: 11:27 Đêm </span>
                                        <p>
                                            <a href="#">This is a much longer one that will go on for a few lines.It has multiple paragraphs and is full of waffle to pad out the comment.</a>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <a href="http://192.168.1.220:8080/RealEstate/admin/">
                                        <button class="btn btn-warning btn-mini">Xem thêm</button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                            <h5>Danh sách việc của tôi</h5>
                        </div>
                        <div class="widget-content">
                            <div class="todo">
                                <ul>
                                    <li class="clearfix">
                                        <div class="txt"> Thêm bản tin rao bán biệt thự
                                            <span class="by label">TùngNQ</span> <span class="date badge badge-important">Today</span> 
                                        </div>
                                        <div class="pull-right"> 
                                            <a class="tip" href="#" title="Edit Task">
                                                <i class="icon-pencil"></i></a>
                                            <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> 
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="txt"> Thêm bản tin rao bán biệt thự
                                            <span class="by label">TùngNQ</span> 
                                            <span class="date badge badge-warning">Today</span> 
                                        </div>
                                        <div class="pull-right"> <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a> </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="txt"> Cập nhật lại quảng cáo
                                            <span class="by label">TùngNQ</span>
                                            <span class="date badge badge-success">Tomorrow</span>
                                        </div>
                                        <div class="pull-right">
                                            <a class="tip" href="#" title="Edit Task">
                                                <i class="icon-pencil"></i></a>
                                            <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="txt"> Chạy quảng cáo cho Vingroup
                                            <span class="by label">TùngNQ</span> <span class="date badge badge-info">12.08.2017</span>
                                        </div>
                                        <div class="pull-right">
                                            <a class="tip" href="#" title="Edit Task"><i class="icon-pencil"></i></a> 
                                            <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="http://192.168.1.220:8080/RealEstate/admin/">
                                            <button class="btn btn-warning btn-mini">Xem thêm</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="widget-box widget-calendar">
                        <div class="widget-title"> <span class="icon"><i class="icon-calendar"></i></span>
                            <h5>Lịch</h5>
                            <div class="buttons"> <a id="add-event" data-toggle="modal" href="#modal-add-event" class="btn btn-inverse btn-mini"><i class="icon-plus icon-white"></i> Thêm sự kiện</a>
                                <div class="modal hide" id="modal-add-event">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h3>Thêm sự kiện</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nhập tên sự kiện:</p>
                                        <p>
                                            <input id="event-name" type="text" />
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn" data-dismiss="modal">Hủy</a>
                                        <a href="#" id="add-event-submit" class="btn btn-primary">Thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="panel-left">
                                <div id="fullcalendar"></div>
                            </div>
                            <div id="external-events" class="panel-right">
                                <div class="panel-title">
                                    <h5>Kéo sự kiện vào lịch</h5>
                                </div>
                                <div class="panel-content">
                                    <div class="external-event ui-draggable label label-inverse">My Event 1</div>
                                    <div class="external-event ui-draggable label label-inverse">My Event 2</div>
                                    <div class="external-event ui-draggable label label-inverse">My Event 3</div>
                                    <div class="external-event ui-draggable label label-inverse">My Event 4</div>
                                    <div class="external-event ui-draggable label label-inverse">My Event 5</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--Footer-part-->
        <?php include("include/footer.php"); ?>
        <!--end-Footer-part-->

        <!-- Highlight menu -->
        <script type="text/javascript">
            $('div#sidebar ul li.header_menu_link').removeClass('active');
            $('div#sidebar ul li.header_menu_link:eq(0)').addClass('active');
        </script>
        <!-- end-Highlight menu -->
    </body>
</html>