<div id="loadingDiv" style="position: fixed; left: 0px; width: 100%; height: 100%; top: 0px; opacity: 1; z-index: 10000; display: block; background: rgb(243, 248, 255);">
    <div class="load_img" style="width: 100px; height: 100px; position: absolute; top: 50%; left: 50%; margin-left: -50px; margin-top: -50px; animation: loading 2s linear infinite; -webkit-animation: loading 4s linear infinite">
        <img src="<{'loading_bg.png'|baseImgUrl}>" style="width: 100%; height: 100%">
    </div>
</div>
<script>
    var baseUrl = '<{''|getBaseUrl:false}>';
    <{if $uid}>
    var _uid = <{$uid}>;
    <{/if}>
    <{if $username}>
    var _username = "<{$username}>";
    <{/if}>
</script>
<script src="<{"zepto.js"|baseJsUrl}>"></script>
<script src="<{"common.js"|baseJsUrl}>"></script>
<script src="<{"global.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>