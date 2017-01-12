if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Account_pwd = (function() {
    function _init(){

        $('#form').submit(function(e){
            e.preventDefault();
            var passwd = $('input[name="passwd"]').val();
            var new_passwd = $('input[name="new_passwd"]').val();
            var re_passwd = $('input[name="re_passwd"]').val();
            var url = $('#js-btn-pwd').data('pwd-url');
            $.ajax({
                data:{passwd: passwd,new_passwd: new_passwd,re_passwd: re_passwd},
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
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Account_pwd.init();
})