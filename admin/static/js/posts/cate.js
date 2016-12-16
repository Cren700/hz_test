if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Cate = (function() {
    function _init(){
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
    HZ.Cate.init();
})