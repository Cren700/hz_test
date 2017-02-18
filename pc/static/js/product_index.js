if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.ProductIndex = (function() {
    var p = 1;
    var flag = true;
    var collect = $('input[name="collect"]').val() ? $('input[name="collect"]').val() : '';
    collect = collect.split(',');
    function _init(){

        // 获取列表
        _getList(p);

        p++;

        $(window).scroll(function () {
            _scroll();
        });

        $(".pro_info_dd").find("a").on('mouseover',function(){
            $(this).parent().hide().siblings().show()
        })
        $(".pro_info_jj").children(".pro_info_jj_img").on('mouseleave',function(){
            $(this).parent().hide().siblings().show()
        });

        // 关注
        $(document).on('click', '.product_like', function(){
            var pid = $(this).data('pid').toString();
            var _this = $(this);
            $.ajax({
                url: baseUrl+'/shop/collect.html',
                data: {pid: pid},
                dataType: 'json',
                type: 'GET',
                success: function(res){
                    if (res.code == 0)
                    {
                        if (!_this.hasClass('liked')) {
                            _this.addClass('liked');
                            HZ.Dialog.showMsg({title: '成功关注'});
                        } else {
                            _this.removeClass('liked');
                            HZ.Dialog.showMsg({title: '取消关注'});
                        }
                    } else {
                        HZ.Dialog.showMsg({title: '出错啦!'+res.msg});
                    }
                }
            });
        });

    }

    function _getList(p){

        var cate_id = $('input[name="cate_id"]').val();
        $.ajax({
            url: baseUrl+'/product/getProductList.html',
            data: {p: p, category_id: cate_id, status: status},
            dataType: 'HTML',
            type: 'GET',
            async: false,
            success: function(res){
                if(res === '') {
                    flag = false;
                    return false;
                }
                $('.tab_list').append(res);
                flag = true;

                // 判断是否收藏
                $('.product_like').each(function(){
                    var pid = $(this).data('pid').toString();
                    if ($.inArray(pid, collect) != -1) {
                        $(this).addClass('liked');
                    }
                });
            }
        });
    }

    function _scroll()
    {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        var re_hegith = 200;
        if (scrollTop + windowHeight + re_hegith * 2 > scrollHeight) {
            if (flag) {
                flag = false;
                _getList(p);
                p++;
            }
        }
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.ProductIndex.init();
})