
<{include file="public/header.tpl"}>
<body>
<div class="mine_head">
    <div class="head_nav">
        <p class="nav_item js-btn-my-posts"><a href="<{'/info/collectList.html'|getBaseUrl}>">我收藏的文章</a></p>
        <P class="nav_item js-btn-my-comments"><a class="active" href="javascript:void(0);">我的评论</a></P>
    </div>
</div>
<section class="mine_jj">
    <div class="nav_list">
        <{if $commentInfo['list']|default:array()}>
        <div class="nav_list_item" id="container">
        <{foreach $commentInfo['list'] as $l}>
            <div class="nav_list_item_dd">
                <p><{$l['Fcomment_content']}></p>
                <p>
                    <a href="<{'/posts?id='|cat:$l['Fcomment_post_id']|getBaseUrl}>"><{$l['Fpost_title']}></a>
                    <span class="js-date-dif" rel="<{$l['Fcomment_date']}>"></span>
                    <span class="right js-btn-del-comment" style="color: #197dd2;" data-comment-id="<{$l['Fcomment_id']}>">删除</span>
                </p>
            </div>
        <{/foreach}>
        </div>
        <{/if}>
    </div>
</section>


<{include file='public/menu.tpl'}>
<{include file="public/no_nav_footer.tpl"}>
<script>
    $(function () {
        // 删除评论
        $('.js-btn-del-comment').on('click', function(){

            HZ.Dialog.showMsg({title: '删除成功'});
            return false;
            if(confirm("是否删除评论?")) {
                var that = $(this);
                var url = baseUrl+"/info/delComment.html";
                var data = {comment_id: that.data('comment-id')};
                $.post(url, data, function(res){
                    if(res['code'] != 0) {
                        HZ.Dialog.showMsg({title: res['msg']});
                    } else {
                        HZ.Dialog.showMsg({title: '删除成功'});
                        that.parents('.nav_list_item_dd').remove();
                    }
                },'json');
            }
        });
    })
</script>
</body>
</html>