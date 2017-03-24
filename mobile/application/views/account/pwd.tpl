<{include file='public/header.tpl'}>
<body>
<section class="login_regit">
    <div class="login_regit_box" style="display: block">
        <div class="login_logo">
            <img src="<{'logo.png'|baseImgUrl}>">
        </div>
        <form id="form" method="post" action="">
            <p id="p_res"></p>
            <div class="login_regit_txt">
                <input type="password" placeholder="请输入原密码" autocomplete="off" class="login_regit_vertififyTxt" name="passwd">
            </div>
            <div class="login_regit_txt">
                <input type="password" placeholder="请输入新密码" autocomplete="off" class="login_regit_vertififyTxt" name="new_passwd">
            </div>
            <div class="login_regit_txt">
                <input type="password" placeholder="请再次输入新密码" autocomplete="off" class="login_regit_vertififyTxt" name="re_passwd">
            </div>
            <input type="submit" class="login_regit_sub" value="确认修改" id="js-btn-pwd" data-pwd-url="<{'/account/modifyPwd.html'|getBaseUrl}>">
        </form>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>