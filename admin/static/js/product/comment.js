if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Comment = (function() {
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
            var url = baseUrl + '/product/statusComment.html';
            var status = _this.data('status');
            var data = {status: status, comment_id: _this.parents('tr').attr('rel')};
            HZ.Form.btnSubmit({
                t: 'post',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    var _p = _this.parent();
                    var s1 = '\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">通过审核</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s2 = '\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">审核不通过</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    switch (status){
                        case 0:
                            _this.parents('tr').find('.js-comment-status').text('禁用');
                            _p.html(s1);
                            break;
                        case 1:
                            _this.parents('tr').find('.js-comment-status').text('启用');
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
                msg: "是否删除该评论?",
                type: 'confirm',
                btnConfirm: function(){

                    var url = baseUrl + '/product/delComment.html';
                    var data = {comment_id: _this.parents('tr').attr('rel')};
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

    }

    function _getList(p){

        var pro_id = $('input[name="pro_id"]').val(),
            author_name = $('input[name="author_name"]').val(),
            comment_approved = $('select[name="comment_approved"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/product/queryComment',
            data: {p: p, pro_id: pro_id, author_name:author_name, comment_approved: comment_approved, min_date: min_date, max_date: max_date},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#comment-list-content').html()) {
                    $('#comment-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Comment.init();
})