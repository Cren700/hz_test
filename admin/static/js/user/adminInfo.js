if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserInfo = (function() {
    function _init(){
        $('input, textarea').placeholder();

        $('.js-btn-return').on('click', function(){
            window.location.href = history.go(-1);
        });

        $('#js-btn-reset').on('click', function(){
            var id = $("input[name='id']").val();
            var passwd = $("input[name='passwd']").val();
            var data = {id: id, passwd: passwd};
            $.ajax({
                data: data,
                dataType: 'json',
                type: 'post',
                url: baseUrl+"/user/updateAdminPwd",
                success: function(res){
                    if (res.code == 0) {
                        HZ.Dialog.showMsg({
                            msg: '修改成功',
                        });
                    }
                }
            })
        });

        $('#js-btn-submit').on('click', function(){
            var id = $("input[name='id']").val();
            var role_id = $("select[name='role_id']").val();
            var data = {id: id, role_id: role_id};
            $.ajax({
                data: data,
                dataType: 'json',
                type: 'post',
                url: baseUrl+"/user/updateAdminRole",
                success: function(res){
                    if (res.code == 0) {
                        HZ.Dialog.showMsg({
                            msg: '修改成功',
                        });
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
    HZ.UserInfo.init();
})