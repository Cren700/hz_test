<{include file="public/header.tpl"}>
<body>
<section class="mobile-common-title clearfix">
    <div style="display: block">
        <a href="<{'/info.html'|getBaseUrl}>" class="p_logo">
            <img src="<{'back_icon.png'|baseImgUrl}>" style="width: auto;" />
        </a>
        <div style="clear: both"></div>
    </div>
    <div class="head_nav" style="background-color: #FFF; box-shadow: 0 0 5px #e1e1e1;">
        <p class="nav_item js-btn-my-order"><a href="javascript:void(0);">我加入的计划</a></p>
        <P class="nav_item js-btn-my-collect"><a href="javascript:void(0);">我关注的计划</a></P>
    </div>
</section>
<{if isset($orderInfo['list']) && count($orderInfo['list']) neq 0}>
<section class="mobile-index-wrap" id="js-my-order" style="padding-top: 1.2rem">
    <div class="orderList">
        <ul class="nav_list">
            <{foreach $orderInfo['list'] as $l}>
            <li class="orderItem clearfix">
                <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>">
                    <div class="orderLogo left">
                        <img src="<{$l['Fcoverimage']|default:''}>" />
                    </div>
                </a>
                <div class="orderInfo right">
                    <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>">
                        <div class="pName"><{$l['Fproduct_name']|default:''}></div>
                    </a>
                    <div class="orderNo">订单号:<{$l['Forder_no']}></div>
                    <div class="pInfo clearfix" style="margin-top: 0">
                        <div class="pPrice left">￥<{$l['Fproduct_price']}></div>
                    </div>
                    <div class="right">
                        <{if $l['Forder_status'] eq 1 || $l['Forder_status'] eq 5}><span class="orderStatus"><a href="<{'/pay/wxpay.html?out_trade_no='|cat:$l['Forder_no']|getBaseUrl}>">马上支付</a></span>
                        <{elseif $l['Forder_status'] eq 2 || $l['Forder_status'] eq 4}><span class="orderStatus orderError"><a
                                href="javascript:;">已取消</a></span>
                        <{elseif $l['Forder_status'] eq 3}>
                            <span class="orderStatus orderSuccess"><a href="javascript:;">支付成功</a></span>
                            <span class="orderStatus <{if $l['claims_status'] eq 2}>orderError<{elseif $l['claims_status'] eq 3}>orderSuccess<{/if}>">
                                <{if empty($l['claims_status'])}><a href="<{'/order/claims.html?id='|cat:$l['Forder_no']|getBaseUrl}>">我要理赔</a>
                                    <{elseif $l['claims_status'] eq 1}><a href="<{'/order/claimsDetail.html?id='|cat:$l['Forder_no']|getBaseUrl}>">理赔处理中</a>
                                    <{elseif $l['claims_status'] eq 2}><a href="<{'/order/claimsDetail.html?id='|cat:$l['Forder_no']|getBaseUrl}>">理赔失败</a>
                                    <{elseif $l['claims_status'] eq 3}><a href="<{'/order/claimsDetail.html?id='|cat:$l['Forder_no']|getBaseUrl}>">理赔成功</a>
                                <{/if}>
                            </span>&nbsp;
                        <{/if}>
                    </div>
                </div>
            </li>
            <{/foreach}>
        </ul>
    </div>
</section>
<{else}>
<section class="mine_jj" id="js-my-order">
    <div class="nav_list">
    <section class="content" id="js-my-order">
        <div class="new_item">
            <div class="nodata">
                <div class="nodata_img">
                    <img src="<{'no_data.png'|baseImgUrl}>">
                </div>
                <p class="nodata_txt"><{if isset($info.msg)}><{$info.msg}><{else}>暂无数据<{/if}></p>
            </div>
        </div>
    </section>
    </div>
</section>
<{/if}>

<{if isset($collectList['list']) && count($collectList['list']) neq 0}>
<section class="mine_jj" id="js-my-collect" style="padding-top: 2.2rem">
    <div class="nav_list">
        <div class="new_item">
            <{foreach $collectList['list'] as $list}>
            <div class="pro_list">
                <div class="pro_list_cc">
                    <a href="<{'/product/detail/'|cat:$list['Fproduct_id']|getBaseUrl}>">
                        <div class="pro_info" <{if $list['Fcoverimage']}> style="background: url('<{$list['Fcoverimage']}>') no-repeat"<{/if}> >
                            <h2><{$list['Fproduct_name']}></h2>
                            <span>马上加入</span>
                            <p><{$list['Fdescription']}></p>
                        </div>
                    </a>
                    <div class="join_info">
                        <p>已加入会员<span><{$list['Fturnover']}></span>人</p>
                        <p>已互助案例<span><{$list['Fclaims_num']}></span>起</p>
                    </div>
                </div>
            </div>
            <{/foreach}>
        </div>
    </div>
</section>
<{else}>
<section class="mine_jj" id="js-my-collect">
    <div class="nav_list">
        <section class="content">
            <div class="new_item">
                <div class="nodata">
                    <div class="nodata_img">
                        <img src="<{'no_data.png'|baseImgUrl}>">
                    </div>
                    <p class="nodata_txt"><{if isset($info.msg)}><{$info.msg}><{else}>暂无数据<{/if}></p>
                </div>
            </div>
        </section>
    </div>
</section>
<{/if}>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>