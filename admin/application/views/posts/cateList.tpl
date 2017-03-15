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
                        <h5>资讯分类</h5>
                        <{if 'posts/addcate'|hasPower}><a class="label label-info js-btn-add-product" href="<{'/posts/addCate.html'|getBaseUrl}>">添加资讯分类</a>
                        <{/if}>
                    </div>
                    <div id="product-list-content">
                        <!--table info-->
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>资讯分类</th>
                                    <th>分类说明</th>
                                    <th>是否为专栏</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <{foreach $cate['list'] as $c}>
                                <tr rel="<{$c.Fpost_category_id}>">
                                    <td><{$c.Fpost_category_id}></td>
                                    <td><{$c.Fcategory_name}></td>
                                    <td><{$c.Fremark}></td>
                                    <td><{if $c.Fis_special eq 0}>否<{else}>是<{/if}></td>
                                    <td class="js-status"><{if $c['Fstatus'] eq 0 }>禁用<{else}>使用中<{/if}></td>
                                    <td>
                                        <{if 'posts/getcate'|hasPower}><a href="<{'/posts/getcate/'|cat:$c.Fpost_category_id|getBaseUrl}>" class="btn btn-primary btn-mini js-btn-delete">编辑</a><{/if}>
                                        <{if 'posts/catestatus'|hasPower}>
                                        <{if $c['Fstatus'] eq 0}>
                                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">启用</button>
                                        <{else}>
                                        <button class="btn btn-danger btn-mini js-btn-status" data-status="0">禁用</button>
                                        <{/if}>
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
