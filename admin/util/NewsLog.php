<?php

class NewsLog {

    private $logID;
    private $logTypeID;
    private $logTypeName;
    private $logTime;
    private $user;
    private $news;

    function getLogID() {
        return $this->logID;
    }

    function getLogTypeID() {
        return $this->logTypeID;
    }

    function getLogTypeName() {
        return $this->logTypeName;
    }

    function getLogTime() {
        return $this->logTime;
    }

    function getUser() {
        return $this->user;
    }

    function getNews() {
        return $this->news;
    }

    function setLogID($logID) {
        $this->logID = $logID;
    }

    function setLogTypeID($logTypeID) {
        $this->logTypeID = $logTypeID;
    }

    function setLogTypeName($logTypeName) {
        $this->logTypeName = $logTypeName;
    }

    function setLogTime($logTime) {
        $this->logTime = $logTime;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setNews($news) {
        $this->news = $news;
    }

}

?>