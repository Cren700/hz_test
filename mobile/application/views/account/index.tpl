<{include file='public/header.tpl'}>
<body>
<section class="login_regit">
    <div class="login_regit_box">
        <div class="login_logo">
            <img src="<{'logo.png'|baseImgUrl}>">
        </div>
        <form id="loginform" method="post" action="">
            <p id="p_res"></p>
            <div class="login_regit_txt">
                <input type="text" class="login_regit_vertififyTxt" autocomplete="off" placeholder="请输入账号" id="phoneNumber" name="user_id">
            </div>
            <div class="login_regit_txt">
                <input type="password" placeholder="请输入登录密码" autocomplete="off" class="login_regit_vertififyTxt" name="passwd">
            </div>
            <div class="login_regit_img">
                <input type="text" placeholder="请输入右侧图形验证码" autocomplete="off" class="login_regit_imgTT" name="vc" id="js-vc-code">
                <div class="login_regit_imTT">
                    <img src="<{'/account/getVC?_='|cat:time()|getBaseUrl}>" width="190" id="js-vc-img" onclick="this.src+='?';">
                </div>
            </div>
            <input type="submit" class="login_regit_sub" value="登陆" id="js-btn-login" data-pwd-url="<{'/account/dologin.html'|getBaseUrl}>">
            <input type="button" class="register_regit_sub" value="注册" id="js-btn-register" onclick="window.location ='<{'/account/register.html'|getBaseUrl}>'">
            <label>
                <div class="checkbox">
                    <input type="checkbox" checked="" name="" disabled="disabled">
                </div>
                已阅读并同意<a href="">《互助之家用户注册协议》</a>
            </label>
        </form>
        <span>更多登录方式</span>
        <p class="login_regit_icon">
            <i class="login_regit_wechat" onclick="window.location='<{'/account/logwx.html'|getBaseUrl}>'">&nbsp;</i>
            <i class="login_regit_qq">&nbsp;</i>
        </p>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>