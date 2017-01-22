<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="search_box">
    <div class="search_box_com">
        <div class="search_jj clearfix">
            <form name="search_form" method="get" action="<{'/posts/search'|getBaseUrl}>">
                <input type="text" name="keyword" class="search_txt"  value="<{$keyword|default:''}>">
                <input type="button"  class="search_btn" value="站内搜索" name="">
            </form>
        </div>
        <div class="search_result_list">
            <ul class="clearfix">
                <li <{if $type == 'posts'}> class="active"<{/if}> id="search_posts_btn">资讯</li>
                <li <{if $type == 'product'}> class="active"<{/if}> id="search_product_btn">产品</li>
            </ul>
            <p>含"<span class="search_keyword"><{$keyword}></span>"的搜索结果约<span><{if ($info['code'] == 0) }><{count($info['data'])}><{else}>0<{/if}></span>条</p>
        </div>
        <div class="search_result_item_box">
            <div class="search_result_item">
                <{if $info['code'] == 0}>
                <{assign var=preg value='/'|cat:$keyword|cat:'/'}>
                <{assign var=rep value='<span class="search_dent">'|cat:$keyword|cat:'</span>'}>
                <{foreach $info['data']['list'] as $i}>
                <div class="product_box">
                    <div class="pro_info">
                        <div class="pro_info_dd">
                            <h1><{$i['Fproduct_name']}></h1>
                            <p>事前保障·未雨绸缪</p>
                            <a href="javascript:void(0);">马上加入</a>
                            <p><{$i['Fdescription']}></p>
                            <img src="<{$i['Fcoverimage']}>">
                        </div>
                        <div class="pro_info_jj">
                            <p class="pro_saoma">扫一扫，马上加入</p>
                            <div class="pro_info_jj_img">
                                <img src="<{'qrcode.png'|baseImgUrl}>">
                            </div>
                            <p><{$i['Fdescription']}></p>
                            <img src="<{$i['Fcoverimage']}>">
                        </div>
                    </div>
                    <div class="join_info clearfix">
                        <p class="join_info_l">
                            已加入会员
                            <span><{$i['Fturnover']}></span>
                            人
                        </p>
                        <p class="join_info_r">
                            已互助案例
                            <span><{$i['Fclaims_num']}></span>
                            起
                        </p>
                    </div>
                    <i class="product_like like" data-pid="<{$i['Fproduct_id']}>">&nbsp;</i>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
        </div>
        <input type="hidden" name="collect" value="<{$collect}>">
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>