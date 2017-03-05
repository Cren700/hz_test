<{include file="public/header.tpl"}>
<body>
<div class="login_content">
    <a href="" class="logo">
        <img src="<{'logo.png'|baseImgUrl}>">
    </a>
    <p class="welogin">注册新用户</p>
    <form id="form" method="post" action="">
        <div class="phone_form">
            <input type="text" class="phone_t" name="user_id" placeholder="请输入您的账号"/>
            <div class="img_verification clearfix">
                <input type="password" class="phone_t" name="passwd" placeholder="请输入您的密码"/>
            </div>
            <p></p>
            <input type="submit" class="phone_submit" value="马上注册" id="js-btn-register" data-register-url="<{'/account/doRegister.html'|getBaseUrl}>">
            <input type="button" class="register_regit_sub"value="已经有账号了?" onclick="window.location='<{'/account/index.html'|getBaseUrl}>'" />
        </div>
    </form>
    <span>或</span>
    <a href="<{'/account/phonepage.html'|getBaseUrl}>" class="other_login">使用电话号码登录</a>
    <a href="" class="other_login">使用微信登录</a>
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