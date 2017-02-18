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
                        <h5>用户详情</h5>
                    </div>
                    <form action="<{'/user/saveInfo.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">用户名称</label>
                                    <div class="controls">
                                        <{$user['Fuser_id']}>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">重置密码</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="passwd" placeholder="重新输入密码" value="">
                                        <input type="button" name="reset" class="span1 btn btn-success " id='js-btn-reset' value="确认">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">角色类型</label>
                                    <div class="controls">
                                        <select name="role_id" id="">
                                            <{foreach $role['list']|default:array() as $r}>
                                            <option value="<{$r['Frole_id']}>" <{if $r['Frole_id'] eq $user['Frole_id']}>selected="selected"<{/if}>><{$r['Frole_name']}></option>
                                            <{/foreach}>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="form-actions">
                                    <input type="button" class="btn btn-success " id="js-btn-submit" value="提 交" />
                                    <input type="button" class="btn js-btn-return" value="返回列表">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<{$user['Fid']}>">
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
