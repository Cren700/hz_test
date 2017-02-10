if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserInfo = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        $('.js-btn-return').on('click', function(){
            window.location.href = history.go(-1);
        });

        function _form() {
            $('#form').validate({
                submitHandler: function (form) {
                    var role_id = $('input[name="role_id"]:checked').val();
                    if(!role_id) {
                        HZ.Dialog.showMsg({
                            msg: "用户类型不能为空哦",
                            type: 'warm'
                        });
                        return false;
                    }
                    // 手动判断证件照片是否上传
                    $('.js-btn-submit').attr('disabled', true);
                    HZ.Form.btnSubmit({
                        t: 'post',
                        u: $(form).attr('action'),
                        e: $(form),
                        callback: function () {
                            $('.js-btn-submit').attr('disabled', false);
                        }
                    })
                },
                rules: {
                    user_id: {
                        required: true
                    },
                    passwd: {
                        required: true
                    }
                },
                messages: {
                    user_id: {required: '用户名称'},
                    passwd: {required: '用户密码'}
                },
                errorClass: "help-inline",
                errorElement: "span",
                highlight: function (element, errorClass, validClass) {
                    $(element).parents('.control-group').addClass('error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents('.control-group').removeClass('error');
                }
            });
        }
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.UserInfo.init();
})