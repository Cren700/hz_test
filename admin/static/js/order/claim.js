if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Order = (function() {
    function _init(){
        // 获取列表
        _getList();

        $('.datepicker').datepicker();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
        });

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });

        $(document).on('click', '.js-btn-cancel, .js-btn-success', function() {
            var _this = $(this);
            var _str = '是否处理订单?';
            var _changeStatus = '处理中';
            if(!_this.hasClass('js-btn-cancel')) {
                _str = '订单确定已经完成了吗?';
                _changeStatus = '已完成';
            }
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: _str,
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/order/claimOrderStatus.html';
                    var status = _this.data('status');
                    var data = {status: status, id: _this.parents('tr').attr('rel')};
                    HZ.Form.btnSubmit({
                        t: 'post',
                        u: url,
                        e: _this,
                        d: data,
                        callback: function(){
                            _this.parents('tr').find('.js-order-status').text(_changeStatus);
                            _this.parent('td').children().remove();
                        }
                    });
                }
            });
        });
    }

    function _getList(p){

        var order_no = $('input[name="order_no"]').val(),
            user_id = $('input[name="user_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            status = $('select[name="status"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/order/queryClaim',
            data: {p: p, min_date: min_date, max_date: max_date, order_no: order_no, user_id: user_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#order-list-content').html()) {
                    $('#order-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Order.init();
})