<{include file="public/header.tpl"}>
<body xmlns="http://www.w3.org/1999/html">
<div class="myInfoList">
    <form action="<{if isset($is_new)}><{'/order/saveClaims.html'|getBaseUrl}><{else}><{'/order/updateClaims.html'|getBaseUrl}><{/if}>" method="post" enctype="multipart/form-data">
        <div>
            <h3><{if $is_new|default:0}>申请理赔<{else}>理赔信息<{/if}></h3>
        </div>
        <div class="input_box box">
            <label>真实名称 :</label>
            <input type="text" placeholder="真实名称" autocomplete="off" value="<{$claims['Freal_name']|default:''}>" name="real_name"/>
        </div>
        <div class="input_box box">
            <label>身份证号 :</label>
            <input type="text" placeholder="身份证号" autocomplete="off" value="<{$claims['Fidentity']|default:''}>" name="identity" />
        </div>
        <div class="input_box box">
            <label>电话号码 :</label>
            <input type="text" placeholder="电话号码" autocomplete="off" value="<{$claims['Fphone']|default:''}>" name="phone"/>
        </div>
        <div class="file_box box">
            <label>上传授权书(委托人需要) :</label>
            <input type="hidden" value="<{$claims['Fletter_auth_path']|default:''}>" name="letter_auth_path" class="js-img-path">
            <div class="button" id="letter_auth_path"></div>
            <img src="<{$claims['Fletter_auth_path']|default:''}>" class="js-img-show" style="<{if !isset($claims['Fletter_auth_path']) || !$claims['Fletter_auth_path']}>display:none;<{/if}>" alt="">
        </div>
        <div class="input_box box">
            <label>理赔原因 :</label>
            <input type="text" name="reason" autocomplete="off" placeholder="理赔原因" value="<{$claims['Freason']|default:''}>"/>
        </div>
        <div class="input_box box">
            <label>提供证据 :</label>
            <input type="text" name="evidence" autocomplete="off" placeholder="提供证据" value="<{$claims['Fevidence']|default:''}>"/>
        </div>
        <{if !$is_new|default:0}>
        <div class="input_box box">
            <label>赔偿价格 :</label>
            <input type="text" autocomplete="off" placeholder="赔偿价格" <{if !$is_new|default:0}>readonly<{/if}> value="<{$claims['Famount']|default:''}>"/>
        </div>
        <{/if}>
        <{if !$is_new|default:0}>
        <div class="input_box box">
            <label>备注 :</label>
            <input type="text" autocomplete="off" placeholder="备注" <{if !$is_new|default:0}>readonly<{/if}> value="<{$claims['Fremark']|default:''}>"/>
        </div>
        <{/if}>

        <{if !$is_new|default:0}>
        <input type="hidden" name="claims_id" value="<{$claims['Fid']}>">
        <input type="hidden" name="amount" value="<{$claims['Famount']}>">
        <{/if}>

        <input type="hidden" name="order_no" value="<{$Forder_no}>">
        <{if !isset($claims['Fstatus']) || $claims['Fstatus'] eq 1}>
        <div class="submit_box box">
            <button id="js-btn-submit">提交</button>
        </div>
        <{/if}>
    </form>
</div>

<script type="text/javascript" src="<{"jquery-3.1.1.min.js"|baseJsUrl}>"></script>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>