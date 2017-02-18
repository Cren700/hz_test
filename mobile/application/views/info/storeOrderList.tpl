
<{if $info['list']|default:array()}>
    <{foreach $info['list'] as $l}>
    <li class="orderItem clearfix">
        <a href="<{'/product/detail/'|cat:$l['Fproduct_id']|getBaseUrl}>">
            <div class="orderLogo left">
                <img src="<{$l['Fcoverimage']|default:''}>" />
            </div>
            <div class="orderInfo right">
                <div class="pName"><{$l['Fproduct_name']|default:''}></div>
                <div class="orderNo">订单号:<{$l['Forder_no']}></div>
                <div class="pInfo clearfix" style="margin-top: 0">
                    <div class="pPrice left">￥<{$l['Fproduct_price']}></div>
                    <div class="pCount left">x <{$l['Fproduct_num']}></div>
                </div>
                <div class="right pOrder"><span><{if $l['Forder_status'] eq 1}>初始订单<{elseif $l['Forder_status'] eq 2}>订单已取消<{elseif $l['Forder_status'] eq 3}>支付成功<{elseif $l['Forder_status'] eq 4}>内部处理<{elseif $l['Forder_status'] eq 5}>渠道支付失败<{/if}></span></div>
            </div>
        </a>
    </li>
    <{/foreach}>
<{/if}>