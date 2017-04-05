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

        // 批量选择
        $(document).on('click', '#bacth_selected', function (e) {
            var v = $(this).attr('checked') === 'checked' ? 'checked' : false;
            $('.js-checkbox-sub').each(function(){
                $(this).attr('checked', v);
            })
        });

        // 确认批量删除
        $('.js-btn-batch-del').on('click', function(){
            var ids = [];
            $('.js-checkbox-sub').each(function(){
                if ($(this).is(':checked')) {
                    var pid = $(this).attr('ref');
                    ids.push(pid);
                }
            });
            if (ids.length === 0) {
                HZ.Dialog.showMsg({
                    title: '系统提示',
                    type: 'warm',
                    msg: '没有选择要删除的用户'
                });
                return false;
            }
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否批量删除用户?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/user/batchDelUser.html';
                    var data = {ids: ids};
                    HZ.Form.btnSubmit({
                        t: 'post',
                        u: url,
                        d: data,
                        callback: function(){
                            location.reload();
                        }
                    });
                }
            });
        });

        $(document).on('click', '.js-btn-unblack', function (){
            var _this = $(this);
            var url = baseUrl + '/user/changeStatus.html';
            var data = {is_blackuser: 0, id: _this.parents('tr').attr('rel')};
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
    }

    function _getList(p){

        var user_type = $('select[name="user_type"]').val(),
            user_id = $('input[name="user_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/user/queryBlackList',
            data: {p: p, user_type: user_type, user_id: user_id, min_date: min_date, max_date: max_date},
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