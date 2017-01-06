if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Promo = (function() {
    function _init(){

        $('.datepicker').datepicker();

        // 获取列表
        _getList();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
        });

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/promo/status.html';
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
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">使用</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s2 = '\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">禁用</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    switch (status){
                        case 0:
                            _this.parents('tr').find('.js-promo-status').text('禁用');
                            _p.html(s1);
                            break;
                        case 1:
                            _this.parents('tr').find('.js-promo-status').text('启用');
                            _p.html(s2);
                            break;
                        default:
                            break;
                    }
                }
            })
        });

        $(document).on('click', '.js-btn-delete', function() {
            var _this = $(this);
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否删除该广告?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/promo/del.html';
                    var data = {is_del: 1, id: _this.parents('tr').attr('rel')};
                    HZ.Form.btnSubmit({
                        t: 'get',
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

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });

    }

    function _getList(p){

        var active_name = $('input[name="active_name"]').val(),
            cate_id = $('select[name="category_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            status = $('select[name="status"]').val() || $('input[name="status"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/promo/query',
            data: {p: p, active_name: active_name, category_id: cate_id, min_date: min_date, max_date: max_date, status: status},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#promo-list-content').html()) {
                    $('#promo-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Promo.init();
})