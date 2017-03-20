<{include file="public/header.tpl"}>
<body>
<div class="login_content" style="min-height:700px;">
    <a href="" class="logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <p class="welogin">账户登录</p>
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
    <a href="<{'/account/phonepage.html'|getBaseUrl}>" class="other_login">使用电话号码登录</a>
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