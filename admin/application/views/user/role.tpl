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
                        <h5>角色列表</h5>
                        <{if 'user/addrole'|hasPower}><a class="label label-info js-btn-add-product" href="<{'/user/addRole.html'|getBaseUrl}>">添加角色</a><{/if}>
                    </div>
                    <div id="users-list-content">
                        <!--table info-->
                        <{if count($role) eq 0}>
                        <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading">温馨提示!</h4>
                            无相应的资讯信息
                        </div>
                        <{else}>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>角色名称</th>
                                    <th>描述</th>
                                    <th>操作范围</th>
                                </tr>
                                </thead>
                                <tbody>
                                <{foreach $role['list'] as $i}>
                                    <tr rel="<{$i['Frole_id']}>">
                                        <td>
                                            <{if 'user/getrole'|hasPower}>
                                                <a href="<{'/user/getRole.html?id='|cat:$i['Frole_id']|getBaseUrl}>"><{$i['Frole_name']}></a>
                                            <{else}><a href="<{'/user/getRole.html?id='|cat:$i['Frole_id']|cat:'&_d=1'|getBaseUrl}>"><{$i['Frole_name']}></a>
                                            <{/if}>
                                        </td>
                                        <td><{$i['Fdesc']}></td>
                                        <td><{$i['Faction_name']}></td>
                                    </tr>
                                    <{/foreach}>
                                </tbody>
                            </table>
                        </div>
                        <{/if}>
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
