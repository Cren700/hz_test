<{include file="public/header.tpl"}>
<body>
<section class="article">
    <div class="article_cont">
        <h1><{$info.Fpost_title}></h1>
        <p class="article_info">•&nbsp;<span><{$info.Fpost_author}></span>&nbsp;<span class="js-date-dif" rel="<{$info.Fupdate_time}>"></span></p>
        <article>
            <{$info.Fpost_content}>
        </article>
        <p class="article_remarks"><{$info.Fremark}></p>
        <div class="img_cont">
            <img src="">
        </div>
        <p class="img_cont_remarks">关注微信服务号互动之家（imhuzhu）<br/>定时推送，精彩福利互动！</p>
        <{if $info.Fpost_keyword}>
        <p class="label_remarks">
            <{assign var='key' value=('、'|explode:$info.Fpost_keyword)}>
            <{foreach $key as $k}>
                <a href="javascript:void(0);"><{$k}></a>
            <{/foreach}>
        </p>
        <{/if}>
        <div class="detail_ad">
            <a href="1">
                <img src="" alt="广告">
            </a>
        </div>
        <{if $related['list']}>
        <h2>相关新闻</h2>
        <div class="new_item">
            <{foreach $related['list'] as $re}>
            <{if $re['Fpost_coverimage']}>
            <div class="new_shape_one">
                <a href="<{'/posts?id='|cat:$re['Fid']|getBaseUrl}>" title="<{$re['Fpost_title']}>" class="article_link">
                    <div class="article_txt">
                        <h3><{$re['Fpost_title']}></h3>
                        <div class="item_info">
                            <span><{$re['Fpost_author']}></span>
                            <span class="js-date-dif" rel="<{$re['Fupdate_time']}>"></span>
                        </div>
                    </div>
                    <div class="article_img">
                        <img src="<{$re['Fpost_coverimage']}>">
                    </div>
                </a>
            </div>
            <{elseif $re['Fpost_coverimage'] eq null}>
            <div class="new_shape_two">
                <a href="<{'/posts?id='|cat:$re['Fid']|getBaseUrl}>" title="<{$re['Fpost_title']}>" class="article_link">
                    <h3><{$re['Fpost_title']}></h3>
                    <div class="item_info">
                        <span><{$re['Fpost_author']}></span>
                        <span class="js-date-dif" rel="<{$re['Fupdate_time']}>"></span>
                    </div>
                </a>
            </div>
            <{/if}>
            <{/foreach}>
        </div>
        <{/if}>
        <{if $info.Fcomment_status}>
        <h2>评论</h2>
            <{if isset($comment) && count($comment) > 0}>
            <div class="comment_box">
                <div class="comment_list">
                    <div class="avatar">
                        <img src="">
                    </div>
                    <div class="comment_info">
                        <p><span class='comment_name'>李博士</span> • <span>1周前</span></p>
                        <p class="comment_txt">这市场规模是怎么计算的？做校园这么多年，可以负责的说绝大部分大学生都没有付费意愿和能力，有付费意愿的大学生里面能付到3000元的又得减一大截，此外真正参与职业前培训的学生也是少数，职业前培训480亿，太不现实了~~</p>
                    </div>
                </div>
                <div class="comment_list">
                    <div class="avatar">
                        <img src="">
                    </div>
                    <div class="comment_info">
                        <p><span class='comment_name'>李博士</span> • <span>1周前</span></p>
                        <p class="comment_txt">这市场规模是怎么计算的？做校园这么多年，可以负责的说绝大部分大学生都没有付费意愿和能力，有付费意愿的大学生里面能付到3000元的又得减一大截，此外真正参与职业前培训的学生也是少数，职业前培训480亿，太不现实了~~</p>
                    </div>
                </div>
            </div>
            <{else}>
            <div class="comment_box" id="Discuss">
                <div class="comment_list" id="nodate"> <p class="comment_txt" style="color: #00a0e9; font-size: 0.4rem;">暂无评论, 赶紧来抢沙发!</p></div>
            </div>
            <{/if}>
        <{/if}>
    </div>
</section>
<footer class="foot_comment">
    <form class="comment_form">
        <input type="text" class="foot_int" name="">
    </form>
    <div class="comment_quantity">
        <a href="javascript:void(0);" class="quantity_jj">
            <i class="icon_com1">&nbsp;</i>
            <span>12</span>
        </a>
        <a href="javascript:void(0);" class="quantity_jj">
            <i class="icon_com2">&nbsp;</i>
            <span>12</span>
        </a>
    </div>
    <div class="comment_publish hide">
        <input type="button" value="发表">
    </div>
</footer>
<a href="javascript:void(0);" class="menu_nav"></a>
<div class="circle_box">
    <div class="circle_remark">&nbsp;</div>
    <div class="circle">
        <div class="ring">
            <a href="/m/index.html" class="menuItem">首页</a>
            <a href="/m/play.html" class="menuItem">产品</a>
            <a href="/m/vip/index.html" class="menuItem">我的</a>
            <a href="/m/special-0.html" class="menuItem">专栏</a>
        </div>
        <a href="#" class="center">
            <i>&nbsp;</i>
        </a>
    </div>
</div>

<{include file='public/no_nav_footer.tpl'}>
</body>
</html>