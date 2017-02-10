if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.UserQuery = (function() {
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

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/user/changeAdminStatus.html';
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
                            _this.parents('tr').find('.js-user-status').text('禁用');
                            break;
                        case 1:
                            _this.removeClass().addClass('btn btn-danger btn-mini js-btn-status').data('status', 0).text('禁用');
                            _this.parents('tr').find('.js-user-status').text('使用中');
                            break;
                        default:
                            break;
                    }
                }
            })
        });
    }

    function _getList(p){
        var user_id = $('input[name="user_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/user/adminList',
            data: {p: p, user_id: user_id, min_date: min_date, max_date: max_date},
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