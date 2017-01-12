<{include file="public/header.tpl"}>
<body>
<div class="mine_head">
    <div class="head_nav">
        <p class="nav_item js-btn-my-order"><a class="active" href="javascript:void(0);">我加入的计划</a></p>
        <P class="nav_item js-btn-my-collect"><a href="javascript:void(0);">我关注的计划</a></P>
    </div>
</div>
<section class="mine_jj">
    <div class="nav_list">
        <{if isset($orderInfo['list']) && count($orderInfo['list']) neq 0}>
        <div class="new_item" id="js-my-order">
            <{foreach $orderInfo['list'] as $list}>
                <div class="pro_list">
                    <div class="pro_list_cc">
                        <div class="pro_info" <{if $list['Fcoverimage']}> style="background: url('<{$list['Fcoverimage']}>') no-repeat"<{/if}> >
                            <h2><{$list['Fproduct_name']}></h2>
                            <{if $list['Forder_status'] eq 0}><a href="<{'/order/wxpay.html?id='|cat:$list['Forder_no']|getBaseUrl}>"><{else}><a href="<{'/order/detail.html?order_no='|cat:$list['Forder_no']|getBaseUrl}>"><{/if}>
                                <span class="order_list <{if $list['Forder_status'] eq 3}>already<{elseif $list['Forder_status'] eq 2 || $list['Forder_status'] eq 4}>error<{/if}>">
                                    <{if $list['Forder_status'] eq 1 || $list['Forder_status'] eq 5}>马上支付<{elseif $list['Forder_status'] eq 3}>支付成功<{else}>订单已取消<{/if}>
                                </span>
                            </a>
                            <{if $list['Forder_status'] eq 3}>
                                <{if $list['Fclaims_status'] eq 0}><a href="<{'/order/claims.html?id='|cat:$list['Forder_no']|getBaseUrl}>"><{else}><a href="<{'/order/claimsDetail.html?id='|cat:$list['Forder_no']|getBaseUrl}>"><{/if}>
                                    <span class="order_list <{if $list['Fclaims_status'] eq 0 || $list['Fclaims_status'] eq 1}>pro_claims<{elseif $list['Fclaims_status'] eq 2}>error<{elseif $list['Fclaims_status'] eq 3}>already<{/if}> ">
                                         <{if $list['Fclaims_status'] eq 0}>发起理赔<{elseif $list['Fclaims_status'] eq 1}>理赔处理中<{elseif $list['Fclaims_status'] eq 2}>理赔失败<{elseif $list['Fclaims_status'] eq 3}>理赔成功<{/if}>
                                    </span>
                                </a>
                            <{/if}>
                            <p><{$list['Fdescription']}></p>
                        </div>
                    </div>
                </div>
            <{/foreach}>
        </div>
        <{else}>
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
        <{/if}>

        <{if isset($collectList['list']) && count($collectList['list']) neq 0}>
        <div class="new_item" style="display: none" id="js-my-collect">
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
        <{else}>

        <section class="content" style="display: none" id="js-my-collect">
            <div class="new_item">
                <div class="nodata">
                    <div class="nodata_img">
                        <img src="<{'no_data.png'|baseImgUrl}>">
                    </div>
                    <p class="nodata_txt"><{if isset($info.msg)}><{$info.msg}><{else}>暂无数据<{/if}></p>
                </div>
            </div>
        </section>
        <{/if}>
    </div>
</section>
<{include file="public/footer.tpl"}>
</body>
</html>