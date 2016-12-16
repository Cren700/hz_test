<!DOCTYPE html>
<html lang="en">

<head>
    <title><{$seo['title']}></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<{'bootstrap.min.css'|baseCssUrl}>" />
    <link rel="stylesheet" href="<{'bootstrap-responsive.min.css'|baseCssUrl}>" />
    <link rel="stylesheet" href="<{'matrix-login.css'|baseCssUrl}>" />
    <link href="<{'/static/font-awesome/css/font-awesome.css'|getBaseUrl}>" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
<div id="loginbox">
    <form id="loginform" method="post" class="form-vertical" action="<{'/login/dologin.html'|getBaseUrl}>">
        <div class="control-group normal_text"> <h3><img src="<{'logo.png'|baseImgUrl}>" alt="Logo" /></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-user"></i></span><input type="text" placeholder="Username" name="user_id"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="passwd" />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            <span class="pull-right"><input class="btn btn-success" type="submit" value="Login"></span>
        </div>
        <{if $uri }><input type="hidden" name="uri" value="<{$uri}>"/><{/if}>
    </form>
    <form id="recoverform" action="#" class="form-vertical">
        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
            <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
        </div>
    </form>
</div>

<script src="<{'plugin/jquery.min.js'|baseJsUrl}>"></script>
<script src="<{'login/login.js'|baseJsUrl}>"></script>
</body>

</html>
