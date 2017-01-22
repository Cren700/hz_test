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
                        <h5><{if $is_new}>添加专题<{else}>专题详情<{/if}></h5>
                    </div>
                    <form action="<{'/posts/saveTheme.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form" enctype="multipart/form-data">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">标题</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="theme_title" placeholder="标题" value="<{$theme['Ftheme_title']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">摘要</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="theme_excerpt" placeholder="摘要" value="<{$theme['Ftheme_excerpt']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">专题图片</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$theme['Ftheme_coverimage']|default:''}>" name="theme_coverimage" class="js-img-path">
                                        <img style="width: 200px; height:150px; <{if !isset($theme['Ftheme_coverimage']) || !$theme['Ftheme_coverimage']}>display: none<{/if}>" src="<{$theme['Ftheme_coverimage']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($theme['Ftheme_coverimage']) || !$theme['Ftheme_coverimage']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">Banner图片</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$theme['Fbanner_path']|default:''}>" name="banner_path" class="js-img-path">
                                        <img style="width: 200px; height:150px; <{if !isset($theme['Fbanner_path']) || !$theme['Fbanner_path']}>display: none<{/if}>" src="<{$theme['Fbanner_path']|default:''}>" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($theme['Fbanner_path']) || !$theme['Fbanner_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/posts/theme.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="id" value="<{$theme['Fid']|default:''}>">
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
