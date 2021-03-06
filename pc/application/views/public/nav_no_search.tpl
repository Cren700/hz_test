
<div class="header" style="border-bottom:1px solid #333;" >
    <div class="container head_content" style="width: 90%">
        <a href="<{''|getBaseUrl}>" class="logo">
            <img src="<{'logo.png'|baseImgUrl}>"/>
        </a>
        <div class="nav">
            <ul class="clearfix">
                <li><a href="<{''|getBaseUrl}>">首页</a></li>
                <li><a href="<{'/product.html'|getBaseUrl}>">产品</a></li>
                <li><a href="<{'/theme.html'|getBaseUrl}>">专题</a></li>
                <li><a href="http://bbs.imhuzhu.com">社区</a></li>
            </ul>
        </div>
        <div class="head_right">
            <div class="drop_down clearfix">
                <{if !$uid}>
                <div class="login">
                    <a href="<{'/account.html'|getBaseUrl}>">登录</a>
                </div>
                <{else}>
                <div class="drop">
                    <p><span>您好，<{$username}></span></p>
                    <div class="drop_avatar">
                        <img src="<{if $image_path}><{$image_path}><{else}><{'avatar.jpg'|baseImgUrl}><{/if}>"/>
                    </div>
                </div>
                <div class="drop_nav">
                    <ul>
                        <li><a href="<{'/account/detail.html'|getBaseUrl}>">用户资料</a></li>
                        <li><a href="<{'/account/center.html'|getBaseUrl}>">账户中心</a></li>
                        <li><a href="<{'/info/planList.html'|getBaseUrl}>">我的订单</a></li>
                        <li><a href="<{'/info/collectList.html'|getBaseUrl}>">我的收藏</a></li>

                        <{if $user_type eq 3}>
                        <!--媒体star-->
                        <li><a href="<{'/mudium.html'|getBaseUrl}>">文章列表</a></li>
                        <li><a href="<{'/about/report.html'|getBaseUrl}>">平台寻求报道</a></li>
                        <!--媒体end-->
                        <{/if}>
                        <{if $user_type eq 2}>
                        <!--商户star-->
                        <li><a href="<{'/store.html'|getBaseUrl}>">我的产品</a></li>
                        <li><a href="<{'/storeorder/index.html'|getBaseUrl}>">成交订单</a></li>
                        <!--商户end-->
                        <{/if}>
                        <li><a href="<{'/account/logout.html'|getBaseUrl}>">退出登录</a></li>
                    </ul>
                </div>
                <{/if}>
            </div>
        </div>
    </div>
</div>