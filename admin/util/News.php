<?php

class News {

    private $newsId;
    private $newType;
    private $lineage;
    private $description;
    private $details;
    private $lastUpdated;
    private $viewNumber;
    private $illustrationURL;
    private $price;
    private $contact;
    private $direction;
    private $rooms;
    private $hire;
    private $state;
    private $newTypeName;
    private $locationName;

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

    function getDetails() {
        return $this->details;
    }

    function setDetails($details) {
        $this->details = $details;
    }

    function getNewsId() {
        return $this->newsId;
    }

    function getNewType() {
        return $this->newType;
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

    function getRooms() {
        return $this->rooms;
    }

    function getHire() {
        return $this->hire;
    }

    function getState() {
        return $this->state;
    }

    function setNewsId($newsId) {
        $this->newsId = $newsId;
    }

    function setNewType($newType) {
        $this->newType = $newType;
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

    function setRooms($rooms) {
        $this->rooms = $rooms;
    }

    function setHire($hire) {
        $this->hire = $hire;
    }

    function setState($state) {
        $this->state = $state;
    }

}
