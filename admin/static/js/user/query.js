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
            var url = baseUrl + '/posts/status.html';
            var status = _this.data('status');
            var data = {status: status, pid: _this.parents('tr').attr('rel')};
            HZ.Form.btnSubmit({
                t: 'post',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    var _p = _this.parent();
                    var s1 = '\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">审核不通过</button>\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="2">发布</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s2 = '\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">提交审核</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s3 = '\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="3">下架</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s4 = '<button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    switch (status){
                        case 0:
                            _this.parents('tr').find('.js-posts-status').text('待审核');
                            _p.html(s1);
                            break;
                        case 1:
                            _this.parents('tr').find('.js-posts-status').text('审核不通过');
                            _p.html(s2);
                            break;
                        case 2:
                            _this.parents('tr').find('.js-posts-status').text('已发布');
                            _p.html(s3);
                            break;
                        case 3:
                            _this.parents('tr').find('.js-posts-status').text('已发布');
                            _p.html(s4);
                            break;
                        default:
                            break;
                    }
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