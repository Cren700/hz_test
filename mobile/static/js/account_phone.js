if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_phone = (function() {
    function _init(){

        var countdown = 10;

        $('#sendCode').on('click', function () {
            sendSms($(this));
        });

        $('#loginform').submit(function(e){
            if (!checkVC()) {
                HZ.Dialog.showMsg({title: '请输入正确的验证码'});
                return false;
            }
            e.preventDefault();
            var name = $('input[name="user_id"]').val();
            var code = $('input[name="code"]').val();
            var url = $('#js-btn-login').data('pwd-url');
            $.ajax({
                data:{user_id: name, code: code},
                url: url,
                dataType: 'json',
                type: 'post',
                success: function(res){
                    if(typeof res['code'] === 'undefined' || res['code'] !== 0) {
                        HZ.Dialog.showMsg({title: res.msg});
                    } else {
                        window.location = res['data']['url'];
                    }
                }
            })
        });

        function sendSms(obj) {
            var phone =  $.trim($('#phoneNumber').val());
            if (!phone) {
                HZ.Dialog.showMsg({title: '请输入手机码号'});
                return false;
            }
            var repg = /^(13[0-9]|15[0|1|3|6|7|8|9]|18[8|9])\d{8}$/;
            if (repg.test(phone)) {
                if (!checkVC()) {
                    alertInfo("请输入正确的验证码", function () {
                        $(".login_regit_phoneTxt").focus();
                    });
                    return false;
                }

                var url = baseUrl+'/account/sendSms.html?phone='+phone;
                $.get(url, {}, function(res){
                    if (res.code == 0) {
                        HZ.Dialog.showMsg({title: '一条包含有验证码的短信已经发送至手机：'+phone.substr(0,3)+"****"+phone.substr(-4)});
                        settime(obj);
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                    }
                }, 'json')
            } else {
                checkVC();
                HZ.Dialog.showMsg({title: '请输入正确的手机码号'});
            }
        }

        function settime(obj) {
            if (countdown == 0) {
                obj.attr({"disabled":false}).css({"color": "#000"});
                obj.val("发送验证码");
                countdown = 120;
                return;
            } else {
                obj.attr({"disabled":true}).css({"color": "#999"});
                obj.val("重新发送(" + countdown + ")");
                countdown--;
            }
            setTimeout(function () {
                    settime(obj)
                }
                , 1000)
        }

        // 验证码
        function checkVC(){
            var flag = false;
            if ($('#js-vc-code').val()) {
                var vc = $('#js-vc-code').val();
                var url = baseUrl + "/account/checkVC.html";
                $.ajax({
                    data:{vc: vc},
                    url: url,
                    dataType: 'json',
                    type: 'get',
                    async: false,
                    success: function(res){
                        // 验证码不正确
                        if(typeof res['code'] === 'undefined' || res['code'] != 0) {
                            var now = new Date();
                            HZ.Dialog.showMsg({title: res.msg});
                            $("#js-vc-img").attr('src', baseUrl + "/account/getVC.html?="+ now.getTime());
                            flag = false;
                        } else {
                            flag = true;
                        }
                    }
                })
            } else {
                flag = false;
            }
            return flag;
        }
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Account_phone.init();
})