<{include file='public/header.tpl'}>
<body>
<section class="login_regit">
    <div class="login_regit_box">
        <div class="login_logo">
            <img src="<{'logo.png'|baseImgUrl}>">
        </div>
        <form id="form" method="post" action="">
            <p id="p_res"></p>
            <div class="login_regit_txt">
                <input type="text" class="login_regit_vertififyTxt" autocomplete="off" placeholder="请输入账号" id="phoneNumber" name="user_id">
            </div>
            <div class="login_regit_txt">
                <input type="password" placeholder="请输入密码" autocomplete="off" class="login_regit_vertififyTxt" name="passwd">
            </div>
            <input type="submit" class="login_regit_sub" value="注册" id="js-btn-register" data-register-url="<{'/account/doRegister.html'|getBaseUrl}>">
            <label>
                <div class="checkbox">
                    <input type="checkbox" checked="" name="" disabled="disabled">
                </div>
                已阅读并同意<a href="">《互助之家用户注册协议》</a>
            </label>
        </form>
        <span>更多登录方式</span>
        <p class="login_regit_icon">
            <i class="login_regit_wechat">&nbsp;</i>
            <i class="login_regit_qq">&nbsp;</i>
        </p>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>