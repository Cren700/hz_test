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
                        <h5><{if $is_new}>添加广告<{else}>广告详情<{/if}></h5>
                    </div>
                    <form action="<{'/promo/save.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">广告名称</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="active_name" placeholder="广告名称" value="<{$promo['Factive_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">广告分类</label>
                                    <div class="controls">
                                        <select name="category_id" class="span4" id="category_id">
                                            <option value="">请选择广告分类</option>
                                            <{foreach $cate['list'] as $c}>
                                            <option value="<{$c.Fcategory_id}>" <{if isset($promo['Fcategory_id']) && $promo['Fcategory_id'] eq $c.Fcategory_id }>selected<{/if}>><{$c.Fcategory_name}></option>
                                            <{/foreach}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">图片路径</label>
                                    <div class="controls">
                                        <input type="hidden" value="<{$posts['Fimage_path']|default:''}>" name="image_path">
                                        <img style="width: 200px; height:150px; <{if !isset($posts['Fimage_path']) || !$posts['Fimage_path']}>display: none<{/if}>" src="<{$posts['Fimage_path']|default:''}>" id="js-img-cover" alt="">
                                        <input class="btn btn-danger js-btn-del-cover" style="padding-right:20px; <{if !isset($posts['Fimage_path']) || !$posts['Fimage_path']}>display: none<{/if}>" type="button" value="删除"/>
                                        <input type="file" id="file_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">广告地址</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="active_url" placeholder="广告地址" value="<{$promo['Factive_url']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">投放厂商</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="vendor" placeholder="投放厂商" value="<{$promo['Fvendor']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">广告优先级</label>
                                    <div class="controls">
                                        <label style="display: inline" for="">1<input type="radio" class="span1" name="level" checked="checked" value="<{$promo['Flevel']|default:''}>"></label>
                                        <label style="display: inline" for="">2<input type="radio" class="span1" name="level" value="<{$promo['Flevel']|default:''}>"></label>
                                        <label style="display: inline" for="">3<input type="radio" class="span1" name="level" value="<{$promo['Flevel']|default:''}>"></label>
                                        <span style='color:red'>数字越大优先级越低</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/promo.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="active_id" value="<{$promo['Factive_id']|default:''}>">
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
