if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Posts = (function() {
    function _init(){
        // 获取列表
        _getList();

        $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            var p = $(this).attr('data-ci-pagination-page');
            _getList(p);
        });

        $(document).on('click', '.js-btn-status', function () {
            var _this = $(this);
            _this.parent('td').find('.js-btn-submit').show();
            _this.hide();
            var num = _this.parents("tr").find('.js-txt-num').text();
            _this.parents("tr").find('.js-txt-num').html("<input type='text' name='num' value='"+num+"'>");
        });

        $(document).on('click', '.js-btn-submit', function() {
            var _this = $(this);
            var _tr = _this.parents('tr');
            var url = baseUrl + '/posts/modifyEvent.html';
            var num = _tr.find('input[name="num"]').val();
            num = isNaN(parseInt(num, 10)) ? 0 : parseInt(num, 10);
            var data = {id: _tr.attr('rel'), num: num};
            HZ.Form.btnSubmit({
                t: 'post',
                u: url,
                e: _this,
                d: data,
                callback: function(){
                    _tr.find('.js-txt-num').text(num);
                    _tr.find('.js-btn-status').show();
                    _this.hide();
                }
            })
        });

        $(document).on('click', '.js-btn-delete', function() {
            var _this = $(this);
            HZ.Dialog.showMsg({
                title: '系统提示',
                msg: "是否删除该行业信息?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/posts/delEvent.html';
                    var data = {id: _this.parents('tr').attr('rel')};
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

        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/posts/queryEvents',
            data: {p: p},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#posts-list-content').html()) {
                    $('#posts-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Posts.init();
})