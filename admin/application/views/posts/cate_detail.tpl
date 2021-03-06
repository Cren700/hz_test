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
                        <h5><{if $is_new}>添加资讯分类<{else}>资讯分类详情<{/if}></h5>
                    </div>
                    <form action="<{'/posts/saveCate.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">分类名称</label>
                                    <div class="controls">
                                        <input type="text" class="span4" name="category_name" placeholder="分类名称" value="<{$cate['Fcategory_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">分类说明</label>
                                    <div class="controls">
                                        <textarea class="span4" name="remark" placeholder="分类说明"><{$cate['Fremark']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span3">
                                    <label class="control-label">分类优先级</label>
                                    <div class="controls">
                                        <select name="priority" id="">
                                            <option value="1" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 1}>selected<{/if}>>1</option>
                                            <option value="2" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 2}>selected<{/if}>>2</option>
                                            <option value="3" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 3}>selected<{/if}>>3</option>
                                            <option value="4" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 4}>selected<{/if}>>4</option>
                                            <option value="5" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 5}>selected<{/if}>>5</option>
                                            <option value="6" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 6}>selected<{/if}>>6</option>
                                            <option value="7" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 7}>selected<{/if}>>7</option>
                                            <option value="8" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 8}>selected<{/if}>>8</option>
                                            <option value="9" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 9}>selected<{/if}>>9</option>
                                            <option value="10" <{if isset($cate['Fpriority']) && $cate['Fpriority'] eq 10}>selected<{/if}>>10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">是否为专栏分类</label>
                                    <div class="controls">
                                        <span>是</span><input type="radio" name="is_special" value="1" <{if ($cate['Fis_special']|default:0) eq 1}>checked<{/if}>>
                                        <span style="padding-left: 30px">否</span><input type="radio" name="is_special" value="0" <{if ($cate['Fis_special']|default:0) eq 0}>checked<{/if}>>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success" value="提 交" />
                                <a href="<{'/posts/cate'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="category_id" value="<{$cate['Fpost_category_id']|default:''}>">
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
