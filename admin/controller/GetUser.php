<?php

function getAllUser() {
    $conn = getConnection();
    $sql = "SELECT UserID, user.UserLevelID as UserLevelID, Username, FirstName, LastName, MiddleName, Email, ProfileImageURL, Enable, OnLine, LastLogin, DATE_FORMAT(DOB, '%d/%m/%Y') as DOB, UserLevelName 
            FROM user, user_level  
            WHERE user.UserLevelID = user_level.UserLevelID 
            ORDER BY UserLevelID, Username;";
    $result = mysqli_query($conn, $sql);
    $lstUser = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $user = new User();
        $user->setUserID($row['UserID']);
        $user->setUserLevelID($row['UserLevelID']);
        $user->setUsername($row['Username']);
        $user->setFirstName($row['FirstName']);
        $user->setLastName($row['LastName']);
        $user->setMiddleName($row['MiddleName']);
        $user->setProfileImageURL($row['ProfileImageURL']);
        $user->setEnable($row['Enable']);
        $user->setOnLine($row['OnLine']);
        $user->setLastLogin($row['LastLogin']);
        $user->setDOB($row['DOB']);
        $user->setEmail($row['Email']);
        $user->setUserLevelName($row['UserLevelName']);
        array_push($lstUser, $user);
    }

    mysqli_close($conn);
    return $lstUser;
}

function getUserByID($userID) {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $user;
    $sql = "SELECT UserID, user.UserLevelID as UserLevelID, Username, FirstName, LastName, MiddleName, Email, ProfileImageURL, Enable, OnLine, LastLogin, DATE_FORMAT(DOB, '%d/%m/%Y') as DOB, UserLevelName 
            FROM user, user_level  
            WHERE user.UserLevelID = user_level.UserLevelID 
                  and UserID = " . $userID . ";";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $user = new User();
        $user->setUserID($row['UserID']);
        $user->setUserLevelID($row['UserLevelID']);
        $user->setUsername($row['Username']);
        $user->setFirstName($row['FirstName']);
        $user->setLastName($row['LastName']);
        $user->setMiddleName($row['MiddleName']);
        $user->setProfileImageURL($row['ProfileImageURL']);
        $user->setEnable($row['Enable']);
        $user->setOnLine($row['OnLine']);
        $user->setLastLogin($row['LastLogin']);
        $user->setDOB($row['DOB']);
        $user->setEmail($row['Email']);
        $user->setUserLevelName($row['UserLevelName']);
    }

    closeConnect($conn);
    return $user;
}

?>