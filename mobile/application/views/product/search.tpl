<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_product_box.tpl"}>
</div>
<{if $info['code'] eq 0}>
<section class="content" id="section_content" style="padding-top: 1rem">
    <div class="new_item">
        <{foreach $info['data']['list'] as $i}>
        <div class="pro_list">
            <div class="pro_list_cc">
                <a href="<{'/product/detail/'|cat:$i['Fproduct_id']|getBaseUrl}>">
                    <div class="pro_info" <{if $i['Fcoverimage']}> style="background: url('<{$i['Fcoverimage']}>') no-repeat"<{/if}> >
                        <h2><{$i['Fproduct_name']}></h2>
                        <span>马上加入</span>
                        <p><{$i['Fdescription']}></p>
                </div>
                </a>
                <div class="join_info">
                    <p>已加入会员<span>3625952</span>人</p>
                    <p>已互助案例<span>16</span>起</p>
                </div>
            </div>
        </div>
        <{/foreach}>
    </div>
</section>
<{else}>

<section class="content" id="section_content">
    <div class="nav_list_item show">
        <div class="nodata">
            <div class="nodata_img">
                <img src="<{'no_data.png'|baseImgUrl}>">
            </div>
            <p class="nodata_txt"><{if isset($info.msg)}><{$info.msg}><{else}>暂无数据<{/if}></p>
        </div>
    </div>
</section>
<{/if}>

<{include file='public/footer.tpl'}>
</body>
</html>