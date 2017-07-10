<?php

require_once (__DIR__) . '/../util/Constant.php';
require_once (__DIR__) . '/dao/NewsDAO.php';

/* ========= PHÊ DUYỆT BÀI ĐĂNG ========= */
if (isset($_POST['activate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/approval-news-page.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

if (isset($_POST['deactivate-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DISABLE);

        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/approval-news-page.php');
        }
        header("location: http://192.168.1.220:8080/RealEstate/admin/approval-news-page.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

/* ========= THÙNG RÁC ========= */
if (isset($_POST['recover-news'])) {
    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::ENABLE);

        setcookie('change_to', Constants::ENABLE, time() + 36000, '/RealEstate/admin/news-trash.php');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/news-trash.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/news-trash.php');
        }

        header("location: http://192.168.1.220:8080/RealEstate/admin/news-trash.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}

if (isset($_POST['delete-news'])) {

    if (in_array(Constants::CHANGE_NEWS_STATE, $_SESSION['user_role'])) {
        $isSuccess = changeNewsSate(filter_input(INPUT_POST, 'newsID'), Constants::DETELED);

        setcookie('change_to', Constants::DETELED, time() + 36000, '/RealEstate/admin/news-trash.php');
        if ($isSuccess) {
            setcookie('change_news_state', 'true', time() + 36000, '/RealEstate/admin/news-trash.php');
        } else {
            setcookie('change_news_state', 'false', time() + 36000, '/RealEstate/admin/news-trash.php');
        }
        
        header("location: http://192.168.1.220:8080/RealEstate/admin/news-trash.php");
    } else {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/404.php");
    }

    exit();
}
?>