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
        <div class="orderList">
            <ul>
                <li class="orderItem clearfix">
                    <a href="<{'/product/detail/'|cat:$info['Fproduct_id']|getBaseUrl}>">
                        <div class="orderLogo left">
                            <img src="<{$info['Fcovarimage']|default:''}>" />
                        </div>
                        <div class="orderInfo right">
                            <div class="pName"><{$info['Fproduct_name']|default:''}></div>
                            <div class="pInfo clearfix">
                                <div class="pPrice left">￥<{$info['Fproduct_price']}></div>
                                <div class="pCount left">x <{$info['Fproduct_num']}></div>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!--订单提交区域-->
        <div class="submitArea">
            <div class="orderTotal">
                <div class="oTCount">合计 : <span>￥<{$info['Fproduct_price']}></span></div>
            </div>
        </div>
    </section>
</section>
<{include file='public/no_nav_footer.tpl'}>
</body>
</html>