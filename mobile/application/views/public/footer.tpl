<footer class="footer">
    <a href="javascript:void(0);">
        <i class="home">&nbsp;</i>
        首页
    </a>
    <a href="project.html">
        <i class="pro">&nbsp;</i>
        产品
    </a>
    <a href="column.html">
        <i class="zhuanl">&nbsp;</i>
        专栏
    </a>
    <a href="mylogin.html">
        <i class="mine">&nbsp;</i>
        我的
    </a>
</footer>
<script>
    var baseUrl = '<{''|getBaseUrl}>';
</script>
<script src="<{"zepto.js"|baseJsUrl}>"></script>
<script src="<{"common.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>