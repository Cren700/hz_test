<footer class="footer">
    <a href="<{'/home.html'|getBaseUrl}>">
        <i class="home">&nbsp;</i>
        首页
    </a>
    <a href="<{'/product.html'|getBaseUrl}>">
        <i class="pro">&nbsp;</i>
        产品
    </a>
    <a href="<{'/theme.html'|getBaseUrl}>">
        <i class="zhuanl">&nbsp;</i>
        专栏
    </a>
    <a href="<{'/mylogin.html'|getBaseUrl}>">
        <i class="mine">&nbsp;</i>
        我的
    </a>
</footer>
<script>
    var baseUrl = '<{''|getBaseUrl}>';
</script>
<script src="<{"zepto.js"|baseJsUrl}>"></script>
<script src="<{"common.js"|baseJsUrl}>"></script>
<script src="<{"global.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>