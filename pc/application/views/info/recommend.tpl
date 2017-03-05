<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container">
    <div class="personal_center clearfix">
        <div class="personal_nav">
            <a href="<{'/info/planList.html'|getBaseUrl}>">
                <div class="personal_nav_item ">
                    <i class="my_plan">&nbsp;</i>
                    <p>我的计划</p>
                </div>
            </a>
            <a href="<{'/info/collectList.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_article">&nbsp;</i>
                    <p>我的收藏</p>
                </div>
            </a>
            <{if $user_type eq 3}>
            <a href="<{'/medium.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_article">&nbsp;</i>
                    <p>文章列表</p>
                </div>
            </a>
            <{/if}>
            <{if $user_type eq 2}>
            <a href="<{'/store.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_article">&nbsp;</i>
                    <p>我的产品</p>
                </div>
            </a>
            <a href="<{'/storeorder.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_article">&nbsp;</i>
                    <p>订单列表</p>
                </div>
            </a>
            <{/if}>
            <a href="<{'/account/detail.html'|getBaseUrl}>">
                <div class="personal_nav_item">
                    <i class="my_setting">&nbsp;</i>
                    <p>个人信息</p>
                </div>
            </a>
            <a href="">
                <div class="personal_nav_item active">
                    <i class="recommend">&nbsp;</i>
                    <p>推荐好友</p>
                </div>
            </a>
        </div>
        <div class="personal_list">
            <div class="personal_list_item">
                <div class="personal_list_item">
                    <div class="list_item_nav">
                        <ul class="clearfix">
                            <li class="active">我要推荐</li>
                        </ul>
                    </div>
                    <div class="list_item_list">
                        <div class="list_item_list_hh">
                            <p>推荐流程</p>
                            <div class="recommend_img">
                                <img src="<{'recommend.png'|baseImgUrl}>">
                            </div>
                            <p>推荐方式</p>
                            <a href="javascript:void(0);">
                                点击生成专属二维码
                                <i>&nbsp;</i>
                            </a>
                            <div class="recommend_txt">
                                <p>点击按钮生成您的个人专属二维码，复制二维码图片，发送给您的好友。<br/>好友通过微信打开扫码识别并注册之后，即成为您的推荐会员。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="acounr_pop">
    <div class="mark">&nbsp;</div>
    <div class="recomend_pop">
        <div class="recomend_pop_c">
            <p>请沿虚线截图，发送给好友</p>
            <div class="recom_img_box">
                <div class="recom_img">
                    <img src="<{'/posts/code/'|cat:('/home/recommendPage.html'|getMobileUrl)|getBaseUrl}>">
                </div>
                <p>微信识别二维码，即刻体验</p>
            </div>
        </div>
        <i>&nbsp;</i>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>