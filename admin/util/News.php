<?php

class News {

    private $newsId;
    private $newsTypeID;
    private $lineage;
    private $title;
    private $description;
    private $detail;
    private $lastUpdated;
    private $viewNumber;
    private $illustrationURL;
    private $price;
    private $acreage;
    private $contact;
    private $direction;
    private $room;
    private $isHire;
    private $state;
    private $newTypeName;
    private $locationName;

    function getTitle() {
        return $this->title;
    }

    function getAcreage() {
        return $this->acreage;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setAcreage($acreage) {
        $this->acreage = $acreage;
    }

    function getLocationName() {
        return $this->locationName;
    }

    function setLocationName($locationName) {
        $this->locationName = $locationName;
    }

    function getNewTypeName() {
        return $this->newTypeName;
    }

    function setNewTypeName($newTypeName) {
        $this->newTypeName = $newTypeName;
    }

    function getDetail() {
        return $this->detail;
    }

    function setDetail($details) {
        $this->detail = $details;
    }

    function getNewsId() {
        return $this->newsId;
    }

    function getNewsTypeID() {
        return $this->newsTypeID;
    }

    function getLineage() {
        return $this->lineage;
    }

    function getDescription() {
        return $this->description;
    }

    function getLastUpdated() {
        return $this->lastUpdated;
    }

    function getViewNumber() {
        return $this->viewNumber;
    }

    function getIllustrationURL() {
        return $this->illustrationURL;
    }

    function getPrice() {
        return $this->price;
    }

    function getContact() {
        return $this->contact;
    }

    function getDirection() {
        return $this->direction;
    }

    function getRoom() {
        return $this->room;
    }

    function getIsHire() {
        return $this->isHire;
    }

    function getState() {
        return $this->state;
    }

    function setNewsId($newsId) {
        $this->newsId = $newsId;
    }

    function setNewsTypeID($newType) {
        $this->newsTypeID = $newType;
    }

    function setLineage($lineage) {
        $this->lineage = $lineage;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setLastUpdated($lastUpdated) {
        $this->lastUpdated = $lastUpdated;
    }

    function setViewNumber($viewNumber) {
        $this->viewNumber = $viewNumber;
    }

    function setIllustrationURL($illustrationURL) {
        $this->illustrationURL = $illustrationURL;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setContact($contact) {
        $this->contact = $contact;
    }

    function setDirection($direction) {
        $this->direction = $direction;
    }

    function setRoom($rooms) {
        $this->room = $rooms;
    }

    function setIsHire($hire) {
        $this->isHire = $hire;
    }

    function setState($state) {
        $this->state = $state;
    }

}
