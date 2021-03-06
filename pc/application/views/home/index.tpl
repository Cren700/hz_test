<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="content container clearfix">
    <div class="content_left">
        <div class="content_slider">
            <div class="slider_show">
                <{assign var=list value=$banner['list']|default:array()}>
                <ul>
                    <{foreach $list as $l}>
                    <li>
                        <a href="<{$l['Factive_url']}>"><img src="<{$l['Fimage_path']}>" height="250" width="100%"/></a>
                    </li>
                    <{/foreach}>
                </ul>
            </div>
            <div class="slider_list">
                <ul>
                    <{foreach $list as $l}>
                        <li>&nbsp;</li>
                    <{/foreach}>
                </ul>
            </div>
            <div class="item_btn prev"></div>
            <div class="item_btn next"></div>
        </div>
        <div class="img_news clearfix">
            <{if $threeNews['list']|default:array()}>
            <{foreach $threeNews['list'] as $new}>
                <div class="img_new_item">
                    <a href="<{'/posts.html?id='|cat:$new['Fid']|getBaseUrl}>" target="_blank">
                        <img src="<{$new['Fpost_coverimage']}>"/>
                        <div class="img_new_txt">
                            <p><{$new['Fpost_title']}></p>
                        </div>
                    </a>
                </div>
            <{/foreach}>
            <{/if}>
        </div>
        <div class="nav_tab">
            <ul class="clearfix">
                <{foreach $cate as $k => $c}>
                <{if !$cate_id && $k == 0}>
                    <a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>"><li class="active"><{$c['Fcategory_name']}></li></a>
                    <{assign var='cate_id' value=$c['Fpost_category_id']}>
                <{else}>
                <a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>" ><li class="<{if $cate_id eq $c['Fpost_category_id']}>active<{/if}>"><{$c['Fcategory_name']}></li></a>
                <{/if}>
                <{/foreach}>
            </ul>
        </div>
        <div class="tab_list">
            <div class="tab_list_item">
                <ul id="js-news-box">

                </ul>
                <div style="height: 60px;">
                    <a href="" class="more" id="js-btn-more">浏览更多</a>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <{if isset($images['list'])}>
        <{foreach $images['list'] as $i}>
        <div class="sidebarTopics">
            <a href="<{$i['Furl']}>" target="_blank">
                <img src="<{$i['Fimage_url']}>" height="170px" width="300px">
            </a>
        </div>
        <{/foreach}>
        <{/if}>
        <div class="platform">
            <a href="javascript:void(0);">平台寻求报道</a>
        </div>
        <div class="hysj">
            <h3>行业数据</h3>
            <div class="data">
                <ul class="data_scroll" id='js-event-box'>
                </ul>
                <a href="javascript:void(0);" class="data_more" id="js-event-move">加载更多</a>
            </div>
        </div>
    </div>
</div>
<div class="float_layer">
    <div class="lay_wechat">
        <i>&nbsp;</i>
        <div class="lay_wechat_img">
            <img src="<{'qrcode.png'|baseImgUrl}>" alt="">
        </div>
    </div>
    <div class="go_top">
        <i>&nbsp;</i>
    </div>
</div>
<div class="float_box">
    <div class="mark"></div>
    <div class="layer_box">
        <div class="layer_left">
            <div class="layer_left_con">
                <h3>联系我们</h3>
                <p>kefu@imhuzhu.com</p>
                <p>0755-22724880</p>
                <div>
                    <p class="company_icon">
                        <a href="http://weibo.com/p/1006065969398161/home" target="_blank" class="weibo"></a>
                        <a href="javascript:void(0);" class="wechat" id="js-wechat"></a>
                        <a href="javascript:void(0);" style="display: none;" id='js-wechat-qrcode'><img  src="<{'qrcode.png'|baseImgUrl}>" alt="" style=" float: left"></a>
                    </p>
                </div>
                <p class="address">深圳市香林路财富广场B座</p>
                <img src="<{'map.png'|baseImgUrl}>"/>
            </div>
        </div>
        <div class="layer_right">
            <div class="layer_right_con">
                <p>需求报道</p>
                <form method="post" action="">
                    <dl>
                        <dt>您的联系方式</dt>
                        <dd><input type="text" class="contact_phone" name="relation"></dd>
                        <dt>报道介绍</dt>
                        <dd><textarea name='content' ></textarea></dd>
                    </dl>
                    <input type="button" id="js-btn-send" class="comment_btn" value="发送">
                </form>
            </div>
        </div>
        <div class="layer_close">&nbsp;</div>
    </div>
    <input type="hidden" name="cate_id" value="<{$cate_id}>">
</div>
<{include file='public/footer.tpl'}>

<script type="text/javascript">
    $(function(){
        $('#js-wechat').on({
            'mouseenter': function(){
                $('#js-wechat-qrcode').show();
            },
            'mouseleave': function () {
                $('#js-wechat-qrcode').hide();
            }
        });
    })
</script>
</body>
</html>