
<{include file="public/header.tpl"}>
<body>
<div class="login_content" style="min-height:700px;display: block">
    <a href="" class="logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <p class="welogin">微信登录</p>
    <div id="login_container"></div>
    <span>或</span>
    <a href="<{'/account.html'|getBaseUrl}>" class="other_login">使用账号登录</a>
    <a href="<{'/account/phonepage.html'|getBaseUrl}>" class="other_login">使用电话号码登录</a>
    <!--<a href="" class="other_login">使用QQ登录</a>-->
</div>
<input type="hidden" id='js-type' name="type" value="">
<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
    var obj = new WxLogin({
        id:"login_container",
        appid: "<{$appid}>",
        scope: "snsapi_login",
        redirect_uri: "<{$backUrl}>",
        state: "<{$state}>",
        style: "",
        href: ""
    });
</script>
</body>
<{include file="public/footer.tpl"}>
</html>