$(document).ready(function () {
    $('#login_form').validate({
        rules: {
            username: {
                required: true,
                maxlength: 20
            },
            pwd: {
                required: true,
                maxlength: 20
            }
        },
        messages: {
            username: {
                required: "Bạn cần nhập tài khoản",
                maxlength: "Tài khoản có tối đa 20 ký tự"
            },
            pwd: {
                required: "Bạn cần nhập mật khẩu",
                maxlength: "Mật khẩu có tối đa 20 ký tự"
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
    
    $('#recover_form').on('submit', function (e) {
       if ($(this).valid() !== true) {
           $('#loading-on-submit').css({"display": "none"});
           e.preventDefault();
       } 
    });
    $('#login_form').on('submit', function (e) {
       if ($(this).valid() !== true) {
           $('#loading-on-submit').css({"display": "none"});
           e.preventDefault();
       } 
    });

    $('#recover_form').validate({
        rules: {
            username: {
                required: true,
                maxlength: 20
            },
            userEmail: {
                required: true,
                email: true
            }
        },
        messages: {
            username: {
                required: "Bạn cần nhập tài khoản",
                maxlength: "Tài khoản có tối đa 20 ký tự"
            },
            userEmail: {
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

    $('#to-recover').click(function () {
        $("#login_form").hide();
        $("#recover_form").fadeIn();
    });
    $('#to-login').click(function () {
        $("#recover_form").hide();
        $("#login_form").fadeIn();
    });

    if ($.browser.msie == true && $.browser.version.slice(0, 3) < 10) {
        $('input[placeholder]').each(function () {

            var input = $(this);

            $(input).val(input.attr('placeholder'));

            $(input).focus(function () {
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });

            $(input).blur(function () {
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                }
            });
        });

    }
});