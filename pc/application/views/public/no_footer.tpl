
<script>
    var baseUrl = '<{''|getBaseUrl:false}>';
    <{if $uid}>
    var _uid = <{$uid}>;
    <{/if}>
    <{if $username}>
    var _username = "<{$username}>";
    <{/if}>
</script>
<script src="<{"jquery-3.1.1.min.js"|baseJsUrl}>"></script>
<script src="<{"global.js"|baseJsUrl}>"></script>
<script src="<{"common.js"|baseJsUrl}>"></script>
<script src="<{"main.js"|baseJsUrl}>"></script>
<script src="<{"layer.min.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
<script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>