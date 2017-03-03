if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_phone = (function() {
    function _init(){

        var countdown = 120;

        $('#js-btn-send-sms').on('click', function () {
            sendSms($(this));
        });

        //选择角色登陆
        $('.mid a').each(function(index){
            $(this).on('click', function () {
                $('.wrapRole').hide();
                var type = $(this).attr('ref');
                $('#js-type').val(type);
            });
        });

        $('#loginform').submit(function(e){
            e.preventDefault();
            if (!checkVC()) {
                alertInfo("请输入正确的验证码", function () {
                    $(".img_yanzheng").focus();
                });
                return false;
            }
            var name = $('input[name="user_id"]').val();
            var code = $('input[name="phoneyanz"]').val();
            var type = $('#js-type').val();
            var url = $('#js-btn-login').data('pwd-url');
            $.ajax({
                data:{user_id: name, code: code, type: type},
                url: url,
                dataType: 'json',
                type: 'post',
                success: function(res){
                    if(typeof res['code'] === 'undefined' || res['code'] !== 0) {
                        alertInfo(res.msg + ',请重新登录');
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000)
                    } else {
                        window.location = res['data']['url'];
                    }
                }
            })
        });

        function sendSms(obj) {
            var phone =  $.trim($('.phone_t').val());
            if (!phone) {
                HZ.Dialog.showMsg({title: '请输入手机码号'});
                return false;
            }
            var repg = /^(13[0-9]|15[0|1|3|6|7|8|9]|18[8|9])\d{8}$/;
            if (repg.test(phone)) {
                if (!checkVC()) {
                    alertInfo("请输入正确的验证码", function () {
                        $(".img_yanzheng").focus();
                    });
                    return false;
                }

                var url = baseUrl+'/account/sendSms.html?phone='+phone;
                $.get(url, {}, function(res){
                    if (res.code == 0) {
                        $('#js-txt-show-tips').text('一条包含有验证码的短信已经发送至手机：'+phone.substr(0,3)+"****"+phone.substr(-4));
                        settime(obj);
                    } else {
                        alertInfo(res.msg);
                    }
                }, 'json')
            } else {
                checkVC();
                HZ.Dialog.showMsg({title: '请输入正确的手机码号'});
            }
        }

        function settime(obj) {
            if (countdown == 0) {
                obj.attr({"disabled":false}).css({"background-color": "#197dd2"});
                obj.val("发送验证码");
                $('#js-txt-show-tips').text('');
                countdown = 120;
                return;
            } else {
                obj.attr({"disabled":true}).css({"background-color": "#999"});
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