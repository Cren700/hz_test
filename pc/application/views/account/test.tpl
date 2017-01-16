<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div id="login_container"></div>
<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
    var obj = new WxLogin({
        id:"login_container",
        appid: "wx8630ddb14433ee21",
        scope: "snsapi_userinfo",
        redirect_uri: "http://www.dev.huzhu.com/pc/account/wxLogBak.html",
        state: "state",
        style: "",
        href: ""
    });
</script>
</body>
</html>