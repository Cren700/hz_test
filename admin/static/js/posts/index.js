if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Posts = (function() {
    function _init(){
        // 获取列表
        _getList();

        $('.datepicker').datepicker();

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
                    msg: '没有选择要删除的资讯'
                });
                return false;
            }
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否批量删除资讯?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/posts/batchDelPosts.html';
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
            var url = baseUrl + '/posts/status.html';
            var status = _this.data('status');
            var id = _this.parents('tr').attr('rel');
            var data = {status: status, pid: id};
            if (status == 2) {
                submitMsg(id);
            } else {
                HZ.Form.btnSubmit({
                    t: 'post',
                    u: url,
                    e: _this,
                    d: data,
                    callback: function () {
                        var _p = _this.parent();
                        var s1 = '\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">不通过</button>\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">通过</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                        var s2 = '\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="1">提交审核</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                        var s3 = '\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="4">下架</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                        var s4 = '<button class="btn btn-warning btn-mini js-btn-status" data-status="1">提交审核</button><button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                        switch (status) {
                            case 1:
                                _this.parents('tr').find('.js-posts-status').text('待审核');
                                _p.html(s1);
                                break;
                            case 2:
                                _this.parents('tr').find('.js-posts-status').text('不通过');
                                _p.html(s2);
                                break;
                            case 3:
                                _this.parents('tr').find('.js-posts-status').text('通过');
                                _p.html(s3);
                                break;
                            case 4:
                                _this.parents('tr').find('.js-posts-status').text('已下架');
                                _p.html(s4);
                                break;
                            default:
                                break;
                        }
                    }
                })
            }
        });

        $(document).on('click', '.js-btn-delete', function() {
            var _this = $(this);
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否删除该资讯?",
                type: 'confirm',
                btnConfirm: function(){

                    var url = baseUrl + '/posts/status.html';
                    var data = {is_del: 1,status: 1, pid: _this.parents('tr').attr('rel')};
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

        $(document).on('click', '.js-btn-recycle', function() {
            var _this = $(this);
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否还原该资讯?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/posts/status.html';
                    var data = {is_del: 0, pid: _this.parents('tr').attr('rel')};
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

        $('.js-btn-submit').on('click', function(e) {
            e.preventDefault();
            _getList();
        });

        // 查看审核原因
        $(document).on('click', '.checkNotApproved', function() {
            var remark = $(this).siblings('p').text();
            HZ.Dialog.showMsg({
                title: '审核备注信息',
                msg: remark,
                type: 'confirm',
                btnConfirm: function(){}
            });
        })
    }

    function _getList(p){

        var post_title = $('input[name="post_title"]').val(),
            post_author = $('input[name="post_author"]').val(),
            cate_id = $('select[name="category_id"]').val(),
            post_status = $('select[name="post_status"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            is_del = $('input[name="is_del"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/posts/query',
            data: {p: p, post_title: post_title, post_author:post_author, category_id: cate_id, post_status: post_status, min_date: min_date, max_date: max_date, is_del: is_del},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#posts-list-content').html()) {
                    $('#posts-list-content').html(res);
                }
            }
        });
    }

    function submitMsg(id) {
        HZ.Dialog.submitMsg({
            title: '系统提示 -- 填写不通过原因',
            btnConfirm: function(){
                var url = baseUrl + '/posts/notApproved.html';
                var data = {id: id, remark: $('#msg_content').val()};
                HZ.Form.btnSubmit({
                    t: 'post',
                    u: url,
                    d: data,
                    r: false,
                    callback: function () {
                        location.reload();
                    }
                });
            }
        });
        return true;
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Posts.init();
})