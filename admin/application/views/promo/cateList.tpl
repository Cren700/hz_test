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
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>广告分类</h5>
                        <a class="label label-info js-btn-add-promo" href="/promo/addCate.html">添加广告分类</a>
                    </div>
                    <div id="promo-list-content">
                        <!--table info-->
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>广告分类</th>
                                    <th>分类说明</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <{foreach $cate['list'] as $c}>
                                <tr>
                                    <td><{$c.Fcategory_id}></td>
                                    <td><{$c.Fcategory_name}></td>
                                    <td><{$c.Fremark}></td>
                                    <td><a href="<{'/promo/cateGet/'|cat:$c.Fcategory_id|getBaseUrl}>" class="btn btn-primary btn-mini js-btn-delete">编辑</a></td>
                                </tr>
                                <{/foreach}>
                            </table>
                        </div>
                        <!--end table info-->
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