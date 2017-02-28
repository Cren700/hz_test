<{include file="public/header.tpl"}>
<body>
<{include file="public/header_back.tpl"}>
<section class="article">
    <div class="article_cont">
        <h1><{$info.Fpost_title}></h1>
        <p class="article_info">•&nbsp;<span><{$info.Fpost_author}></span>&nbsp;<span class="js-date-dif" rel="<{$info.Fupdate_time}>"></span></p>
        <article id="artContent">
            <{$info.Fpost_content}>
        </article>
        <p class="article_remarks"><{$info.Fremark}></p>
        <div class="img_cont">
            <img src="<{'qrcode.png'|baseImgUrl}>">
        </div>
        <p class="img_cont_remarks">关注微信服务号互动之家（imhuzhu）<br/>定时推送，精彩福利互动！</p>
        <{if $info.Fpost_keyword}>
        <p class="label_remarks">
            <{assign var='key' value=('、'|explode:$info.Fpost_keyword)}>
            <{foreach $key as $k}>
                <a href="<{'/posts/search.html?keyword='|cat:$k|getBaseUrl}>"><{$k}></a>
            <{/foreach}>
        </p>
        <{/if}>
        <{if $promo}>
        <div class="detail_ad">
            <a href="<{$promo['Factive_url']}>" title="<{$promo['Factive_name']}>">
                <img src="<{$promo['Fimage_path']}>" alt="广告">
            </a>
        </div>
        <{/if}>
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
            <{if isset($comment['data']) && count($comment['data']) > 0}>
            <div class="comment_box">
                <{foreach $comment['data']['list'] as $c}>
                <div class="comment_list">
                    <div class="avatar">
                        <img style="width:0.64rem" src="<{$c['Fcomment_authro_image']|default:("avatar.jpg"|baseImgUrl)}>">
                    </div>
                    <div class="comment_info">
                        <p><span class='comment_name'><{$c['Fcomment_name']}></span> • <span class="js-date-dif" rel="<{$c['Fcomment_date']}>"></span></p>
                        <p class="comment_txt"><{$c['Fcomment_content']}></p>
                    </div>
                </div>
                <{/foreach}>
            </div>
            <{else}>
            <div class="comment_box" id="Discuss">
                <div class="comment_list" id="nodate">
                    <div class="comment_txt_no">
                        <p><i>&nbsp;</i>暂无评论</p>
                    </div>
                </div>
            </div>
            <{/if}>
        <{/if}>
    </div>
    <input type="hidden" name="pid" value="<{$info['Fid']}>">
</section>
<footer class="foot_comment">
    <form class="comment_form">
        <input id="txtContent" type="text" class="foot_int" name="" placeholder="你怎么看...">
    </form>
    <div class="comment_quantity">
        <a href="javascript:void(0);" class="quantity_jj">
            <i class="icon_com1">&nbsp;</i>
            <span class="js-txt-comment-count">
            <{if isset($comment['data']) && count($comment['data']) > 0}><{count($comment['data']['list'])}><{else}>0<{/if}></span>
        </a>
        <a href="javascript:void(0);" class="quantity_jj" id="js-btn-praise">
            <i class="<{if isset($is_Praise['count']) && $is_Praise['count']}>icon_com2<{/if}>">&nbsp;</i>
            <span id="js-txt-praise-count"><{$praise['count']|default:0}></span>
        </a>
    </div>
    <div class="comment_publish hide">
        <input type="button" id="js-btn-send" value="发表">
    </div>
</footer>
<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>

<script>
//    function ShowPLBtn(isShow) {
//        if (isShow) {
//            $(".comment_quantity").addClass("hide");
//            $(".comment_publish").removeClass("hide");
//            $('.foot_comment').css('position', 'static');
//        } else {
//            $(".comment_publish").addClass("hide");
//            $(".comment_quantity").removeClass("hide");
//            $('.foot_comment').css({ 'position': 'fixed', 'bottom': '0' });
//        }
//    }
//    $(function () {
//        $("*", "#artContent").css({ "font-size": "", "line-height": "", "height": "" });
//        $("img", ".xh-art").attr("width", "100%");
//        $("#txtContent").focus(function () {
//            if (!checkloginJs()) {
//                return false
//            }
//            ShowPLBtn(true);
//        });
//        $(".article").click(function () {
//            ShowPLBtn(false);
//        });
//    });
</script>
</body>
</html>