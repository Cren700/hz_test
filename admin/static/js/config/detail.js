if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {
    function _init(){
        $('input, textarea').placeholder();

        _form();

        _ueditir();

        $(document).ready(function(){
            $('.js-btn-submit').attr('disabled', false);
        })
    }

    function _form()
    {
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

    function _ueditir()
    {
        var $content = $('#ud-content');
        var ue = UE.getEditor('ud-content', {
            autoHeightEnabled: true,
            autoFloatEnabled: true,
        });

        // 初始化数据
        ue.ready(function() {
            ue.setContent($content.val());
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PostsDetail.init();
})