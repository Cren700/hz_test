if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.Product = (function() {
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
            var url = baseUrl + '/product/status.html';
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
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">上架</button>\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">下架</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s2 = '\
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">下架</button>\
                        <button class="btn btn-success btn-mini js-btn-status" data-status="4">已完成</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s3 = '\
                        <button class="btn btn-info btn-mini js-btn-status" data-status="1">审核不通过</button>\
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">上架</button>\
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    var s4 = '<button class="btn btn-danger btn-mini js-btn-delete">删除</button>';
                    switch (status){
                        case 1:
                            _this.parents('tr').find('.js-product-status').text('待审核');
                            _p.html(s1);
                            break;
                        case 2:
                            _this.parents('tr').find('.js-product-status').text('上架');
                            _p.html(s2);
                            break;
                        case 3:
                            _this.parents('tr').find('.js-product-status').text('下架');
                            _p.html(s3);
                            break;
                        case 4:
                            _this.parents('tr').find('.js-product-status').text('已完成');
                            _p.html(s4);
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
                msg: "是否删除该产品?可以再回收站中找回。",
                type: 'confirm',
                btnConfirm: function(){
                    
                    var url = baseUrl + '/product/status.html';
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
                msg: "是否还原该产品?",
                type: 'confirm',
                btnConfirm: function(){
                    var url = baseUrl + '/product/status.html';
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

    }

    function _getList(p){

        var product_name = $('input[name="product_name"]').val(),
            cate_id = $('select[name="category_id"]').val(),
            min_date = $('input[name="min_date"]').val(),
            max_date = $('input[name="max_date"]').val(),
            is_del = $('input[name="is_del"]').val(),
            status = $('select[name="status"]').val() || $('input[name="status"]').val();
        p = p ? p : 1;
        $.ajax({
            url: baseUrl+'/product/query',
            data: {p: p, product_name: product_name, category_id: cate_id, min_date: min_date, max_date: max_date, status: status, is_del: is_del},
            dataType: 'HTML',
            type: 'GET',
            success: function(res){
                if($('#product-list-content').html()) {
                    $('#product-list-content').html(res);
                }
            }
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.Product.init();
})