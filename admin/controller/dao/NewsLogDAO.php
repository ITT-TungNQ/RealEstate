<?php

try {
    if (!file_exists((__DIR__) . '/../../util/AccessDatabase.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../../util/AccessDatabase.php';
    }
    if (!file_exists((__DIR__) . '/../../util/Constant.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../../util/Constant.php';
    }
    if (!file_exists((__DIR__) . '/../../util/News.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../../util/News.php';
    }
    if (!file_exists((__DIR__) . '/../../util/NewsLog.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../../util/NewsLog.php';
    }
    if (!file_exists((__DIR__) . '/NewsDAO.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/NewsDAO.php';
    }
    if (!file_exists((__DIR__) . '/../GetUser.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../GetUser.php';
    }

    // ========== start - CHECK LOGIN AND ROLE ==========
    if (!file_exists((__DIR__) . '/../../include/check-role.php')) {
        throw new Exception ();
    } else {
        require_once (__DIR__) . '/../../include/check-role.php';
    }

    checkRole(Constants::VIEW_NEWS_LOG);
} catch (Exception $e) {
    header("location: http://192.168.1.220:8080/RealEstate/admin/404-file-not-found");
    exit();
}

// ========== end - CHECK LOGIN AND ROLE ==========

function getAllLogs() {
    try {
        $conn = getConnection();
        $sql = "SELECT LogID, UserID, NewsID, LogType, date_format(LogTime, '%d/%m/%y - %H:%i:%s') as LogTime 
            FROM news_log 
            ORDER BY LogTime DESC;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
        $lstLogs = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $log = new NewsLog();
            $log->setLogID($row['LogID']);
            $log->setLogTime($row['LogTime']);
            $log->setLogTypeID($row['LogType']);
            switch ($log->getLogTypeID()) {
                case Constants::LOG_APPROVAL:
                    $log->setLogTypeName("Được phê duyệt");
                    break;
                case Constants::LOG_CHANGE_STATE:
                    $log->setLogTypeName("Bị ẩn");
                    break;
                case Constants::LOG_CREATING:
                    $log->setLogTypeName("Được tạo mới");
                    break;
                case Constants::LOG_DELETE:
                    $log->setLogTypeName("Bị xóa");
                    break;
                case Constants::LOG_RECOVER:
                    $log->setLogTypeName("Được khôi phục");
                    break;
                case Constants::LOG_UPDATING:
                    $log->setLogTypeName("Cập nhật nội dung");
                    break;
            }

            $news = getNewsByID($row['NewsID']);
            if (function_exists('getUserByID')) {
                $user = getUserByID($row['UserID']);
            } else {
                throw new Exception(mysqli_error($conn));
            }

            if (!isset($user) || !isset($news)) {
                throw new Exception(mysqli_error($conn));
            }

            $log->setNews($news);
            $log->setUser($user);

            array_push($lstLogs, $log);
        }
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/unexpected-error");
        exit();
    } finally {
        closeConnect($conn);
    }

    return $lstLogs;
}
