<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container">
    <div class="personal_center clearfix">
        <div class="personal_nav">
            <a href="<{'/info/planList.html'|getBaseUrl}>">
                <div class="personal_nav_item active">
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
                    <i class="recommend">&nbsp;</i>
                    <p>订单列表</p>
                </div>
            </a>
            <{/if}>
            <a href="<{'/account/detail.html'|getBaseUrl}>">
                <div class="personal_nav_item">
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
            <div class="personal_list_item" id="js-my-order-box" style="display: block;">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-order active">我加入的计划</li>
                        <li class="js-my-collect">我关注的计划</li>
                    </ul>
                </div>
                <{if isset($orderInfo['list']) && count($orderInfo['list']) neq 0}>
                <{foreach $orderInfo['list'] as $list}>
                <div class="list_item_list" >
                    <div class="list_item_list_dd">
                        <div class="product_box">
                            <div class="pro_info">
                                <div class="pro_info_dd">
                                    <div class="pro_info_mark" style="background: rgba(0,0,0,.3)">&nbsp;</div>
                                    <div style="height: 20px"></div>
                                    <h1><{$list['Fproduct_name']}></h1>
                                    <p>事前保障·未雨绸缪</p>
                                    <a href="javascript:void(0);" class="<{if $list['Forder_status'] eq 3}>already<{elseif $list['Forder_status'] eq 2 || $list['Forder_status'] eq 4}>error<{/if}>">
                                        <{if $list['Forder_status'] eq 1 || $list['Forder_status'] eq 5}>马上支付<{elseif $list['Forder_status'] eq 3}>支付成功<{else}>订单已取消<{/if}>
                                    </a>
                                    <p><{$list['Fdescription']}></p>
                                    <img src="<{$list['Fcoverimage']}>">
                                </div>
                                <div class="pro_info_jj">
                                    <p class="pro_saoma">扫一扫，马上加入</p>
                                    <div class="pro_info_jj_img">
                                        <img src="<{'qrcode.png'|baseImgUrl}>">
                                    </div>
                                    <p><{$list['Fdescription']}></p>
                                    <img src="<{$list['Fcoverimage']}>"/>
                                </div>
                            </div>
                            <div class="join_info clearfix">
                                <p class="join_info_l">
                                    已加入会员
                                    <span>12</span>
                                    人
                                </p>
                                <p class="join_info_r">
                                    已互助案例
                                    <span>23</span>
                                    起
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
            <div class="personal_list_item" id="js-my-collect-box" style="display: none;">
                <div class="list_item_nav">
                    <ul class="clearfix">
                        <li class="js-my-order" >我加入的计划</li>
                        <li class="js-my-collect active">我关注的计划</li>
                    </ul>
                </div>
                <{if isset($collectList['list']) && count($collectList['list']) neq 0}>
                <{foreach $collectList['list'] as $list}>
                <div class="list_item_list" >
                    <div class="list_item_list_dd">
                        <div class="product_box">
                            <div class="pro_info">
                                <div class="pro_info_dd">
                                    <div class="pro_info_mark" style="background: rgba(0,0,0,.3)">&nbsp;</div>
                                    <div style="height: 20px"></div>
                                    <h1><{$list['Fproduct_name']}></h1>
                                    <p>事前保障·未雨绸缪</p>
                                    <a href="javascript:void(0);">
                                        马上加入
                                    </a>
                                    <p><{$list['Fdescription']}></p>
                                    <img src="<{$list['Fcoverimage']}>">
                                </div>
                                <div class="pro_info_jj">
                                    <p class="pro_saoma">扫一扫，马上加入</p>
                                    <div class="pro_info_jj_img">
                                        <img src="<{'qrcode.png'|baseImgUrl}>">
                                    </div>
                                    <p><{$list['Fdescription']}></p>
                                    <img src="<{$list['Fcoverimage']}>"/>
                                </div>
                            </div>
                            <div class="join_info clearfix">
                                <p class="join_info_l">
                                    已加入会员
                                    <span><{$list['Fturnover']}></span>
                                    人
                                </p>
                                <p class="join_info_r">
                                    已互助案例
                                    <span><{$list['Fclaims_num']}></span>
                                    起
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>