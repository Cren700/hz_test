if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserQuery = (function() {
    function _init(){
        // 获取列表
        _getList();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
        });

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/user/freebackStatus.html';
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
                            _this.removeClass().addClass('btn btn-primary btn-mini js-btn-status').data('status', 1).text('已处理');
                            _this.parents('tr').find('.js-user-status').text('未处理');
                            break;
                        case 1:
                            _this.removeClass().addClass('btn btn-danger btn-mini js-btn-status').data('status', 0).text('未处理');
                            _this.parents('tr').find('.js-user-status').text('已处理');
                            break;
                        default:
                            break;
                    }
                }
            })
        });
    }

    function _getList(p){
        var p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/user/queryFreeback',
            data: {p: p},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#users-list-content').html()) {
                    $('#users-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.UserQuery.init();
})