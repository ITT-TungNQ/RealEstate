<!--Header-part-->
<div id="header">
    <h1><a href="http://192.168.1.220:8080/RealEstate/admin/">ITT Team Admin</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
<!--        <li  class="dropdown" id="profile-messages" >
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
                <i class="icon icon-user"></i>
                <span class="text"><?php echo $_SESSION['login_user']['LastName'] . ' ' . $_SESSION['login_user']['MiddleName'] . ' ' . $_SESSION['login_user']['FirstName'] ?></span><b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="http://192.168.1.220:8080/RealEstate/admin/user-details.php"><i class="icon-user"></i> Thông tin tài khoản</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-check"></i> Công việc của tôi</a></li>
                <li class="divider"></li>
                <li><a href="http://192.168.1.220:8080/RealEstate/admin/dang-xuat"><i class="icon-key"></i> Đăng xuất</a></li>
            </ul>
        </li>-->
<!--        <li class="dropdown" id="menu-messages">
            <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle">
                <i class="icon icon-envelope"></i> <span class="text">Hộp thư</span>
                <span class="label label-important">5</span> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> Tạo mới</a></li>
                <li class="divider"></li>
                <li>
                    <a class="sInbox" title="" href="#">
                        <i class="icon-envelope"></i> Tin nhắn
                        <span class="label">3</span>
                         <b class="caret"></b> 
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="sOutbox" title="" href="#">
                        <i class="icon-arrow-up"></i> Liên hệ khách hàng
                        <span class="label">2</span>
                    </a>
                </li>
                <li class="divider"></li>
                <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> Thùng rác</a></li>
            </ul>
        </li>-->
        <!--<li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Tùy chỉnh</span></a></li>-->
        <li class=""><a title="" href="http://192.168.1.220:8080/RealEstate/admin/user-details.php"><i class="icon-user"></i> <?php echo $_SESSION['login_user']['LastName'] . ' ' . $_SESSION['login_user']['MiddleName'] . ' ' . $_SESSION['login_user']['FirstName'] ?></a></li>
        <li class=""><a title="" href="http://192.168.1.220:8080/RealEstate/admin/dang-xuat"><i class="icon icon-share-alt"></i> <span class="text">Đăng xuất</span></a></li>
    </ul>
</div>
<!--close-top-Header-menu-->