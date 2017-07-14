<?php
$server_dir = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once ($server_dir . '/RealEstate/admin/util/Constant.php');

$is_allow_create_news = in_array(Constants::CREATE_NEWS, $_SESSION['user_role']);
$is_allow_update_news = in_array(Constants::UPDATE_NEWS, $_SESSION['user_role']);
$is_allow_change_news_state = in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role']);
$is_allow_view_news_log = in_array(Constants::VIEW_NEWS_LOG, $_SESSION['user_role']);
$is_allow_create_user = in_array(Constants::CREATE_USER, $_SESSION['user_role']);
$is_allow_update_user = in_array(Constants::UPDATE_USER_INFO, $_SESSION['user_role']);
$is_allow_manager_adv = in_array(Constants::MANAGER_ADV, $_SESSION['user_role']);
?>

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="header_menu_link active">
            <a href="http://192.168.1.220:8080/RealEstate/admin/trang-chu">
                <i class="icon icon-home"></i> <span>Dashboard</span>
            </a>
        </li>
        <?php
        if ($is_allow_create_user && $is_allow_update_user) {
            echo '  <li class="header_menu_link submenu">
                        <a href="#">
                            <i class="icon icon-user-md"></i>
                            <span>Quản lý tài khoản</span>
                        </a>
                        <ul>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/them-tai-khoan-quan-ly"><i class="icon icon-plus"></i> Thêm tài khoản mới</a></li>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/danh-sach-tai-khoan-quan-ly"><i class="icon icon-group"></i> Danh sách tài khoản</a></li>
                        </ul>
                    </li>';
        }

        if ($is_allow_create_news) {
            echo '  <li class="header_menu_link submenu">
                        <a href="#">
                            <i class="icon icon-file"></i>
                            <span>Quản lý bản tin</span>
                        </a>
                        <ul>
                                <li><a href="http://192.168.1.220:8080/RealEstate/admin/them-bai-dang-moi"><i class="icon icon-plus"></i> Thêm bản tin mới</a></li>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/quan-ly-bai-dang"><i class="icon icon-file"></i> Danh sách bản tin</a></li>';
            if ($is_allow_view_news_log) {
                echo '      <li><a href="http://192.168.1.220:8080/RealEstate/admin/nhat-ky-bai-dang"><i class="icon icon-calendar"></i> Nhật ký đăng tin</a></li>';
            }
            if ($is_allow_change_news_state) {
                echo '      <li><a href="http://192.168.1.220:8080/RealEstate/admin/phe-duyet-bai-dang"><i class="icon icon-upload"></i> Phê duyệt bản tin</a></li>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/thung-rac"><i class="icon icon-trash"></i> Thùng rác</a></li>';
            }
            echo '      </ul>
                    </li>';
        }

        if ($is_allow_manager_adv) {
            echo '  <li class="header_menu_link submenu">
                        <a href="#">
                            <i class="icon icon-film"></i>
                            <span>Quản lý quảng cáo</span>
                        </a>
                        <ul>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/access-denied"><i class="icon icon-plus"></i> Thêm quảng cáo mới</a></li>
                            <li><a href="http://192.168.1.220:8080/RealEstate/admin/access-denied"><i class="icon icon-film"></i> Danh sách quảng cáo</a></li>
                        </ul>
                    </li>';
        }
        ?>
</div>
<!--sidebar-menu-->