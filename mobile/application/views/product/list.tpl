
<{if $info['count'] neq 0}>
<{foreach $info['list'] as $i}>
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
            <p>已加入会员<span><{$i['Fturnover']}></span>人</p>
            <p>已互助案例<span><{$i['Fclaims_num']}></span>起</p>
        </div>
    </div>
    </div>
<{/foreach}>
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