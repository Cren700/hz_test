<{include file="public/header.tpl"}>
<body xmlns="http://www.w3.org/1999/html">
<div class="myInfoList">
    <form action="<{'/order/saveClaims.html'|getBaseUrl}>" method="post" enctype="multipart/form-data">
        <div>
            <h3><{if $is_new|default:0}>申请理赔<{else}>理赔信息<{/if}></h3>
        </div>
        <div class="input_box box">
            <label>真实名称 :</label>
            <input type="text" placeholder="真实名称" value="<{$claims['Freal_name']|default:''}>" <{if !$is_new|default:0}>readonly<{/if}> name="real_name"/>
        </div>
        <div class="input_box box">
            <label>身份证号 :</label>
            <input type="text" placeholder="身份证号" value="<{$claims['Fidentity']|default:''}>" <{if !$is_new|default:0}>readonly<{/if}> name="identity" />
        </div>
        <div class="input_box box">
            <label>电话号码 :</label>
            <input type="text" placeholder="电话号码" value="<{$claims['Fphone']|default:''}>" <{if !$is_new|default:0}>readonly<{/if}> name="phone"/>
        </div>
        <div class="file_box box">
            <label>上传授权书(委托人需要) :</label>
            <input type="hidden" value="<{$claims['Fletter_auth_path']|default:''}>" name="image_path" class="js-img-path">
            <{if $is_new|default:0}>
                <input type="file" id="file_upload">
                <button>删除</button>
            <{else}>
                <img src="<{$claims['Fletter_auth_path']|default:''}>">
            <{/if}>
        </div>
        <div class="input_box box">
            <label>理赔原因 :</label>
            <input type="text" name="reason" placeholder="理赔原因" <{if !$is_new|default:0}>readonly<{/if}> value="<{$claims['Freason']|default:''}>"/>
        </div>
        <div class="input_box box">
            <label>提供证据 :</label>
            <input type="text" name="evidence" placeholder="提供证据" <{if !$is_new|default:0}>readonly<{/if}> value="<{$claims['Fevidence']|default:''}>"/>
        </div>

        <input type="hidden" name="order_no" value="<{$Forder_no}>">
        <{if $is_new|default:0}>
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