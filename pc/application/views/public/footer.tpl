
<div class="footer">
    <div class="foot_content">
        <div class="foot_content_l">
            <p class="foot_nav">
                <a href="<{'/about.html#p1'|getBaseUrl}>" target="_blank">关于互助之家</a><span name="|">|</span>
                <a href="<{'/about.html#p2'|getBaseUrl}>" target="_blank">欢迎投稿</a><span name="|">|</span>
                <a href="<{'/about.html#p3'|getBaseUrl}>" target="_blank">联系我们</a><span name="|">|</span>
                <a href="<{'/about.html#p0'|getBaseUrl}>" target="_blank">免责声明</a></span>
            </p>
            <p class="copy_right">© 2017  互助之家 -     深圳赤兔网络科技有限公司   <a href="http://www.miitbeian.gov.cn/"> 粤ICP备16063448号</a>
            </p>
        </div>
        <div class="foot_content_r">
            <a href="http://weibo.com/p/1006065969398161/home" target="_blank" class="weibo"></a>
            <a href="javascript:void(0);" class="wechat">
                <div class="wechat_lay_img">
                    <img src="<{'qrcode.png'|baseImgUrl}>" alt="">
                </div>
            </a>
        </div>
    </div>
</div>
<script>
    var baseUrl = '<{''|getBaseUrl}>';
    <{if $uid}>
    var _uid = <{$uid}>;
    <{/if}>
    <{if $username}>
    var _username = "<{$username}>";
    <{/if}>
</script>
<script src="<{"jquery.js"|baseJsUrl}>"></script>
<script src="<{"global.js"|baseJsUrl}>"></script>
<script src="<{"main.js"|baseJsUrl}>"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js|baseJsUrl}>"></script>
<{/foreach}>