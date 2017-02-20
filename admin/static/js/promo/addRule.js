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