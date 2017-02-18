<{include file="public/header.tpl"}>
<body>
<section class="mobile-wrapper">
    <section class="mobile-index-wrap">
        <section class="mobile-common-title clearfix">
            <a href="<{''|getBaseUrl}>" class="p_logo">
                <img src="<{'logo.png'|baseImgUrl}>">
            </a>
            <span class="search-cart-common">
                <a href="<{'/shop.html'|getBaseUrl}>" class="icon-cart1"></a>
            </span>
        </section>
        <div class="orderList">
            <ul>
                <li class="orderItem clearfix">
                    <div class="orderLogo left">
                        <img src="<{$info['Fproduct']['Fcoverimage']|default:''}>" />
                    </div>
                    <div class="orderInfo right">
                        <div class="pName"><{$info['Fproduct']['Fproduct_name']|default:''}></div>
                        <div class="pInfo clearfix">
                            <div class="pPrice left">￥<{$info['Fproduct']['Fproduct_price']}></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--订单提交区域-->
        <div class="submitArea">
            <div class="orderTotal">
                <div class="oTCount">合计 : <span>￥<{$info['Fproduct']['Fproduct_price']}></span></div>
            </div>
            <a href="<{'/order/create.html?id='|cat:$info['FcartInfo']['Fid']|getBaseUrl}>" id="submitBtn">确定下单</a>
        </div>
    </section>
</section>
<{include file='public/no_nav_footer.tpl'}>
</body>
</html>