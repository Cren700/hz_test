<{include file="public/header.tpl"}>
<body>
<section class="mylogin">
    <div class="user_name">
        <a class="user_avatar" href="javascript:;">
            <img src="<{if $user['Fimage_path']}><{$user['Fimage_path']}><{else}><{'avatar.jpg'|baseImgUrl}><{/if}>">
        </a>
        <p></p>
    </div>
    <div class="user_item">
        <p>
            <a href="<{'/about/index.html'|getBaseUrl}>">关于互助之家</a>
        </p>
        <p>
            <a href="<{'/account/pwd.html'|getBaseUrl}>">修改密码</a>
        </p>
        <p>
            <a href="<{'/account/logout.html'|getBaseUrl}>">退出</a>
        </p>
    </div>
</section>
<{include file="public/footer.tpl"}>
</body>
</html>