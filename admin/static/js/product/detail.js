if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductDetail = (function() {
    function _init(){
        $('input, textarea').placeholder();

        $('#form').validate({
            submitHandler:function(form){
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
                product_name:{
                    required:true
                },
                category_id:{
                    required:true,
                    digits: true
                },
                product_num:{
                    required:true,
                    min: 0,
                    digits: true
                },
                product_price:{
                    required:true
                }
            },
            messages: {
                product_name : '请输入产品名称',
                category_id : {required:'请选择产品分类',digits: '必须是整数'},
                product_num : {required:'请输入库存数量', min:'库存不小于0',digits: '库存数量必须是整数'},
                product_price : '请输入产品价格'
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
    HZ.ProductDetail.init();
})