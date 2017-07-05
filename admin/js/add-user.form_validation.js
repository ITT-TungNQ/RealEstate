$(document).ready(function () {
    $.validator.addMethod("regxRequire", function (value, element, regexpr) {
        if (value === '') {
            return true;
        } else {
            return regexpr.test(value);
        }
    }, "Please enter a valid pasword.");
    $.validator.addMethod("regx_username", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Please enter a valid username.");

    $("#form-wizard-validate").validate({
        rules: {
            username: {
                required: true,
                minlength: 6,
                maxlength: 20,
                regx_username: /(^[a-zA-Z])([a-zA-Z0-9]){1,}$/
            },
            pwd: {
                required: true,
                minlength: 8,
                maxlength: 20,
                regxRequire: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            },
            first_name: {
                required: true,
                maxlength: 15
            },
            last_name: {
                required: true,
                maxlength: 15
            },
            middle_name: {
                required: false,
                maxlength: 45
            },
            user_email: {
                required: true,
                email: true
            }
        },
        messages: {
            username: {
                required: "Bạn cần nhập tài khoản",
                minlength: "Tài khoản cần ít nhất 6 ký tự",
                maxlength: "Tài khoản có tối đa 20 ký tự",
                regx_username: "- Tài khoản cần bắt đầu bằng một chữ cái <br/>- Không được chứa ký tự đặc biệt"
            },
            pwd: {
                required: "Bạn cần nhập mật khẩu",
                regxRequire: "Mật khẩu cần chứa chữ số, chữ in thường, chữ in hoa",
                minlength: "Mật khẩu cần có ít nhất 8 ký tự",
                maxlength: "Mật khẩu có tối đa 20 ký tự"
            },
            pwd2: {
                required: "Bạn cần xác nhận mật khẩu",
                equalTo: "Xác nhận mật khẩu không khớp"
            },
            first_name: {
                required: "Bạn cần nhập tên",
                maxlength: "Tên quá dài"
            },
            last_name: {
                required: "Bạn cần nhập họ",
                maxlength: "Họ quá dài"
            },
            middle_name: {
                maxlength: "Tên đệm quá dài"
            },
            user_email: {
                required: "Bạn cần nhập địa chỉ e-mail",
                email: "Hãy nhập vào đúng địa chỉ e-mail"
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

    $("#form-changepwd-validate").validate({
        rules: {
            pwd: {
                required: true,
                minlength: 8,
                maxlength: 20,
                regxRequire: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
            },
            pwd2: {
                required: true,
                equalTo: "#pwd"
            }
        },
        messages: {
            pwd: {
                required: "Bạn cần nhập mật khẩu mới",
                regxRequire: "Mật khẩu cần chứa chữ số, chữ in thường, chữ in hoa",
                minlength: "Mật khẩu cần có ít nhất 8 ký tự",
                maxlength: "Mật khẩu có tối đa 20 ký tự"
            },
            pwd2: {
                required: "Bạn cần xác nhận mật khẩu mới",
                equalTo: "Xác nhận mật khẩu mới không khớp"
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

    $("#form-user-info-validate").validate({
        rules: {
            pwd: {
                required: false,
                minlength: 8,
                maxlength: 20,
                regxRequire: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
            },
            pwd2: {
                required: false,
                equalTo: "#pwd"
            }
        },
        messages: {
            pwd: {
                required: "Bạn cần nhập mật khẩu mới",
                regxRequire: "Cần chứa ít nhất 1 ký tự in hoa và 1 số",
                minlength: "Mật khẩu cần có ít nhất 8 ký tự",
                maxlength: "Mật khẩu có tối đa 20 ký tự"
            },
            pwd2: {
                required: "Bạn cần xác nhận mật khẩu mới",
                equalTo: "Xác nhận mật khẩu mới không khớp"
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
// View profile image thumb:
////////////////////////////////////////////////////////////
function noPreview() {
//    $('#preview-img').attr('src', 'http://192.168.1.220:8080/RealEstate/admin/img/noimage.png');
    $('#preview-img-container').css({"backgroundImage": "url('http://192.168.1.220:8080/RealEstate/admin/img/noimage.png'"});
}

function selectImage(e) {
    //$('#preview-img').attr('src', e.target.result);
    $('#preview-img-container').css({"backgroundImage": "url('" + e.target.result + "'"});
}

$('#profile_picture').change(function () {
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
        $('#img-message').html('<div class=\"alert alert-error img-upload\" role=\"alert\">- Kích thước ảnh của bạn: ' + (file.size / 1024).toFixed(2) + ' KB<br/>Kích thước tối đa: ' + (maxsize / 1024 / 1024).toFixed(2) + ' MB</div>');

        return false;
    }

    $('#img-message').html('&nbsp;');
    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);
});