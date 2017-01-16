<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="content container clearfix">
    <div class="content_left">
        <div class="content_slider">
            <div class="slider_show">
                <ul>
                    <li>
                        <a href=""><img src="<{'Bitmap.png'|baseImgUrl}>" height="250"/></a>
                    </li>
                    <li>
                        <a href=""><img src="<{'1.png'|baseImgUrl}>" height="250"/></a>
                    </li>
                    <li>
                        <a href=""><img src="<{'2.png'|baseImgUrl}>" height="250"/></a>
                    </li>
                </ul>
            </div>
            <div class="slider_list">
                <ul>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                    <li>&nbsp;</li>
                </ul>
            </div>
            <div class="item_btn prev"></div>
            <div class="item_btn next"></div>
        </div>
        <div class="img_news clearfix">
            <div class="img_new_item">
                <img src="image/01.jpg"/>
                <div class="img_new_txt">
                    <p>中国互助元年，互助保障进入细分领域</p>
                </div>
            </div>
            <div class="img_new_item">
                <img src="image/02.jpg"/>
                <div class="img_new_txt">
                    <p>中国互助元年，互助保障进入细分领域</p>
                </div>
            </div>
            <div class="img_new_item last-child">
                <img src="image/03.jpg"/>
                <div class="img_new_txt">
                    <p>中国互助元年，互助保障进入细分领域</p>
                </div>
            </div>
        </div>
        <div class="nav_tab fixed">
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
        <div class="sidebar_ad">

        </div>
        <div class="sidebar_ad">

        </div>
        <div class="platform">
            <a href="javascript:void(0);">平台寻求报道</a>
        </div>
        <div class="hysj">
            <h3>行业数据</h3>
            <div class="data">
                <ul class="data_scroll">
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                    <li>
                        <i>&nbsp;</i>
                        <span class="data_td">1.轻松互助</span>
                        <span class="data_tt">3768505</span>
                    </li>
                </ul>
                <a href="javascript:void(0);" class="data_more">加载更多</a>
            </div>
            <p class="update_time">更新时间: <span>2016-10-21 00:00</span></p>
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