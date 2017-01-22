if (typeof (HZ) == "undefined" || !HZ) {
    var HZ = {}
}

HZ.InfoPlan = (function() {
    function _init(){

        // 删除收藏
        $('.js-btn-del-collect').on('click', function(){
            if(confirm("是否删除收藏?")) {
                var that = $(this);
                var url = baseUrl+"/posts/doPraise.html";
                var data = {post_id: that.data('pid')};
                $.post(url, data, function(res){
                    if(res['code'] != 0) {
                        HZ.Dialog.showMsg({title: res['msg']});
                    } else {
                        that.parents('.list_item_list').remove();
                    }
                },'json');
            }
        });

        // 删除评论
        $('.js-btn-del-comment').on('click', function(){
            if(confirm("是否删除评论?")) {
                var that = $(this);
                var url = baseUrl+"/posts/delComment.html";
                var data = {comment_id: that.data('comment-id')};
                $.post(url, data, function(res){
                    if(res['code'] != 0) {
                        HZ.Dialog.showMsg({title: res['msg']});
                    } else {
                        that.parents('.list_item_list').remove();
                    }
                },'json');
            }
        });

        // 我的收藏
        $('.js-my-collect').on('click', function () {
            $('#js-my-comment-box').hide();
            $('#js-my-collect-box').show();
        });

        // 我的评论
        $('.js-my-comment').on('click', function () {
            $('#js-my-collect-box').hide();
            $('#js-my-comment-box').show();
        });
    }

    return {
        init: _init
    }
})();

$(document).ready(function(){
    HZ.InfoPlan.init();
})