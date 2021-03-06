<{include file="public/header.tpl"}>
<body>
<section class="mobile-wrapper">
    <section class="mobile-index-wrap">
        <{include file="public/header_back.tpl"}>

        <{if $info|@count neq 0}>
        <div class="orderList">
            <ul>
                <{foreach $info.list as $l}>
                <li class="orderItem clearfix">
                    <div class="orderLogo left">
                        <img src="<{$l['Fcovarimage']|default:''}>" />
                    </div>
                    <div class="orderInfo right">
                        <div class="pName"><a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>"><{$l['Fproduct_name']}></a></div>
                        <div class="pInfo clearfix">
                            <div class="pPrice left">￥<{$l['Fproduct_price']}></div>
                            <div class="pColor">
                                <a href="javascript:;" id="del" data-url="<{'/shop/remove.html?id='|cat:$l['Fid']|getBaseUrl}>" class="js-btn-del cart-del cart-content-input-left">删除</a>
                                <a href="javascript:;" id="buy" data-cid="<{$l['Fid']}>" class="js-btn-buy cart-content-input-right">购买</a>
                            </div>
                        </div>
                    </div>
                </li>
                <{/foreach}>
            </ul>
        </div>
        <{else}>
        <section class="cart-content-wrap">
            <div class="cart-content-wrap-list">
                <div class="cart-content-list-show1">
                    <div class="cart-content-list-show cart-content-list-show2" style="margin: 0px; display: block">
                        <div class="cart-content-none-ship" style="height: 490.2px;">
                            <div class="cart-content-image-inner">
                                <p>购物车没有产品哦!</p>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <{/if}>
    </section>
</section>

<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>
</body>
</html>