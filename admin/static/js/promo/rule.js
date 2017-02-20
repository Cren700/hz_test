if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostCateStatus = (function() {
    function _init(){
        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/promo/ruleStatus.html';
            var status = _this.data('status');
            var data = {status: status, id: _this.parents('tr').attr('rel')};
            HZ.Form.btnSubmit({
                t: 'get',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    switch (status){
                        case 0:
                            _this.removeClass().addClass('btn btn-primary btn-mini js-btn-status').data('status', 1).text('启用');
                            _this.parents('tr').find('.js-status').text('禁用');
                            break;
                        case 1:
                            _this.removeClass().addClass('btn btn-danger btn-mini js-btn-status').data('status', 0).text('禁用');
                            _this.parents('tr').find('.js-status').text('启用');
                            break;
                        default:
                            break;
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
    HZ.PostCateStatus.init();
})