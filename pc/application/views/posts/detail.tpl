<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container artic_con clearfix">
    <div class="side_social">
        <div>
            <a href="javascritp:void(0);" class="weibo" data-cmd="tsina">&nbsp;</a>
            <a href="javascritp:void(0);" class="wefriend" data-cmd="weixin">&nbsp;</a>
            <a href="javascritp:void(0);" class="qzone" data-cmd="qzone">&nbsp;</a>
        </div>
        <div>
            <a href="javascritp:void(0);" class="pinglun">&nbsp;</a>
            <a href="javascritp:void(0);" class="zan" id="js-btn-praise">&nbsp;</a>
            <a href="javascritp:void(0);" class="code" >&nbsp;</a>
        </div>
    </div>
    <div class="article_content">
        <h1><{$info.Fpost_title}></h1>
        <div class="article_info clearfix">
            <p>
                ●
                <span class="info_name"><{$info.Fpost_author}></span>
                ●
                <span class="js-date-dif" rel="<{$info.Fupdate_time}>"></span>
            </p>
            <p>
                收藏
                <span id="js-txt-praise-count"><{$praise['count']|default:0}></span>
                评论
                <span><{if isset($comment['data']) && count($comment['data']) > 0}><{count($comment['data']['list'])}><{else}>0<{/if}></span>
            </p>
        </div>
        <article>
            <{$info.Fpost_content}>
        </article>
        <p class="article_remarks">文章来源于<a href="">网络</a>，版权归原作者所有，如涉侵权请联系删除。</p>
        <div class="wechat_promotion">
            <img src="<{'qrcode.png'|baseImgUrl}>">
            <p>关注微信服务号互动之家（imhuzhu），定时推送，精彩福利互动！</p>
        </div>
        <{if $info.Fpost_keyword}>
        <p class="article_label">
            <i>&nbsp;</i>
            <{assign var='key' value=('、'|explode:$info.Fpost_keyword)}>
            <{foreach $key as $k}>
            <a href="<{'/posts/search.html?keyword='|cat:$k|getBaseUrl}>"><{$k}></a>
            <{/foreach}>
        </p>
        <{/if}>
        <h5 class="com_h">发表评论</h5>
        <form>
            <div class="comment">
                <div class="comment_disable">
                    <{if !isset($uid)}><p><a href="<{'/account.html'|getBaseUrl}>">登录</a>后参与评论</p>
                    <{else}>
                    <textarea id="txtContent" class="hz-disArea" placeholder="你怎么看..." style="margin: 0px; width: 100%; height: 130px; border: 1px solid #e0e0e0"></textarea>
                    <{/if}>
                </div>
            </div>
            <input type="button" value="发表" class="comment_btn" id="js-btn-send" name="">
        </form>
        <{if $info.Fcomment_status}>
            <{if isset($comment['data']) && count($comment['data']) > 0}>
                <{foreach $comment['data']['list'] as $c}>
                <div class="history_comm">
                    <div class="history_comment clearfix">
                        <a href="javascript:;" class="writer_avatar">
                            <img src="<{$c['Fcomment_authro_image']|default:''}>">
                        </a>
                        <div class="history_comment_info">
                            <p>
                                <span class="writer_name"><{$c['Fcomment_name']}></span>  ●
                                <span class="js-date-dif" rel="<{$c['Fcomment_date']}>"></span>
                            </p>
                            <p class="history_comment_txt"><{$c['Fcomment_content']}></p>
                        </div>
                    </div>
                </div>
                <{/foreach}>
            <{/if}>
        <{/if}>
    </div>
</div>
<div id="bdshare_weixin_qrcode_dialog" class="bd_weixin_popup" style="display: none;">
    <div class="bd_weixin_popup_head"><span>分享到微信朋友圈</span><a href="#" onclick="return false;" class="bd_weixin_popup_close">×</a></div>
    <div id="" class="bd_weixin_popup_main"><img id="bdshare_weixin_qrcode_dialog_qr" src="<{'http://qr.liantu.com/api.php?text='|cat:('/posts.html?id='|cat:$id|getBaseUrl)}>" alt=""></div>
    <div class="bd_weixin_popup_foot">打开微信，点击底部的“发现”，<br>使用“扫一扫”即可将网页分享至朋友圈。</div>
</div>

<div class="codePage">
    <img src="http://www.dev.huzhu.com/pc/static/img/qrcode.png" />
</div>
<!--
<div times="3" id="xubox_shade3" class="xubox_shade" style="z-index:19891017; background-color:#000; opacity:0.3; filter:alpha(opacity=30);"></div>
<div times="3" showtime="0" style="z-index: 19891017; width: auto; height: auto; top: 208px; margin-left: -86.5px;" id="xubox_layer3" class="xubox_layer" type="dialog"><div style="z-index: 19891017; height: 132px; background-color: rgb(255, 255, 255);" class="xubox_main"><div class="xubox_dialog"><span class="xubox_msg xulayer_png32 xubox_msgico xubox_msgtype3"></span><span class="xubox_msg xubox_text" style="padding-top: 54px;">此文章您已收藏</span></div><h2 class="xubox_title" move="ok" style="cursor: move;"><em>信息</em></h2><a class="xubox_close xulayer_png32 xubox_close0" href="javascript:;"></a><span class="xubox_botton"><a href="javascript:;" class="xubox_yes xubox_botton1">确定</a></span></div><div id="xubox_border3" class="xubox_border" style="z-index: 19891016; opacity: 0.3; top: -8px; left: -8px; width: 189px; height: 148px; background-color: rgb(0, 0, 0);"></div></div>

-->
<input type="hidden" name='pid' value='<{$id}>'>
<{include file="public/footer.tpl"}>
</body>
</html>