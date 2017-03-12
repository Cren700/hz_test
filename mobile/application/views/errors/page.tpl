<html>
<body>
<{include file="public/header.tpl"}>

<{include file="public/header_back.tpl"}>
<div class="nav_list_item show">
    <div class="nodata">
        <div class="nodata_img">
            <img src="<{'no_data.png'|baseImgUrl}>">
        </div>
        <p class="nodata_txt"><{if isset($msg) && $msg}><{$msg}><{else}>暂无数据<{/if}></p>
        <{if !$code}>
            <p class="nodata_txt"><a href="<{''|getBaseUrl}>">点击返回首页</a></p>
        <{elseif $code eq 50007}>
            <p class="nodata_txt"><a href="<{'/account/modify.html'|getBaseUrl}>">点击送您去认证</a></p>
        <{/if}>
    </div>
</div>


<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>
<!-- Page footer-->
</body>
</html>