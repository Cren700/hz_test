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
                        <h5>添加用户</h5>
                    </div>
                    <form action="<{'/user/addAccountAdmin.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">用户名称</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="user_id" placeholder="用户名称" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">密码</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="passwd" placeholder="密码" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">角色类型</label>
                                    <div class="controls">
                                        <{foreach $role['list']|default:array() as $r}>
                                        <label class="span2" style="display: inline; margin-left:0" for="<{$r['Frole_id']}>"><input id="<{$r['Frole_id']}>" type="radio" name="role_id" value="<{$r['Frole_id']}>" ><{$r['Frole_name']}></label>
                                        <{/foreach}>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="form-actions">
                                    <input type="submit" class="btn btn-success " id="js-btn-submit" value="提 交" />
                                    <input type="button" class="btn js-btn-return" value="返回列表">
                                </div>
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
