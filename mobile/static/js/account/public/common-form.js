if (typeof (YPAPP) == "undefined" || !YPAPP) {
    var YPAPP = {}
}

YPAPP.Register = (function () {
    function init(){
        _formSubmit();
    }

    function _formSubmit(){
        $('#form').submit(function(e) {
            e.preventDefault();
            var $vc = $("input[name='vc']");
            var url = $(this).attr('action');
            var flag = true;

            if (typeof($vc.val()) !== 'undefined') {
                if ($.trim($("input[name='vc']").val()) == '') {
                    YPAPP.Dialog.showMsg({
                        type: 'warm',
                        msg: '请输入验证码',
                    });
                    return false;
                } else {
                    $.ajax({
                        async: false,
                        url: "/login/checkVC.html?vc=" + $vc.val(),
                        dataType: 'json',
                        type: 'post',
                        success: function (res) {
                            if (res.code !== 0) {
                                YPAPP.Dialog.showMsg({
                                    type: 'warm',
                                    msg: res.msg
                                });
                                flag = false;
                                return false;
                            }
                        },
                        error: function (){
                            YPAPP.Dialog.showMsg({
                                type: 'warm',
                                msg: "都是程序员的锅!抱歉,出错了!"
                            });
                            return false;
                        }
                    })
                }
            }
            if (flag) {
                YPAPP.Form.btnSubmit($(this), url);
            }
        })
    }

    return {
        init: init
    };
})();

$(document).ready(function(){
    YPAPP.Register.init();
})