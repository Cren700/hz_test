
<!--Header-part-->
<div id="header">
    <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"><{$username}></span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="<{'/user/self.html'|getBaseUrl}>"><i class="icon-user"></i>个人信息</a></li>
                <li class="divider"></li>
                <li><a href="<{'/login/pwd.html'|getBaseUrl}>"><i class="icon-key"></i>修改密码</a></li>
                <li class="divider"></li>
                <li><a href="javascript:HZ.Global.logout();"><i class="icon-share-alt"></i>退出登录</a></li>
            </ul>
        </li>
        <li class=""><a title="" href="javascript:HZ.Global.logout();" ><i class="icon icon-share-alt"></i> <span class="text">退出登录</span></a></li>
    </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!--
<div id="search">
    <input type="text" placeholder="Search here..."/>
    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
-->
<!--close-top-serch-->