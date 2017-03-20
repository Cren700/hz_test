
<{include file="public/header.tpl"}>
<body>
<section class="mobile-common-title clearfix">
    <div class="head_nav" style="background-color: #FFF; box-shadow: 0 0 5px #e1e1e1;">
        <p class="nav_item js-btn-my-posts"><a class="active" href="javascript:void(0);">我收藏的文章</a></p>
        <P class="nav_item js-btn-my-comments"><a href="<{'/info/commentList.html'|getBaseUrl}>">我的评论</a></P>
    </div>
</section>
<section class="mine_jj" style="padding-top: 1.2rem">
    <div class="nav_list">
        <{if $praiseInfo['list']|default:array()}>
        <{foreach $praiseInfo['list'] as $l}>
        <div class="nav_list_item show" id="container">
            <div class="nav_list_item_jj" id="art286">
                <div class="nav_list_item_jj_l">
                    <a href="<{'/posts?id='|cat:$l['Fid']|getBaseUrl}>"><{$l['Fpost_title']}></a>
                    <p>
                        • <span><{$l['Fpost_author']}></span><span class="js-date-dif" rel="<{$l['Fcreate_time']}>"></span>
                        <span class="js-btn-del" ref="<{$l['Fid']}>">取消<span>
                    </span></span></p>
                </div>
                <div class="nav_list_item_jj_r">
                    <img class="lazy beforeEnd" src="<{$l['Fpost_coverimage']}>" alt="<{$l['Fpost_title']}>">
                </div>
            </div>
        </div>
        <{/foreach}>
        <{/if}>
    </div>
</section>

<{include file='public/menu.tpl'}>
<{include file="public/no_nav_footer.tpl"}>
<script>
    $(function(){
        // 删除收藏
        $('.js-btn-del').on('click', function(){
            if(confirm("是否删除收藏?")) {
                var id = $(this).attr('ref');
                var that = $(this);
                var url = baseUrl+"/posts/doPraise.html";
                var data = {post_id: id};
                $.post(url, data, function(res){
                    if(res['code'] != 0) {
                        HZ.Dialog.showMsg({title: res['msg']});
                    } else {
                        that.parents('.nav_list_item').remove();
                    }
                },'json');
            }
        });
    })
</script>
</body>
</html>