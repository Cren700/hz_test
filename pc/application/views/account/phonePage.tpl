<{include file="public/header.tpl"}>
<body>
<div class="login_content">
    <a href="" class="logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <p class="welogin">用户登录</p>
    <form id="loginform" method="post" action="">
        <div class="phone_form">
            <input type="text" class="phone_t" name="user_id" placeholder="请输入您的手机号码"/>
            <div class="img_verification clearfix">
                <input type="text" class="img_yanzheng" name="" id="js-vc-code" placeholder="请输入右侧图形验证码"/>
                <img class="yanz_img" src="<{'/account/getVC?_='|cat:time()|getBaseUrl}>" id="js-vc-img" onclick="this.src+='?';">
            </div>
            <div class="clearfix">
                <input type="text" class="phone_yanzheng" name="phoneyanz" placeholder="请输入验证码"/>
                <input type="button" class="verification_btn" id="js-btn-send-sms" value="发送验证码" >
            </div>
            <p id="js-txt-show-tips"></p>
            <input type="submit" class="phone_submit" value="登录" id="js-btn-login" data-pwd-url="<{'/account/doPhoneLogin.html'|getBaseUrl}>">
            <input type="button" class="register_regit_sub" value="注册" id="js-btn-register" onclick="window.location ='<{'/account/register.html'|getBaseUrl}>'">
        </div>
    </form>
    <span>或</span>
    <a href="<{'/account.html'|getBaseUrl}>" class="other_login">使用账号登录</a>
    <a href="javascript:;" class="other_login login_regit_wechat">使用微信登录</a>
    <!--<a href="" class="other_login">使用QQ登录</a>-->
</div>
<!--角色选择框-->
<div class="wrapRole">
    <div class="mid">
        <img src="<{'logo.png'|baseImgUrl}>" style="margin: 0 auto 10em;display: block;" />
        <a href="javascript:;" ref="4">
                <span class="title">
                   普通用户
                </span>
        </a>
        <a href="javascript:;" ref="3">
                <span class="title">
                   媒体用户
                </span>
        </a>
        <a href="javascript:;" ref="2">
                <span class="title">
                   商家
                </span>
        </a>
    </div>
</div>
<input type="hidden" id='js-type' name="type" value="">
</body>
<{include file="public/footer.tpl"}>
</html>