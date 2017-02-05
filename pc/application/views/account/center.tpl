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
                    <p>我的文章</p>
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
                    <p>产品列表</p>
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
                <div class="personal_nav_item active">
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
            <div class="personal_list_item">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-info"><a href="<{'/account/detail.html'|getBaseUrl}>">账号信息</a></li>
                        <li class="js-my-info active"><a href="">账户中心</a></li>
                    </ul>
                </div>
                <div class="list_item_list">
                    <div class="list_item_list_gg">
                        <div class="account_info">
                            <ul>
                                <li>
                                    <span class="lable_text">昵称</span>
                                    <span class="lable_text_left"><{$user['Famount']|default:'0.00'}></span>
                                </li>
                                <li>
                                    <span class="lable_text">优惠券</span>
                                    <span class="lable_text_left"><{$user['Fcoupon']|default:'无'}></span>
                                </li>
                                <li>
                                    <span class="lable_text">积分</span>
                                    <span class="lable_text_left"><{$user['Fintegral']|default:'0'}></span>
                                </li>
                            </ul>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>