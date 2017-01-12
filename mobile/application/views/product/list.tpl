
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