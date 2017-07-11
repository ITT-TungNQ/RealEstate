<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getAllType() {
    $conn = getConnection();
    $sql = "SELECT TypeID, TypeName 
            FROM news_type 
            ORDER BY TypeID";
    $result = mysqli_query($conn, $sql);
    $lstType = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $type = new Type();
        $type->setTypeID($row['TypeID']);
        $type->setTypeName($row['TypeName']);

        array_push($lstType, $type);
    }

    mysqli_close($conn);
    return $lstType;
}

function getTypeByID($typeID) {
    $conn = getConnection();
    $type;
    $sql = "SELECT TypeID, TypeName 
            FROM news_type  
            WHERE TypeID = " . $typeID . ";";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $type = new Type();
        $type->setTypeID($row['TypeID']);
        $type->setTypeName($row['TypeName']);
    }

    closeConnect($conn);
    return $type;
}

?>