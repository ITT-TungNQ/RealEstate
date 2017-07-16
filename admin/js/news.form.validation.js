$(document).ready(function () {
    /* ========== LOAD LOCATION FROM JSON ========== */
    $lstProvinces = [];
    $lstDistricts = [];
    $lsrWards = [];
    $.getJSON("http://192.168.1.220:8080/RealEstate/Location.json", function (data) {
        $.each(data, function (key, province) {
            $lstProvinces[province.locationID] = province;
            $("#provinceID").append('<option value="' + province.locationID + '">' + province.locationName + '</option>');
        });

        setLocation();
    });

    $('#provinceID').on('change', function () {
        $('#s2id_districtID span:eq(0)').text("--- Chọn quận/huyện ---");
        $('#s2id_wardID span:eq(0)').text("--- Chọn phường/xã ---");

        if (this.value != 0) {
            $('#provinceID_msg').css({"display": "none"});
        } else {
            $('#provinceID_msg').css({"display": "inline-block"});
        }
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
    });

    $('#districtID').on('change', function () {
        $('#s2id_wardID span:eq(0)').text("--- Chọn phường/xã ---");

        if (this.value != 0) {
            $('#districtID_msg').css({"display": "none"});
        } else {
            $('#districtID_msg').css({"display": "inline-block"});
        }
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
    });

    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg !== value;
    }, "Value must not equal arg.");

    $.validator.addMethod("regx_phone_number", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter a valid username.");

    $is_price_msg_shown = false;
    $('#price').bind('input propertychange', function () {
        $money = $(this).val();
        $money = $money.toString().replace(/\D/g, '');
        $money = $money.toString().replace(/\./g, '');
        $(this).val($money);

        if ($is_price_msg_shown) {
            if ($money == '') {
                $('#price_msg').text('Bạn chưa nhập giá thành');
                $('#price_msg').css({"display": "inline-block", "color": "#b94a48"});
            } else {
                if ($money % 1000 != 0) {
                    $('#price_msg').text('Giá thành là bội số của 1000');
                    $('#price_msg').css({"display": "inline-block", "color": "#b94a48"});
                } else {
                    $('#price_msg').css({"display": "none"});
                }
            }
        }

        if (!isNaN($money) && $money != '') {
            $('#price').val(Number($money).toLocaleString("vi"));
        }
    });
    $('#price').focusout(function () {
        $money = $(this).val();
        $money = $money.toString().replace(/\./g, '');

        if ($money != '') {
            $is_price_msg_shown = true;
            if ($money % 1000 != 0) {
                $is_price_msg_shown = true;
                $('#price_msg').text('Giá thành là bội số của 1000');
                $('#price_msg').css({"display": "inline-block", "color": "#b94a48"});
            }
        } else {

        }
    });
    // update news:
    $price = $('#price').val();
    if (!isNaN($price) && $price != '') {
        $('#price').val(Number($price).toLocaleString("vi"));
    }

    $("#form-add-news-validate").submit(function (event) {
        var provinceID = $('select[name="provinceID"]').val();
        var districtID = $('select[name="districtID"]').val();
        var details = $('textarea[name="detail"]').val();
        var price = $('input[name="price"]').val();

        if (provinceID != 0 && districtID != 0 && details != '') {
            $('#provinceID_msg').css({"display": "none"});
            $('#districtID_msg').css({"display": "none"});
            $('#detail_msg').css({"display": "none"});
            return true;
        } else {
            if (provinceID == 0) {
                $('#provinceID_msg').css({"display": "inline-block", "color": "#b94a48"});
            }
            if (districtID == 0) {
                $('#districtID_msg').css({"display": "inline-block", "color": "#b94a48"});
            }
            if (details == '') {
                $('#detail_msg').css({"display": "inline-block", "color": "#b94a48"});
            } else {
                $('#detail_msg').css({"display": "none"});
            }

            $('#loading-on-submit').css({"display": "none"});
            event.preventDefault();
        }

        if (price == '') {
            $is_price_msg_shown = true;
            $('#price_msg').text('Bạn chưa nhập giá thành');
            $('#price_msg').css({"display": "inline-block", "color": "#b94a48"});
            
            $('#loading-on-submit').css({"display": "none"});
            event.preventDefault();
        } else {
            if (price % 1000 != 0) {
                $is_price_msg_shown = true;
                $('#price_msg').text('Giá thành không hợp lệ');
                $('#price_msg').css({"display": "inline-block", "color": "#b94a48"});
                
                $('#loading-on-submit').css({"display": "none"});
                event.preventDefault();
            } else {
                $('#price_msg').css({"display": "none"});
            }
        }
    });

    $("#form-add-news-validate").validate({
        rules: {
            title: {
                required: true,
                minlength: 20,
                maxlength: 255
            },
            description: {
                required: true,
                minlength: 20,
                maxlength: 500
            },
            provinceID: {
                regx_phone_number: "0"
            },
            districtID: {
                required: true,
                min: 1
            },
            wardID: {
                required: false,
                min: 0
            },
            address: {
                required: true,
                minlength: 10,
                maxlength: 100
            },
            acreage: {
                required: true,
                number: true,
                min: 1
            },
            price: {
                required: true
            },
            room: {
                required: false,
                digits: true,
                min: 0
            },
            contact_name: {
                required: true,
                minlength: 8,
                maxlength: 50
            },
            contact_phone: {
                required: true,
                regx_phone_number: /^(01[2689]|09|\+841[2689]|02)[0-9]{8}$/
            },
            contact_mail: {
                required: false,
                email: true
            },
            detail: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Bạn cần nhập tiêu đề cho bài đăng",
                minlength: "Tiêu đề cần có ít nhất 20 ký tự",
                maxlength: "Tiêu đề có tối đa 255 ký tự"
            },
            description: {
                required: "Bạn cần nhập giới thiệu chung",
                minlength: "Giới thiệu cần có ít nhất 20 ký tự",
                maxlength: "Giới thiệu có tối đa 500 ký tự"
            },
            provinceID: {
                required: "Bạn cần chọn tỉnh/thành phố",
                valueNotEquals: "Bạn cần chọn tỉnh/thành phố",
                min: "Bạn cần chọn tỉnh/thành phố"
            },
            districtID: {
                required: "Bạn cần chọn quận/huyện",
                min: "Bạn cần chọn quận/huyện"
            },
            address: {
                required: "Bạn cần nhập địa chỉ",
                minlength: "Địa chỉ cần ít nhất 10 ký tự",
                maxlength: "Địa chỉ có tối đa 100 ký tự"
            },
            wardID: {
                required: "Bạn cần chọn phường/xã",
                min: "Bạn cần chọn phường/xã"
            },
            acreage: {
                required: "Bạn cần nhập diện tích",
                min: "Diện tích lớn hơn 0",
                number: "Nhập vào số"
            },
            price: {
                required: "Bạn cần nhập giá",
                min: "Giá thành không hợp lệ",
                number: "Nhập vào số"
            },
            room: {
                digits: "Số phòng không hợp lệ",
                min: "Số phòng không hợp lệ"
            },
            contact_name: {
                required: "Bạn chưa nhập người liên hệ",
                minlength: "Tên quá ngắn",
                maxlength: "Tên quá dài"
            },
            contact_phone: {
                required: "Bạn chưa nhập số điện thoại liên hệ",
                regx_phone_number: "Số điện thoại không đúng"
            },
            contact_mail: {
                required: false,
                email: "Định dạng e-mail không đúng"
            },
            detail: {
                required: "Bạn cần nhập chi tiết bản tin"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });
});


////////////////////////////////////////////////////////////
// View esate image thumb:
////////////////////////////////////////////////////////////
function noPreview() {
    $('#news-preview-img-container').css({"backgroundImage": "url('http://192.168.1.220:8080/RealEstate/admin/img/illustration-no-image.png'"});
}

function selectImage(e) {
    $('#news-preview-img-container').css({"backgroundImage": "url('" + e.target.result + "'"});
}

$('#illustrationURL').change(function () {
    var _URL = window.URL || window.webkitURL;
    var maxsize = 5 * 1024 * 1024; // 5 MB

    var file = this.files[0];
    if (file === undefined) {
        noPreview();
        return false;
    }

    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (!((file.type === match[0]) || (file.type === match[1]) || (file.type === match[2]))) {
        noPreview();

        $('#img-message').html('<div class="alert alert-error img-upload" role="alert">- Định dạng ảnh không được hỗ trợ.<br/>- Định dạng cho phép: JPG, JPEG, PNG.</div>');

        return false;
    }

    if (file.size > maxsize) {
        noPreview();
        $('#img-message').html('<div class=\"alert alert-error img-upload\" role=\"alert\">Kích thước ảnh của bạn: ' + (file.size / 1024).toFixed(2) + ' KB<br/>Kích thước tối đa: ' + (maxsize / 1024 / 1024).toFixed(2) + ' MB</div>');
        return false;
    }

    img = new Image();
    img.onload = function () {
        if (this.width < 700 || this.height < 350) {
            noPreview();
            $('#img-message').html('<div class=\"alert alert-error img-upload\" role=\"alert\">Kích thước ảnh của bạn: ' + this.width + 'x' + this.height + ' px<br/>Kích thước tối thiểu: 700x350 px</div>');
            return false;
        }
    };
    img.src = _URL.createObjectURL(file);

    $('#img-message').html('&nbsp;');
    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);
});