
<script>
    var baseUrl = '<{''|getBaseUrl:false}>';
    <{if $uid}>
    var _uid = <{$uid}>;
    <{/if}>
    <{if $username}>
    var _username = "<{$username}>";
    <{/if}>
</script>

<script src="<{"admin/plugin/excanvas.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/jquery.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/jquery.ui.custom.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/bootstrap.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/matrix.js"|baseJsUrl}>"></script>

<script src="<{"common.js"|baseJsUrl}>"></script>
<script src="<{"main.js"|baseJsUrl}>"></script>
<script src="<{"layer.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/common/global.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>