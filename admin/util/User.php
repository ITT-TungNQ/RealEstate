<?php

class User {

    private $userID;
    private $userLevelID;
    private $username;
    private $firstName;
    private $middleName;
    private $lastName;
    private $dob;
    private $email;
    private $profileImageURL;
    private $enable;
    private $online;
    private $lastLogin;
    var $userLevelName;

    function setUserID($par) {
        $this->userID = $par;
    }

    function getUserID() {
        return $this->userID;
    }

    function setUserLevelID($par) {
        $this->userLevelID = $par;
    }

    function getUserLevelID() {
        return $this->userLevelID;
    }

    function setUsername($par) {
        $this->username = $par;
    }

    function getUsername() {
        return $this->username;
    }

    function setFirstName($par) {
        $this->firstName = $par;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function setMiddleName($par) {
        $this->middleName = $par;
    }

    function getMiddleName() {
        return $this->middleName;
    }

    function setLastName($par) {
        $this->lastName = $par;
    }

    function getLastName() {
        return $this->lastName;
    }

    function setEmail($par) {
        $this->email = $par;
    }

    function getEmail() {
        return $this->email;
    }

    function setDOB($par) {
        $this->dob = $par;
    }

    function getDOB() {
        return $this->dob;
    }

    function setProfileImageURL($par) {
        $this->profileImageURL = $par;
    }

    function getProfileImageURL() {
        return $this->profileImageURL;
    }

    function setEnable($par) {
        $this->enable = $par;
    }

    function getEnable() {
        return $this->enable;
    }

    function setOnline($par) {
        $this->online = $par;
    }

    function getOnline() {
        return $this->online;
    }

    function setLastLogin($par) {
        $this->lastLogin = $par;
    }

    function getLastLogin() {
        return $this->lastLogin;
    }

    function setUserLevelName($par) {
        $this->userLevelName = $par;
    }

    function getUserLevelName() {
        return $this->userLevelName;
    }

}

?>