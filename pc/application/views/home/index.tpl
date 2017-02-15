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
                <li class="<{if $cate_id eq ''}> active<{/if}>"><a href="<{''|getBaseUrl}>">最新</a></li>
                <{foreach $cate as $c}>
                <li class="<{if $cate_id eq $c['Fpost_category_id']}>active<{/if}>"><a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>" ><{$c['Fcategory_name']}></a></li>
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
        <div class="sidebarTopics">
            <a href="http://www.imhuzhu.com/SpecialDetail.aspx?id=2" target="_blank">
                <img src="http://www.imhuzhu.com/upload/mg/imadmin/2017/01/12/180416839.png_300x300.png" height="170px" width="300px" alt="sfsdfsd"></a>
        </div>
        <div class="sidebarTopics">
            <a href="http://www.imhuzhu.com/SpecialDetail.aspx?id=2" target="_blank">
                <img src="http://www.imhuzhu.com/upload/mg/imadmin/2017/01/12/180416839.png_300x300.png" height="170px" width="300px" alt="sfsdfsd"></a>
        </div>
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
                <p>
                    <a href="" class="weibo"></a>
                    <a href="" class="wechat"></a>
                    <a href="" class="qq"></a>
                </p>
                <p class="address">深圳市香林路财富广场B座</p>
                <img src=""/>
            </div>
        </div>
        <div class="layer_right">
            <div class="layer_right_con">
                <p>成为专栏专家</p>
                <form method="post" action="">
                    <dl>
                        <dt>您的联系方式</dt>
                        <dd><input type="text" class="contact_phone" name=""></dd>
                        <dt>个人简介</dt>
                        <dd><textarea></textarea></dd>
                    </dl>
                    <input type="button" class="comment_btn" value="发送">
                </form>
            </div>
        </div>
        <div class="layer_close">&nbsp;</div>
    </div>
    <input type="hidden" name="cate_id" value="<{$cate_id}>">
</div>
<{include file='public/footer.tpl'}>
</body>
</html>