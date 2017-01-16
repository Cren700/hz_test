if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_register = (function() {
    function _init(){

        $('#form').submit(function(e){
            e.preventDefault();
            var name = $('input[name="user_id"]').val();
            var passwd = $('input[name="passwd"]').val();
            var url = $('#js-btn-register').data('register-url');
            $.ajax({
                data:{user_id: name, passwd: passwd},
                url: url,
                dataType: 'json',
                type: 'post',
                success: function(res){
                    if(typeof res['code'] === 'undefined' || res['code'] !== 0) {
                        alertInfo(res.msg);
                    } else {
                        alertInfo('注册成功了');
                        setTimeout(function () {
                            window.location = res['data']['url'];
                        }, 3000);
                    }
                }
            })
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Account_register.init();
})