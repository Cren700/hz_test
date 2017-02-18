<{include file="public/header.tpl"}>
<body>
<section class="content_one">
    <div class="user_set_item">
        <div class="set_item">
            <p>账户资金</p>
            <span><{$user['Famount']|default:'0.00'}></span>
        </div>
        <div class="set_item">
            <p>优惠券</p>
            <span><{$user['Fcoupon']|default:'无'}></span>
        </div>
        <div class="set_item">
            <p>积分</p>
            <span><{$user['Fintegral']|default:'0'}></span>
        </div>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>