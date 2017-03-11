<{include file='public/header.tpl'}>
<body>
<!--header part-->
<{include file="public/header_part.tpl"}>

<!--end header part-->

<!--sidebar-menu-->
<{include file='public/menu.tpl'}>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <{include file='public/nav.tpl'}>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>专题信息</h5>
                        <a class="label label-info js-btn-add-posts" href="<{'/posts/addTheme.html'|getBaseUrl}>">添加专题</a>
                        <a class="label label-important js-btn-batch-del" href="javascript:;">批量删除</a>
                    </div>
                    <div id="posts-list-content">

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="is_del" value="0">
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
