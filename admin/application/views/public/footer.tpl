

<!--Footer-part-->
<div class="row-fluid">
    <div id="footer" class="span12"> 2016 &copy; 互助之家提供技术支持</div>
</div>
<!--end-Footer-part-->
<script>
    var baseUrl = '<{''|getBaseUrl}>';
</script>
<script src="<{"plugin/excanvas.min.js"|baseJsUrl}>"></script>
<script src="<{"plugin/jquery.min.js"|baseJsUrl}>"></script>
<script src="<{"plugin/jquery.ui.custom.js"|baseJsUrl}>"></script>
<script src="<{"plugin/bootstrap.min.js"|baseJsUrl}>"></script>
<script src="<{"plugin/matrix.js"|baseJsUrl}>"></script>
<script src="<{"common/global.js"|baseJsUrl}>"></script>

<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>