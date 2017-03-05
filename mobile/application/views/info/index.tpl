<{include file="public/header.tpl"}>
<body>
<section class="mylogin" style="padding-bottom: 0">
    <div class="user_name">
        <a class="user_avatar" href="<{'/account/detail.html'|getBaseUrl}>">
            <img src="<{if $user['Fimage_path']}><{$user['Fimage_path']}><{else}><{'avatar.jpg'|baseImgUrl}><{/if}>">
        </a>
        <p></p>
    </div>
    <div class="user_item">
        <p>
            <a href="<{'/account/detail.html'|getBaseUrl}>">用户资料</a>
        </p>
        <p>
            <a href="<{'/account/center.html'|getBaseUrl}>">账户中心</a>
        </p>
        <p>
            <a href="<{'/info/planList.html'|getBaseUrl}>">我的订单</a><!--订单+关注-->
        </p>
        <p>
            <a href="<{'/info/collectList.html'|getBaseUrl}>">我的收藏</a>
        </p>
        <{if $user_type eq 3}>
        <!--媒体star-->
        <p>
            <a href="<{'/info/medium.html'|getBaseUrl}>">文章列表</a>
        </p>
        <!--媒体end-->
        <{/if}>
        <{if $user_type eq 2}>
        <!--商户star-->
        <p>
            <a href="<{'/info/product.html'|getBaseUrl}>">我的产品</a>
        </p>
        <p>
            <a href="<{'/info/storeOrder.html'|getBaseUrl}>">订单列表</a>
        </p>
        <!--商户end-->
        <{/if}>
        <p>
            <a href="<{'/info/report.html'|getBaseUrl}>">平台寻求报道</a>
        </p>
        <p>
            <a href="<{'/info/recommend.html'|getBaseUrl}>">推荐有奖</a>
        </p>
        <p>
            <a href="<{'/account/set.html'|getBaseUrl}>">设置</a>
        </p>
    </div>
</section>
<{include file="public/footer.tpl"}>
</body>
</html>