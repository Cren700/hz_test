
<{foreach $info['list'] as $i}>
<div class="tab_list_item">
    <div class="product_box">
        <div class="pro_info">
            <div class="pro_info_dd">
                <div class="pro_info_mark">&nbsp;</div>
                <h1><{$i['Fproduct_name']}></h1>
                <p>未雨绸缪</p>
                <a href="javascript:void(0);">马上加入</a>
                <p><{$i['Fdescription']}></p>
                <img src="<{$i['Fcoverimage']}>"/>
            </div>
            <div class="pro_info_jj">
                <p class="pro_saoma">扫一扫，马上加入</p>
                <div class="pro_info_jj_img">
                    <img src="<{'qrcode.png'|baseImgUrl}>">
                </div>
                <p><{$i['Fdescription']}></p>
                <img src="<{$i['Fcoverimage']}>"/>
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
</div>
<{/foreach}>