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

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/user/changeStatus.html';
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
                            _this.parents('tr').find('.js-user-status').text('删除');
                            break;
                        case 1:
                            _this.removeClass().addClass('btn btn-danger btn-mini js-btn-status').data('status', 0).text('删除');
                            _this.parents('tr').find('.js-user-status').text('使用中');
                            break;
                        default:
                            break;
                    }
                }
            })
        });


        $(document).on('click', '.js-btn-atte-status', function () {
            var _this = $(this);
            var url = baseUrl + '/user/changeStatus.html';
            var status = _this.data('status');
            var data = {atte_status: status, id: _this.parents('tr').attr('rel')};
            HZ.Form.btnSubmit({
                t: 'get',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    switch (status){
                        case 0:
                            _this.removeClass().addClass('btn btn-primary btn-mini js-btn-atte-status').data('status', 1).text('通过认证');
                            _this.parents('tr').find('.js-user-atte-status').text('未认证');
                            break;
                        case 1:
                            _this.removeClass().addClass('btn btn-danger btn-mini js-btn-atte-status').data('status', 0).text('取消认证');
                            _this.parents('tr').find('.js-user-atte-status').text('已认证');
                            break;
                        default:
                            break;
                    }
                }
            })
        });

        $(document).on('click', '.js-btn-black', function (){
            var _this = $(this);
            var url = baseUrl + '/user/changeStatus.html';
            var data = {is_blackuser: 1, id: _this.parents('tr').attr('rel')};
            HZ.Form.btnSubmit({
                t: 'get',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    _this.parents('tr').remove();
                }
            })
        });

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });
    }

    function _getList(p){

        var user_type = $('input[name="user_type"]').val(),
            user_id = $('input[name="user_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            status = $('select[name="status"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/user/query',
            data: {p: p, user_type: user_type, status: status, user_id: user_id, min_date: min_date, max_date: max_date},
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