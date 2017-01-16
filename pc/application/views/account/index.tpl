<{include file="public/header.tpl"}>
<body>
<div class="login_content">
    <a href="" class="logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <p class="welogin">用户登录</p>
    <form id="loginform" method="post" action="">
        <div class="phone_form">
            <input type="text" class="phone_t" name="user_id" placeholder="请输入您的账号"/>
            <div class="img_verification clearfix">
                <input type="password" class="phone_t" name="passwd" placeholder="请输入您的密码"/>
            </div>
            <div class="img_verification clearfix">
                <input type="text" class="img_yanzheng" name="" id="js-vc-code" placeholder="请输入右侧图形验证码"/>
                <img class="yanz_img" src="<{'/account/getVC?_='|cat:time()|getBaseUrl}>" id="js-vc-img" onclick="this.src+='?';">
            </div>
            <p></p>
            <input type="submit" class="phone_submit" value="登录" id="js-btn-login" data-pwd-url="<{'/account/dologin.html'|getBaseUrl}>">
            <input type="button" class="register_regit_sub" value="注册" id="js-btn-register" onclick="window.location ='<{'/account/register.html'|getBaseUrl}>'">
        </div>
    </form>
    <span>或</span>
    <a href="" class="other_login">使用微信登录</a>
    <!--<a href="" class="other_login">使用QQ登录</a>-->
</div>
</body>
<{include file="public/footer.tpl"}>
</html>