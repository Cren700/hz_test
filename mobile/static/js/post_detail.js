if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.PostsDetail = (function() {
    function _init(){
        $('#txtContent').on({
            focus: function(){
                $('.comment_publish').removeClass('hide');
                $(".comment_quantity").addClass("hide");
            },
            blur: function () {
                if ($(this).val()) {
                    $('.comment_publish').removeClass('hide');
                    $(".comment_quantity").addClass("hide");
                } else {
                    $('.comment_publish').addClass('hide');
                    $(".comment_quantity").removeClass("hide");
                }
            }
        });

        $('#js-btn-send').on('click', function(){
            if (!HZ.ISLOGIN.init()) {
                return false;
            }
            $('.comment_publish').addClass('hide');
            $(".comment_quantity").removeClass("hide");
            var content = $('#txtContent').val();
            var post_id = $('input[name="pid"]').val();
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
                        if(_this.find('i').hasClass('icon_com2'))
                        {
                            // 取消
                            _this.find('i').removeClass('icon_com2');
                            _c--;
                            _btn_c.text(_c);
                            HZ.Dialog.showMsg({title: '取消收藏成功'});
                        } else {
                            // 添加
                            _this.find('i').addClass('icon_com2');
                            _c++;
                            _btn_c.text(_c);
                            HZ.Dialog.showMsg({title: '加入收藏成功'});
                        }
                    } else {
                        HZ.Dialog.showMsg({title: res.msg});
                    }
                }
            });

        })
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.PostsDetail.init();
})