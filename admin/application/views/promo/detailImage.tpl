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
                        <h5><{if $is_new}>添加首页图片<{else}>首页图片详情<{/if}></h5>
                    </div>
                    <form action="<{'/promo/imageSave.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">图片路径</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$info['Fimage_url']|default:''}>" name="image_url">
                                        <img style="width: 200px; height:150px; <{if !isset($info['Fimage_url']) || !$info['Fimage_url']}>display: none<{/if}>" src="<{$info['Fimage_url']|default:''}>" id="js-img-cover" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($info['Fimage_url']) || !$info['Fimage_url']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">链接地址</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="url" placeholder="链接地址" value="<{$info['Furl']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">广告优先级</label>
                                    <div class="controls">
                                        <label style="display: inline" for="">1<input type="radio" class="span1" name="level" value="1" <{if isset($info['Flevel']) && $info['Flevel'] eq '1'}>checked="checked"<{/if}>></label>
                                        <label style="display: inline" for="">2<input type="radio" class="span1" name="level" value="2" <{if isset($info['Flevel']) && $info['Flevel'] eq '2'}>checked="checked"<{/if}>></label>
                                        <span style='color:red'>数字越大优先级越低</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/promo/image.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
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
