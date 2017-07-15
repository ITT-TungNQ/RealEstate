$(document).ready(function () {
    $strState = '';
    $strHire = '';
    $strType = '';
    $strProvince = '';
    $strDistrict = '';
    $strWard = '';
    $strLocation = '';

    /* ========== LOAD LOCATION FROM JSON ========== */
    $lstProvinces = [];
    $lstDistricts = [];
    $lsrWards = [];
    $.getJSON("http://192.168.1.220:8080/RealEstate/Location.json", function (data) {
        $.each(data, function (key, province) {
            $lstProvinces[province.locationID] = province;
            $("#provinceID").append('<option value="' + province.locationID + '">' + province.locationName + '</option>');
        });
    });

    $('#provinceID').on('change', function () {
        $strProvince = $("#provinceID option:selected").text();

        $('#s2id_districtID span:eq(0)').text("--- Chọn quận/huyện ---");
        $('#s2id_wardID span:eq(0)').text("--- Chọn phường/xã ---");

        $("#districtID").html('<option value="0">--- Chọn quận/huyện ---</option>');
        if ($lstProvinces[this.value]) {
            $data = $lstProvinces[this.value].lstSubLocation;
            if ($data) {
                $.each($data, function (key, district) {
                    $lstDistricts[district.locationID] = district;
                    $("#districtID").append('<option value="' + district.locationID + '">' + district.locationName + '</option>');
                });
            }
        }

        doFilter();
    });

    $('#districtID').on('change', function () {
        $strDistrict = $("#districtID option:selected").text();

        $('#s2id_wardID span:eq(0)').text("--- Chọn phường/xã ---");

        $("#wardID").html('<option value="0">--- Chọn phường/xã ---</option>');
        if ($lstDistricts[this.value]) {
            $data = $lstDistricts[this.value].lstSubLocation;
            if ($data) {
                $.each($data, function (key, ward) {
                    $lsrWards[ward.locationID] = ward;
                    $("#wardID").append('<option value="' + ward.locationID + '">' + ward.locationName + '</option>');
                });
            }
        }

        doFilter();
    });

    $('#wardID').on('change', function () {
        $strWard = $("#wardID option:selected").text();
        doFilter();
    });

    /* ======== LỌC TIN TRONG BẢNG ======== */
    $strFilter = '';

    $('#state').on('change', function () {
        if ($(this).val() != "-1") {
            $strState = $("#state option:selected").text();
        } else {
            $strState = '';
        }

        doFilter();
    });

    $('#isHire').on('change', function () {
        if ($(this).val() != "-1") {
            $strHire = $("#isHire option:selected").text();
        } else {
            $strHire = '';
        }

        doFilter();
    });

    $('#typeID').on('change', function () {
        $typeID = $(this).val();
        switch ($typeID) {
            case "1":
                $strType = 'Căn hộ chung cư';
                break;
            case "2":
                $strType = 'Nhà riêng';
                break;
            case "3":
                $strType = 'Nhà mặt phố';
                break;
            case "4":
                $strType = 'Tập thể';
                break;
            case "5":
                $strType = 'Biệt thự cao cấp';
                break;
            case "6":
                $strType = 'Biệt thự liền kề';
                break;
            case "7":
                $strType = 'Khu nghỉ dưỡng';
                break;
            case "8":
                $strType = 'Chung cư, khu đô thị';
                break;
            case "9":
                $strType = 'Trang trại';
                break;
            case "10":
                $strType = 'Dự án khác';
                break;
            case "11":
                $strType = 'Đất nền dự án';
                break;
            case "12":
                $strType = 'Bán đất';
                break;
            case "13":
                $strType = 'Loại khác';
                break;
            default:
                $strType = '';
                break;
        }

        doFilter();
    });
//

    function doFilter() {
        if ($("#provinceID").val() != 0) {
            $strLocation = $strProvince;
            if ($("#districtID").val() != 0) {
                $strLocation = $strDistrict + ', ' + $strLocation;
                if ($("#wardID").val() != 0) {
                    $strLocation = $strWard + ', ' + $strLocation;
                }
            }
        } else {
            $strLocation = '';
        }


        $strFilter = '';
        $strFilter += $strState + ' ';
        $strFilter += $strHire + ' ';
        $strFilter += $strType + ' ';
        $strFilter += $strLocation;

        $('#table_second_filter').val($strFilter).trigger("keyup");
    }
});
