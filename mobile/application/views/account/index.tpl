<{include file='public/header.tpl'}>
<body>
<section class="login_regit">
    <div class="login_regit_box">
        <div class="login_logo">
            <img src="<{'logo.png'|baseImgUrl}>">
        </div>
        <p id="p_res">账户登录</p>
        <form id="loginform" method="post" action="">
            <div class="login_regit_txt">
                <input type="text" class="login_regit_vertififyTxt" autocomplete="off" placeholder="请输入账号" id="phoneNumber" name="user_id">
            </div>
            <div class="login_regit_txt">
                <input type="password" placeholder="请输入登录密码" autocomplete="off" class="login_regit_vertififyTxt" name="passwd">
            </div>
            <div class="login_regit_img">
                <input type="text" placeholder="请输入验证码" autocomplete="off" class="login_regit_imgTT" name="vc" id="js-vc-code">
                <div class="login_regit_imTT">
                    <img src="<{'/account/getVC?_='|cat:time()|getBaseUrl}>" width="190" id="js-vc-img" onclick="this.src+='?';">
                </div>
            </div>
            <input type="hidden" name="url" value="<{$url|default:''}>">
            <input type="submit" class="login_regit_sub" value="登陆" id="js-btn-login" data-pwd-url="<{'/account/dologin.html'|getBaseUrl}>">
            <label>
                <div class="checkbox">
                    <input type="checkbox" checked="" name="" disabled="disabled">
                </div>
                已阅读并同意<a href="">《互助之家用户注册协议》</a>
            </label>
        </form>
        <span>更多登录方式</span>
        <input type="button" class="login_other_sub" value="使用手机登陆" onclick="window.location ='<{'/account/phone.html?url='|cat:$url|getBaseUrl}>'">
        <input type="button" class="register_regit_sub" value="账户注册" id="js-btn-register" onclick="window.location ='<{'/account/register.html'|getBaseUrl}>'">
        <p class="login_regit_icon">
            <i class="login_regit_wechat">&nbsp;</i>
            <!--<i class="login_regit_qq">&nbsp;</i>-->
        </p>
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
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>