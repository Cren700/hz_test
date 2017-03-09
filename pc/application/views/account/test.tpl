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
        appid: "wx0ab6bc88e6d36a93",
        scope: "snsapi_login",
        redirect_uri: "http://hztest.imhuzhu.com/pc/account/wxLogBak.html",
        state: "state",
        style: "",
        href: ""
    });
</script>
</body>
</html>