<html>
<body>
<{include file="public/header.tpl"}>

<div class="nav_list_item show">
    <div class="nodata">
        <div class="nodata_img">
            <img src="<{'no_data.png'|baseImgUrl}>">
        </div>
        <p class="nodata_txt"><{if isset($msg) && $msg}><{$msg}><{else}>暂无数据<{/if}></p>
    </div>
</div>


<{include file='public/menu.tpl'}>
<{include file='public/no_nav_footer.tpl'}>
<!-- Page footer-->
</body>
</html>