

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2017 &copy; 互助之家提供技术支持</div>
</div>
<!--end-Footer-part-->
<script>
    var baseUrl = '<{''|getBaseUrl}>';
</script>
<script src="<{"admin/plugin/excanvas.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/jquery.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/jquery.ui.custom.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/bootstrap.min.js"|baseJsUrl}>"></script>
<script src="<{"admin/plugin/matrix.js"|baseJsUrl}>"></script>
<script src="<{"admin/common/global.js"|baseJsUrl}>"></script>

<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>