if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_login = (function() {
    function _init(){
        //选择角色登陆
        $('.mid a').each(function(index){
            $(this).on('click', function () {
                $('.wrapRole').hide();
                $('.login_content').show();
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
            var passwd = $('input[name="passwd"]').val();
            var type = $('#js-type').val();
            var url = $('#js-btn-login').data('pwd-url');
            $.ajax({
                data:{user_id: name, passwd: passwd, type: type},
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