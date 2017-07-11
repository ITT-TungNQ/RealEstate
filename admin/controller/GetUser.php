<?php

function getAllUser() {
    try {
        $conn = getConnection();
        $sql = "SELECT UserID, user.UserLevelID as UserLevelID, Username, FirstName, LastName, MiddleName, Email, ProfileImageURL, Enable, OnLine, LastLogin, DATE_FORMAT(DOB, '%d/%m/%Y') as DOB, UserLevelName 
            FROM user, user_level  
            WHERE user.UserLevelID = user_level.UserLevelID 
            ORDER BY UserLevelID, Username;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }

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
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/500.php");
    } finally {
        mysqli_close($conn);
    }
    return $lstUser;
}

function getUserByID($userID) {
    try {
        $conn = getConnection();
        $user;
        $sql = "SELECT UserID, user.UserLevelID as UserLevelID, Username, FirstName, LastName, MiddleName, Email, ProfileImageURL, Enable, OnLine, LastLogin, DATE_FORMAT(DOB, '%d/%m/%Y') as DOB, UserLevelName 
            FROM user, user_level  
            WHERE user.UserLevelID = user_level.UserLevelID 
                  and UserID = " . $userID . ";";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($conn));
        }

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
    } catch (Exception $ex) {
        header("location: http://192.168.1.220:8080/RealEstate/admin/pages/500.php");
    } finally {
        mysqli_close($conn);
    }
    return $user;
}

?>