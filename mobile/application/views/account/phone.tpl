<{include file='public/header.tpl'}>
<body style="overflow:hidden;">
<section class="login_regit">
    <div class="login_regit_box">
        <div class="login_logo">
            <img src="<{'logo.png'|baseImgUrl}>">
        </div>
        <p id="p_res">手机号码登录</p>
        <form id="loginform" method="post" action="">
            <div class="login_regit_txt">
                <input type="text" class="login_regit_vertififyTxt" autocomplete="off" placeholder="请输入手机号码" id="phoneNumber" name="user_id">
            </div>
            <div class="login_regit_img">
                <input type="text" placeholder="请输入右侧验证码" autocomplete="off" class="login_regit_imgTT" name="vc" id="js-vc-code">
                <div class="login_regit_imTT">
                    <img src="<{'/account/getVC?_='|cat:time()|getBaseUrl}>" width="190" id="js-vc-img" onclick="this.src+='?';">
                </div>
            </div>
            <div class="login_regit_txt">
                <input type="text" placeholder="请输入短信验证码" class="login_regit_phoneTxt" name='code' id="code">
                <input type="button" class="login_regit_phoneBtn" value="发送验证码" id="sendCode">
            </div>
            <input type="hidden" name="url" value="<{$url|default:''}>">
            <input type="submit" class="login_regit_sub" value="登陆" id="js-btn-login" data-pwd-url="<{'/account/doPhoneLogin.html'|getBaseUrl}>">
            <label>
                <div class="checkbox">
                    <input type="checkbox" checked="" name="" disabled="disabled">
                </div>
                已阅读并同意<a href="">《互助之家用户注册协议》</a>
            </label>
        </form>
        <span>更多登录方式</span>
        <input type="button" class="login_other_sub" value="使用账号登陆" onclick="window.location ='<{'/account.html'|getBaseUrl}>'">
        <input type="button" class="register_regit_sub" value="账户注册" id="js-btn-register" onclick="window.location ='<{'/account/register.html'|getBaseUrl}>'">
        <p class="login_regit_icon">
            <i class="login_regit_wechat" onclick="window.location='<{'/account/logwx.html'|getBaseUrl}>'">&nbsp;</i>
            <i class="login_regit_qq">&nbsp;</i>
        </p>
    </div>
    <!--角色选择框-->
    <div class="wrapRole">
        <div class="mid">
            <img src="http://www.dev.huzhu.com/mobile/static/img/logo.png" style="width: 60%;margin: 0 auto 1em;" />
            <a href="javascript:;" class="wx-login">
                <span class="title">
                   普通用户
                </span>
            </a>
            <a href="javascript:;" class="qq-login">
                <span class="title">
                   高级用户
                </span>
            </a>
            <a href="javascript:;" class="qq-login">
                <span class="title">
                   商家
                </span>
            </a>
        </div>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>