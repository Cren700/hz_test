<{include file='public/header.tpl'}>
<body>
<{if $username}>
<!--header part-->
<{include file="public/header_part.tpl"}>

<!--end header part-->

<!--sidebar-menu-->
<{include file='public/menu.tpl'}>
<!--sidebar-menu-->
<{/if}>
<!--main-container-part-->

<div id="content" <{if !$username}>style='margin-left:0'<{/if}>>
    <{include file='public/nav.tpl'}>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>找不到相应的内容</h5>
                    </div>
                    <div class="widget-content">
                        <div class="error_ex">
                            <h1>404</h1>
                            <h3>找不到相应的内容.</h3>
                            <a class="btn btn-warning btn-big"  href="<{$uri}>">返回首页</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
