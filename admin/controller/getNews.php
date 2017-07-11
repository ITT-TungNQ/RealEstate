<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getAllNews() {
    $conn = getConnection();
    $sql = "SELECT `NewsID`, `NewsTypeID`, `Lineage`, `Title`, `IllustrationURL`, `Description`, `Details`, `LastUpdated`, `ViewNumber`, `Acreage`, `Price`, `Contact`, `Direction`, `Rooms`, `IsHire`, `State` FROM `news` ORDER BY `NewsID`;";
    $result = mysqli_query($conn, $sql);
    $lstNews = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $news = new News();
        $news->setNewsID($row['NewsID']);
        $news->setNewsTypeID($row['NewsTypeID']);
        $news->setLineage($row['Lineage']);
        $news->setTitle($row['Title']);
        $news->setIllustrationURL($row['IllustrationURL']);
        $news->setDescription($row['Description']);
        $news->setDetail($row['Details']);
        $news->setLastUpdated($row['LastUpdated']);
        $news->setAcreage($row['Acreage']);
        $news->setPrice($row['Price']);
        $news->setContact($row['Contact']);
        $news->setDirection($row['Direction']);
        $news->setRoom($row['Rooms']);
        $news->setIsHire($row['IsHire']);
        $news->setState($row['State']);
        array_push($lstNews, $news);
    }

    mysqli_close($conn);
    return $lstNews;
}

function getNewsByID($newsID) {
    $conn = getConnection();
    $news;
    $sql = "SELECT `NewsID`, `NewsTypeID`, `Lineage`, `Title`, `IllustrationURL`, `Description`, `Details`, `LastUpdated`, `ViewNumber`, `Acreage`, `Price`, `Contact`, `Direction`, `Rooms`, `IsHire`, `State`"
            . "FROM `news`, `news_type` "
            . "WHERE `NewsID` = $newsID AND news.NewsTypeID = news_type.TypeID  "
            . " ORDER BY `NewsID`";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $news = new News();
        $news->setNewsID($row['NewsID']);
        $news->setNewsTypeID($row['NewsTypeID']);
        $news->setLineage($row['Lineage']);
        $news->setTitle($row['Title']);
        $news->setIllustrationURL($row['IllustrationURL']);
        $news->setDescription($row['Description']);
        $news->setDetail($row['Details']);
        $news->setLastUpdated($row['LastUpdated']);
        $news->setAcreage($row['Acreage']);
        $news->setPrice($row['Price']);
        $news->setContact($row['Contact']);
        $news->setDirection($row['Direction']);
        $news->setRoom($row['Rooms']);
        $news->setIsHire($row['IsHire']);
        $news->setState($row['State']);
    }

    closeConnect($conn);
    return $news;
}

?>