if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_login = (function() {
    function _init(){

        //选择角色登陆
        $('.mid a').each(function(index){
            $(this).on('click', function () {
                $('.wrapRole').hide();
                var type = $(this).attr('ref');
                $('#js-type').val(type);
            });
        });

        $('.login_regit_wechat').on('click', function(){
            window.location= baseUrl+ '/account/logwx.html?type=' + $('#js-type').val();
        });

        $('#loginform').submit(function(e){
            if (!checkVC()) {
                HZ.Dialog.showMsg({title: '请输入验证码'});
                return false;
            }
            e.preventDefault();
            var name = $('input[name="user_id"]').val();
            var passwd = $('input[name="passwd"]').val();
            var uri = $('input[name="url"]').val();
            var url = $('#js-btn-login').data('pwd-url');
            var type = $('#js-type').val();
            $.ajax({
                data:{user_id: name, passwd: passwd, url: uri, type: type},
                url: url,
                dataType: 'json',
                type: 'post',
                success: function(res){
                    if(typeof res['code'] === 'undefined' || res['code'] !== 0) {
                        HZ.Dialog.showMsg({title: res.msg});
                        setTimeout(function(){
                            location.href = location.href;
                        }, 2000)
                    } else {
                        window.location = res['data']['url'];
                    }
                }
            })
        });

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
    HZ.Account_login.init();
})