<footer class="footer">
    <a href="<{'/home.html'|getBaseUrl}>" id="js-footer-home" <{if isset($model) && $model eq 'posts'}>class='active'<{/if}>>
        <i class="home">&nbsp;</i>
        首页
    </a>
    <a href="<{'/product.html'|getBaseUrl}>" id="js-footer-product" <{if isset($model) && $model eq 'product'}>class='active'<{/if}>>
        <i class="pro">&nbsp;</i>
        产品
    </a>
    <a href="<{'/theme.html'|getBaseUrl}>" id="js-footer-theme" <{if isset($model) && $model eq 'theme'}>class='active'<{/if}>>
        <i class="zhuanl">&nbsp;</i>
        专题
    </a>
    <a href="<{'/info.html'|getBaseUrl}>" id="js-footer-info" <{if isset($model) && $model eq 'info'}>class='active'<{/if}>>
        <i class="mine">&nbsp;</i>
        我的
    </a>
</footer>
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