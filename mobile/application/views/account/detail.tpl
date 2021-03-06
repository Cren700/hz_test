<{include file="public/header.tpl"}>
<body>
<section class="content_one" style="margin-bottom: 1.6rem">
    <div class="user_set_item">
        <div class="set_item">
            <p>昵称</p>
            <span><{$user['Fnick_name']|default:''}></span>
        </div>
        <div class="set_item">
            <p>真实名称</p>
            <span><{$user['Freal_name']|default:''}></span>
        </div>
        <div class="set_item">
            <p>证件类型</p>
            <span>
                <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 1 }>身份证<{/if}>
                <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 2 }>驾驶证<{/if}>
                <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 3 }>护照<{/if}>
                <{if isset($user['Fcert_type']) && $user['Fcert_type'] eq 4 }>港澳证<{/if}>
            </span>
        </div>
        <div class="set_item">
            <p>证件号码</p>
            <span><{$user['Fcert_no']|default:''}></span>
        </div>
        <div class="set_item">
            <p>性别</p>
            <span>
                <{if ($user['Fsex']|default:1) eq 1 }>
                男
                <{else}>
                女
                <{/if}>
            </span>
        </div>
        <div class="set_item">
            <p>邮箱地址</p>
            <span><{$user['Femail']|default:''}></span>
        </div>
        <div class="set_item">
            <p>电话号码</p>
            <span><{$user['Fphone']|default:''}></span>
        </div>
        <div class="set_item">
            <p>个人地址</p>
            <span><{$user['Fprovince']|default:''}><{$user['Fcity']|default:''}><{$user['Faddress']|default:''}></span>
        </div>
        <div class="set_item" style='height:3rem'>
            <p>头像</p>
            <span ><img style="width: 2.5rem; height: 2rem;" src="<{$user['Fimage_path']|default:("avatar.jpg"|baseImgUrl)}>" alt=""></span>
        </div>
        <div class="set_item" <{if $user['Fannex_path']}>style='height:3rem'<{/if}>>
            <p>证件照片</p>
            <span ><img style="<{if $user['Fannex_path']}>width: 2.5rem; height: 2rem;<{/if}>" src="<{$user['Fannex_path']}>" alt=""></span>
        </div>
        <div class="set_item" style="border: none">
            <p>实名认证状态</p>
            <span style="color: red">
                <{if ($user['Fatte_status']|default:0) eq 0 }>未通过认证<{else}>已通过认证<{/if}>
            </span>
        </div>
        <{if ($user['Fatte_status']|default:0) eq 0 }>
            <div style="height: 2rem">
                <a href="<{'/account/modify.html'|getBaseUrl}>" class="logout" style="color: #0a83e6;position: fixed;width:100%;left:0;bottom:0;background-color: #fff;z-index: 99; border-top: 1px solid #eaeaea;height: 1.6rem;line-height: 1.6rem">马上去认证</a>
            </div>
        <{/if}>
    </div>
</section>
<{include file="public/no_nav_footer.tpl"}>
</body>
</html>