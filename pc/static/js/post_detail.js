if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {
    
    function _init() {
        $(".weibo").on("click",function(){
            $(this).socialShare("sinaWeibo");
        });
        $(".qzone").on("click",function(){
            $(this).socialShare("qZone");
        });
        $('.wefriend').on('click', function(){
            var scrollTop = $(this).scrollTop();
            var scrollHeight = $(document).height();
            var width = $(document).width();
            if (scrollTop+600 < scrollHeight) {
                $('#bdshare_weixin_qrcode_dialog').css({top:scrollTop+200, left: width/2 - 200});
            }
            $('#bdshare_weixin_qrcode_dialog').show();
        });

        $(".pinglun").on('click', function () {
            var com_top = $(".com_h").offset().top;
            $("html body").animate({ scrollTop: com_top + 1500 }, 200);
        });

        $(window).scroll(function () {
            _scroll();
        })

        submitComment();

        clickPraise();

        $('.bd_weixin_popup_close').on('click', function(){
            $('#bdshare_weixin_qrcode_dialog').hide();
        });
    }



    //二维码滚动
    function _scroll()
    {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var width = $(document).width();
        if (scrollTop+700 < scrollHeight) {
            $('#bdshare_weixin_qrcode_dialog').css({top:scrollTop+200, left: width/2 - 200});
        }
    }

    function submitComment()
    {
        $('#js-btn-send').on('click', function(){
            if (!HZ.ISLOGIN.init()) {
                return false;
            }
            $('.comment_publish').addClass('hide');
            $(".comment_quantity").removeClass("hide");
            var content = $('#txtContent').val();
            var post_id = $('input[name="pid"]').val();
            if (!content) {
                HZ.Dialog.showMsg({title: '评论内容不能为空!'});
                return false;
            } else if(!post_id) {
                HZ.Dialog.showMsg({title: '操作出错啦,请刷新重试!'});
                return false;
            }
            $.ajax({
                data: {content: content, post_id: post_id},
                dataType: 'json',
                type: 'post',
                url: baseUrl+ '/posts/submitComment.html',
                success: function (res) {
                    if (res.code == 0) {
                        HZ.Dialog.showMsg({title: '评论成功,等待审核!'});
                        $('#txtContent').val('');
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                    }
                }
            });
        });
    }


    function clickPraise()
    {
        $('#js-btn-praise').on('click', function(){
            if (!HZ.ISLOGIN.init()) {
                return false;
            }

            var url = baseUrl + "/posts/doPraise.html";
            var post_id = $('input[name="pid"]').val();
            var _this = $(this);
            $.ajax({
                data: {post_id: post_id},
                dataType: 'json',
                type: 'post',
                url: url,
                success: function (res) {
                    if (res.code == 0) {
                        var _btn_c = $('#js-txt-praise-count');
                        var _c = parseInt(_btn_c.text());
                        if (res.status == 0) {                                                     _c--;
                            HZ.Dialog.showMsg({title: '取消收藏成功'});
                        } else {
                            _c++;
                            HZ.Dialog.showMsg({title: '加入收藏成功'});
                        }
                        _btn_c.text(_c);
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
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