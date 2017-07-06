<?php

$server_dir = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $server_dir . '/RealEstate/util/Location.php';
require_once $server_dir . '/RealEstate/util/AccessDatabase.php';

function getAllLocations() {
    $lstProvinces = array();
    if (isset($_SESSION['lstLocations']) && count($_SESSION['lstLocations']) > 0) {
        return $_SESSION['lstLocations'];
    }

    $conn = getConnection();
    $sql = "SELECT LocationID, LocationName, IsParent FROM location "
            . "WHERE LocationType = 1 "
            . "ORDER BY POS";
    $provinceResult = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($provinceResult, MYSQLI_ASSOC)) {
        $province = new Location();
        $province->locationID = $row['LocationID'];
        $province->locationName = $row['LocationName'];
        $province->isParent = $row['IsParent'];

        // Lấy quận/huyện của tỉnh/thành phố
        if ($province->isParent) {
            $province->lstSubLocations = getLocationsByParent($province->locationID);

            // Lấy xã/phường của quận/huyện
            foreach ($province->lstSubLocations as $districtID => $district) {
                if ($district->isParent) {
                    $lstWard = getLocationsByParent($districtID);
                    $district->lstSubLocations = $lstWard;
                }
            }
        } else {
            
        }

        $lstProvinces[($province->locationID)] = $province;
    }

    closeConnect($conn);
    
    $_SESSION['lstLocations'] = $lstProvinces;
    return $lstProvinces;
}

function getLocationsByParent($parentID) {
    $conn = getConnection();
    $sql = "SELECT LocationID, LocationName, IsParent FROM location "
            . "WHERE ParentID = $parentID "
            . "ORDER BY POS";
    $result = mysqli_query($conn, $sql);

    $lstSubLocation = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $location = new Location();
        $location->locationID = $row['LocationID'];
        $location->locationName = $row['LocationName'];
        $location->isParent = $row['IsParent'];

        $lstSubLocation[($location->locationID)] = $location;
    }

    closeConnect($conn);
    return $lstSubLocation;
}
