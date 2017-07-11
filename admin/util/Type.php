<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Type
 *
 * @author daohuong
 */
class Type {
    //put your code here
    private $typeID;
    private $typeName;

    function getTypeID() {
        return $this->typeID;
    }

    function getTypeName() {
        return $this->typeName;
    }

    function setTypeID($typeID) {
        $this->typeID = $typeID;
    }

    function setTypeName($typeName) {
        $this->typeName = $typeName;
    }

}
?>
