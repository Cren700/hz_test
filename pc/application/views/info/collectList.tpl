<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container">
    <div class="personal_center clearfix">
        <div class="personal_nav">
            <a href="<{'/info/planList.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_plan">&nbsp;</i>
                    <p>我的计划</p>
                </div>
            </a>
            <a href="<{'/info/collectList.html'|getBaseUrl}>">
                <div class="personal_nav_item active">
                    <i class="my_article">&nbsp;</i>
                    <p>我的文章</p>
                </div>
            </a>
            <a href="<{'/account/detail.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_setting">&nbsp;</i>
                    <p>个人信息</p>
                </div>
            </a>
            <a href="">
                <div class="personal_nav_item">
                    <i class="recommend">&nbsp;</i>
                    <p>推荐好友</p>
                </div>
            </a>
        </div>
        <div class="personal_list">
            <div class="personal_list_item" id="js-my-collect-box" style="display: block;">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-collect active">我收藏的文章</li>
                        <li class="js-my-comment">我的评论</li>
                    </ul>
                </div>
                <{if isset($praiseInfo['list']) && count($praiseInfo['list']) neq 0}>
                <{foreach $praiseInfo['list'] as $list}>
                <div class="list_item_list" >
                    <div class="list_item_list_jj">
                        <ul>
                            <li>
                                <div class="list_item_list_txt clearfix">
                                    <div class="personal_img">
                                        <img src="<{$list['Fpost_coverimage']}>"/>
                                    </div>
                                    <div class="personal_txt">
                                        <h2>
                                            <a href="<{'/posts.html?id='|cat:$list['Fpraise_post_id']|getBaseUrl}>"><{$list['Fpost_title']}></a>
                                        </h2>
                                        <div class="upload_info">
                                            <p class="info_left">
                                                ● <span class="info_name"><{$list['Fpost_author']}></span>
                                                ● <span class="info_ti delet_othme js-date-dif" rel="<{$list['Fupdate_time']}>"></span>
                                            </p>
                                            <{if $list['Fpost_keyword']}>
                                            <p class="info_right">
                                                <i>&nbsp;</i>
                                                <{assign var=keyword value=('、'|explode:$list['Fpost_keyword'])}>
                                                <{foreach $keyword as $k}>
                                                <a href=""><{$k}></a>
                                                <{/foreach}>
                                            </p>
                                            <{/if}>
                                        </div>
                                    </div>
                                </div>
                                <p class="delet js-btn-del-collect" data-pid="<{$list['Fpraise_post_id']}>">删除</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
            <div class="personal_list_item" id="js-my-comment-box" style="display: none;">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-collect">我收藏的文章</li>
                        <li class="js-my-comment active">我的评论</li>
                    </ul>
                </div>
                <{if isset($commentList['list']) && count($commentList['list']) neq 0}>
                <{foreach $commentList['list'] as $list}>
                <div class="list_item_list" >
                    <div class="list_item_list_jj">
                        <ul>
                            <li>
                                <div class="list_item_list_txt">
                                    <p>
                                        <a href="<{'/posts.html?id='|cat:$list['Fcomment_post_id']|getBaseUrl}>"><{$list['Fpost_title']}></a>
                                    </p>
                                    <h4>
                                        <span class="info_name"><{$list['Fcomment_content']}></span>
                                        ● <span class="info_time js-date-dif" rel="<{$list['Fcomment_date']}>"></span>
                                    </h4>
                                </div>
                                <p class="delet delet_oth js-btn-del-comment" data-comment-id="<{$list['Fcomment_id']}>">删除</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>