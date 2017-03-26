if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Posts = (function() {
    function _init(){

        $(document).on('click', '.js-btn-delete', function() {
            var _this = $(this);
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否删除该配置信息?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/conf/del.html';
                    var data = {id: _this.parents('tr').attr('rel')};
                    HZ.Form.btnSubmit({
                        t: 'post',
                        u: url,
                        e: _this,
                        d: data,
                        callback: function(){
                            _this.parents('tr').remove();
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
    HZ.Posts.init();
})