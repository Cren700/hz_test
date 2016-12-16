if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Pwd = (function() {
    function _init(){
        $('input, textarea').placeholder();
        $('#form').validate({
            submitHandler:function(form){
                $('.js-btn-submit').attr('disabled', true);
                HZ.Form.btnSubmit({
                    t: 'post',
                    u: $(form).attr('action'),
                    e: $(form),
                    callback: function(){
                        $('.js-btn-submit').attr('disabled', false);
                    }
                })
            },
            rules:{
                passwd:{
                    required:true,
                    minlength:6,
                    maxlength:16
                },
                new_passwd:{
                    required:true,
                    minlength:6,
                    maxlength:16
                },
                re_passwd:{
                    required:true,
                    minlength:6,
                    maxlength:16,
                    equalTo:"#new_passwd"
                }
            },
            messages: {
                passwd : {required:'请输入原密码', minlength: '原密码最少6位', maxlength: '原密码不超过16位'},
                new_passwd : {required:'请输入新密码', minlength: '新密码最少6位', maxlength: '新密码不超过16位'},
                re_passwd : {required:'请输入确认密码', minlength: '确认密码最少6位', maxlength: '确认密码不超过16位', equalTo: '两次密码不一致'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
            }
        });
    }


    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Pwd.init();
})