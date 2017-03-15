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
                    <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                        <h5>广告搜索</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span3">
                                    <label style="display: inline-block">广告名称</label>
                                    <input class="span6" type="text" name="active_name" placeholder="广告名称">
                                </div>
                                <div class="span3">
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">广告状态</label>
                                    <select class="span8" name="status" id="active_id">
                                        <option value="">请选择广告状态</option>
                                        <option value="0">禁用</option>
                                        <option value="1">启用</option>
                                    </select>
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">广告分类</label>
                                    <select class="span8" name="category_id" id="category_id">
                                        <option value="">请选择广告分类</option>
                                        <{foreach $cate['list'] as $c}>
                                        <option value="<{$c.Fcategory_id}>"><{$c.Fcategory_name}></option>
                                        <{/foreach}>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success js-btn-submit">搜 索</button>
                                <input type="reset" class="btn btn-success" value="重 置"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>广告信息</h5>
                        <{if 'promo/add'|hasPower}><a class="label label-info js-btn-add-promo" href="<{'/promo/add.html'|getBaseUrl}>">添加广告</a><{/if}>
                        <{if 'promo/status'|hasPower}><a class="label label-important js-btn-batch-del" href="javascript:;">批量删除</a><{/if}>
                    </div>
                    <div id="promo-list-content">

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
