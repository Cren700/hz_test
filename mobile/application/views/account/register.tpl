<{include file='public/header.tpl'}>
<body>
<section class="login_regit">
    <div class="login_regit_box">
        <div class="login_logo">
            <a href="<{'/home'|getBaseUrl}>"><img src="<{'logo.png'|baseImgUrl}>"></a>
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
        <input type="button" class="login_other_sub" value="使用账号登陆" onclick="window.location ='<{'/account.html'|getBaseUrl}>'">
        <input type="button" class="register_regit_sub" value="使用手机登陆" onclick="window.location ='<{'/account/phone.html'|getBaseUrl}>'">
        <p class="login_regit_icon">
            <i class="login_regit_wechat">&nbsp;</i>
            <i class="login_regit_qq">&nbsp;</i>
        </p>
    </div>
    <!--角色选择框-->
    <div class="wrapRole">
        <div class="mid">
            <img src="<{'logo.png'|baseImgUrl}>" style="width: 60%;margin: 0 auto 1em;" />
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
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>