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
                    <div class="widget-title"> <span class="icon"> <i class="icon-list-alt"></i> </span>
                        <h5><{if $is_new}>添加角色<{else}>修改角色<{/if}></h5>
                    </div>
                    <form action="<{'/user/saveRole.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">角色名称</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="role_name" placeholder="角色名称" value="<{$role['Frole_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">角色说明</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="desc" placeholder="角色说明" value="<{$role['Fdesc']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">操作内容</label>
                                    <div class="controls">
                                        <{assign var=ids value=','|explode:$role['Faction_ids']|default:array()}>
                                        <{assign var=idsCount value=count($ids)}>
                                        <{assign var=allCount value=count($actions['list'])}>
                                        <div style="display: block">
                                            <label class="span2" style="margin-left:0" for="js-all-action"><input id="js-all-action" type="checkbox" name="all_action" value="" <{if $idsCount == $allCount}>checked<{/if}>><b>全选</b></label>
                                        </div>
                                        <{foreach $action as $ac}>
                                        <div style="clear: both"><h5>-- <{$ac['Ftype_name']}></h5></div>
                                            <{foreach $ac['list'] as $a}>
                                            <label class="span2" style="display: inline; margin-left:0" for="<{$a['Fid']}>"><input id="<{$a['Fid']}>" type="checkbox" name="action" value="<{$a['Fid']}>" <{if in_array($a['Fid'], $ids)}>checked<{/if}>><{$a['Faction_name']}></label>
                                            <{/foreach}>
                                        <{/foreach}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="button" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/user/role.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="id" value="<{$role['Frole_id']|default:''}>">
                            <input type="hidden" name="is_new" value="<{$is_new}>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
