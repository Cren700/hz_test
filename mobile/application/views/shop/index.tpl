<{include file="public/header.tpl"}>
<body>
<section class="mobile-wrapper">
    <section class="mobile-index-wrap">
        <section class="mobile-common-title clearfix">
            <a href="<{''|getBaseUrl}>" class="p_logo">
                <img src="<{'logo.png'|baseImgUrl}>">
            </a>
            <span class="search-cart-common">
                <a href="<{'/cart.html'|getBaseUrl}>" class="icon-cart1"></a>
            </span>
        </section>
        <section class="cart-content-wrap">
            <div class="cart-content-wrap-list">
                <div class="cart-content-list-show cart-content-list-show1 <{if $info|@count neq 0}>current<{/if}>">
                    <{if $info|@count neq 0}>
                    <ul class="cart-content-list-ul blockColor">
                        <{foreach $info.list as $l}>
                        <li class="cart-content-list-li">
                            <div class="cart-content-commodity-wrap">
                                <dl class="clearfix">
                                    <dt>
                                        <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>">
                                            <img src="<{$l['Fcoverimage']|default:''}>"></a></dt>
                                    <dd>
                                        <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>"><h3><{$l['Fproduct_name']}></h3></a>
                                        <p><{$l['Fproduct_price']}></p>
                                    </dd>
                                </dl>
                                <div class="cart-content-save-commodity clearfix">
                                                        <span>
                                                            <input type="button" value="-" data="<{$l['Fid']}>" class="cart-content-save-button cart-content-save-reduce">
                                                            <input type="text" value="<{$l['Fproduct_num']}>" class="cart-content-save-result" disabled="">
                                                            <input type="button" value="+" data="<{$l['Fid']}>" class="cart-content-save-button cart-content-save-add">
                                                        </span>
                                    <p class="clearfix">
                                        <input type="button" value="删除" data-url="<{'/shop/remove.html?id='|cat:$l['Fid']|getBaseUrl}>" class="js-btn-del cart-del cart-content-input-left">
                                        <input type="button" value="购买" data-cid="<{$l['Fid']}>" class="js-btn-buy cart-content-input-right" >
                                    </p>
                                </div>
                            </div>
                        </li>
                        <{/foreach}>
                    </ul>
                    <{/if}>
                </div>
                <div class="cart-content-list-show cart-content-list-show2" style="margin: 0px;<{if $info|@count eq 0}>display: block<{/if}>">
                    <div class="cart-content-none-ship" style="height: 490.2px;">
                        <div class="cart-content-image-inner">
                            <p>购物车为空啊!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>

<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>
</body>
</html>