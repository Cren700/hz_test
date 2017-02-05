if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostCate = (function() {
    function _init(){
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
                partners_id: {
                    required:true
                },
                partners_name:{
                    required:true
                }
            },
            messages: {
                partners_id: '请输入编号',
                partners_name : '请输入名称'
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
    HZ.PostCate.init();
})