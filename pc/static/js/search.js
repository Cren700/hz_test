if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {

    function _init() {
        $('.search_btn').on('click', function(){
            var keyword = $(this).parent().find('.search_txt').val();
            if(!$.trim(keyword)) {
                HZ.Dialog.showMsg({title: '请输入搜索关键词'});
            } else {
                location.href = baseUrl+'/posts/search?keyword='+encodeURIComponent(keyword);
            }
        })

        $('#search_posts_btn').on('click', function(){
            var keyword = $('.search_jj').find('.search_txt').val();
            if(!$.trim(keyword)) {
                HZ.Dialog.showMsg({title: '请输入搜索关键词'});
            } else {
                location.href = baseUrl+'/posts/search?keyword='+encodeURIComponent(keyword);
            }
        });

        $('#search_product_btn').on('click', function(){
            var keyword = $('.search_jj').find('.search_txt').val();
            if(!$.trim(keyword)) {
                HZ.Dialog.showMsg({title: '请输入搜索关键词'});
            } else {
                location.href = baseUrl+'/product/search?keyword='+encodeURIComponent(keyword);
            }
        });

        $(".pro_info_dd").find("a").on('mouseover',function(){
            $(this).parent().hide().siblings().show()
        })
        $(".pro_info_jj").children(".pro_info_jj_img").on('mouseleave',function(){
            $(this).parent().hide().siblings().show()
        });


        var collect = $('input[name="collect"]').val() ? $('input[name="collect"]').val() : '';
        collect = collect.split(',');

        // 判断是否收藏
        $('.product_like').each(function(){
            var pid = $(this).data('pid').toString();
            if ($.inArray(pid, collect) != -1) {
                $(this).addClass('liked');
            }
        });

        $('.product_like').on('click', function(){
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

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PostsDetail.init();
})