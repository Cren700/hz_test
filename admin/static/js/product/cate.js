if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductCate = (function() {
    function _init(){

        // 禁止操作
        if ($('#js-do-val').val() == 1) {
            $('body textarea, body select, body input').attr('disabled', true);
        }

        $('#form').validate({
            submitHandler:function(form){
                HZ.Form.btnSubmit({
                    t: 'post',
                    u: $(form).attr('action'),
                    e: $(form)
                })
            },
            rules:{
                category_name:{
                    required:true
                }
            },
            messages: {
                category_name : '请输入分类名称'
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
    HZ.ProductCate.init();
})