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
                        <h5>广告分类</h5>
                        <{if 'promo/cateadd'|hasPower}><a class="label label-info js-btn-add-promo" href="<{'/promo/cateAdd.html'|getBaseUrl}>">添加广告分类</a><{/if}>
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
                                <tr rel="<{$c.Fcategory_id}>" class="tdWrap">
                                    <td><{$c.Fcategory_id}></td>
                                    <td><{$c.Fcategory_name}></td>
                                    <td><{$c.Fremark}></td>
                                    <td>
                                        <{if 'promo/categet'|hasPower}><a href="<{'/promo/cateGet/'|cat:$c.Fcategory_id|getBaseUrl}>" class="btn btn-primary btn-mini ">编辑</a><{/if}>
                                        <{if 'promo/catedel'|hasPower && (!isset($cate_count[$c.Fcategory_id]) || $cate_count[$c.Fcategory_id] == 0)}>
                                        <a href="javascript:;" class="btn btn-danger btn-mini js-btn-delete">删除</a>
                                        <{/if}>
                                    </td>
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
