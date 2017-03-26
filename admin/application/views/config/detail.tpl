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
                        <h5><{if $is_new}>添加配置信息<{else}>修改配置信息<{/if}></h5>
                    </div>
                    <form action="<{'/conf/save.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">模块名称</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="typename" placeholder="模块名称" value="<{$info['Ftypename']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">模块内容</label>
                                    <div class="controls">
                                        <textarea class="span11" id="ud-content" name="content" placeholder="模块内容"><{$info['Fcontent']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/conf/index.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="id" value="<{$info['Fid']|default:''}>">
                            <input type="hidden" name="is_new" value="<{$is_new}>">
                            <input type="hidden" id="js-do-val" value="<{$do|default:''}>">
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
