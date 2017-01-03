
<script>
    var baseUrl = '<{''|getBaseUrl}>';
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