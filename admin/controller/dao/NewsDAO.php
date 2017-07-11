<?php

require_once (__DIR__) . '/../../util/AccessDatabase.php';
require_once (__DIR__) . '/../../util/Constant.php';
require_once (__DIR__) . '/../../util/News.php';

// ========== start - CHECK LOGIN AND ROLE ==========
require_once (__DIR__) . '/../../include/check-role.php';
checkRole(Constants::UPDATE_NEWS);

// ========== end - CHECK LOGIN AND ROLE ==========

function getNewsBySate($state) {
    try {
        $conn = getConnection();
        $sql = "SELECT `NewsID`, `news`.`NewsTypeID` as NewsTypeID, TypeName, `news`.`Lineage` as Lineage, `Title`, `Description`, `IllustrationURL`, `Details`, DATE_FORMAT(`LastUpdated`, '%d/%m/%Y %H:%i') as `LastUpdated`, `ViewNumber`, `Acreage`, `Price`, `Contact`, `Direction`, `Rooms`, `IsHire`, `State` 
            FROM news, news_type  
            WHERE State = $state AND news.NewsTypeID = news_type.TypeID 
            ORDER BY NewsID;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }
        $lstNewsByState = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $news = new News();
            $news->setNewsId($row['NewsID']);
            $news->setNewType($row['NewsTypeID']);
            $news->setLineage($row['Lineage']);
            $news->setTitle($row['Title']);
            $news->setDescription($row['Description']);
            $news->setIllustrationURL($row['IllustrationURL']);
            $news->setDetails($row['Details']);
            $news->setLastUpdated($row['LastUpdated']);
            $news->setViewNumber($row['ViewNumber']);
            $news->setAcreage($row['Acreage']);
            $news->setPrice($row['Price']);
            $news->setContact($row['Contact']);
            $news->setDirection($row['Direction']);
            $news->setRooms($row['Rooms']);
            $news->setHire($row['IsHire']);
            $news->setState($state);
            $news->setNewTypeName($row['TypeName']);

            $sql = "select (select LocationName from location where LocationID = substring_index(substring_index('" . $news->getLineage() . "', '/', -4), '/', 1)) as LocFirst,
                (select LocationName from location where LocationID = substring_index(substring_index('" . $news->getLineage() . "', '/', -3), '/', 1)) as LocMiddle,
                (select LocationName from location where LocationID = substring_index(substring_index('" . $news->getLineage() . "', '/', -2), '/', 1)) as LocLast";
            $result1 = mysqli_query($conn, $sql);
            if (!$result) {
                throw new Exception(mysqli_error($conn));
            }

            while ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                $strLocation = $row['LocLast'];
                if (!empty($row['LocMiddle'])) {
                    $strLocation .= ', ' . $row['LocMiddle'];
                }
                if (!empty($row['LocFirst'])) {
                    $strLocation .= ', ' . $row['LocFirst'];
                }
                $news->setLocationName($strLocation);
            }
            array_push($lstNewsByState, $news);
        }
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/500.php");
    } finally {
        closeConnect($conn);
    }

    return $lstNewsByState;
}

function changeNewsSate($newsID, $state) {
    $conn = getConnection();
    mysqli_autocommit($conn, false);

    $sql = "UPDATE news SET State=$state WHERE NewsID='$newsID';";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn)) {
            if (insertNewsLog($newsID, Constants::LOG_CHANGE_STATE, $conn)) {
                // Commit transaction
                mysqli_commit($conn);
                closeConnect($conn);
                return true;
            }
        } else {
//            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
//            setcookie('change_news_state_err', 'SQL ERROR: Đã xảy ra lỗi khi cập nhật trạng thái bản tin.', time()+36000, '/RealEstate/admin/approval-news-page.php');
        }
    }

    closeConnect($conn);
    return false;
}

function insertNewsLog($newsID, $type, $conn) {
    $sql = "INSERT INTO news_log (`UserID`, `NewsID`, `LogType`, `LogTime`) "
            . "VALUES ('" . $_SESSION['login_user']['UserID'] . "', '" . $newsID . "', '" . $type . "', '" . date('Y-m-d H:i:s') . "');";

    if (mysqli_query($conn, $sql)) {
        if (mysqli_affected_rows($conn)) {
            return true;
//            echo "Records inserted successfully.";
        } else {
            return false;
//            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        }
    }
}

?>