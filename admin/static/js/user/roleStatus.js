if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.roleStatus = (function() {
    function _init(){
        $(document).on('click', '.js-btn-delete', function () {
            var _this = $(this);
            var url = baseUrl + '/user/delRole.html';
            var data = {id: _this.parents('tr').attr('rel')};

            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否删除角色?",
                type: 'confirm',
                btnConfirm: function(){
                    HZ.Form.btnSubmit({
                        t: 'get',
                        u: url,
                        d: data,
                        callback: function(){
                            // location.reload();
                        }
                    });
                }
            });
        });
    }


    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.roleStatus.init();
})