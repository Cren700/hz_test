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
                        <h5>公司配置信息</h5>
                        <{if 'conf/add'|hasPower}><a class="label label-info js-btn-add-promo" href="<{'/conf/add.html'|getBaseUrl}>">添加配置信息</a><{/if}>
                    </div>
                    <div id="promo-list-content">
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>模块名称</th>
                                    <th>更改时间</th>
                                    <th>编辑</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <{if isset($info['list'])}>
                                <{foreach $info['list'] as $i}>
                                    <tr rel="<{$i['Fid']}>">
                                        <td><{$i['Ftypename']}></td>
                                        <td><{'Y-m-d H:i'|date:$i['Fupdate_time']}></td>
                                        <td>
                                            <{if 'conf/edit'|hasPower}><a href="<{'/conf/edit.html?id='|cat:$i['Fid']|getBaseUrl}>" class="btn btn-primary btn-mini js-btn-status">编辑</a><{/if}>
                                        </td>
                                        <td>
                                            <{if 'conf/del'|hasPower}><button class="btn btn-danger btn-mini js-btn-delete">删除</button><{/if}>
                                        </td>
                                    </tr>
                                <{/foreach}>
                                <{/if}>
                                </tbody>
                            </table>
                        </div>
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
