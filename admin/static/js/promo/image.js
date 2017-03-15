if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Promo = (function() {
    function _init(){

        // 获取列表
        _getList();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
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
                    msg: '没有选择要删除的广告'
                });
                return false;
            }
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否批量删除广告?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/promo/batchDelPromo.html';
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

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            var url = baseUrl + '/promo/imageStatus.html';
            var status = _this.data('status');
            var data = {status: status, id: _this.parents('tr').attr('rel')};
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
                            _this.parents('tr').find('.js-promo-status').text('使用');
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
                msg: "是否删除图片信息?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/promo/delImage.html';
                    var data = {id: _this.parents('tr').attr('rel')};
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

        var p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/promo/queryImage',
            data: {p: p},
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