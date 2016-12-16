<{include file='public/header.tpl'}>

<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <h1 class="am-login-t">登录</h1>
        <hr class="am-login-hr">
        <br>

        <form id="form" class="am-form" action="/login/loginHandel.html" method="post">
            <label for="phone">手机号码:<input type="text" value="13631255371" name='phone'></label>
            <label for="password">密码:<input type="password" value="123456" name='pwd'></label>

            <label for="vc">验证码:
                <input type="text" value="" name="vc" autocomplete="off">
                <div class="am-form-vc">
                    <button id="js-get-vc" >获取验证码</button>
                    <img id="js-vc-img" class="am-form-vc-img" src="" alt="">
                </div>
            </label>
            <label for="remember-me">
                <input id="remember-me" type="checkbox">
                记住密码
            </label>
            <div class="am-cf">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
            </div>
        </form>
        <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>

</body>
<{include file="public/footer.tpl"}>
</html>