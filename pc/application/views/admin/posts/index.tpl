<{include file='public/header.tpl'}>
<{include file='admin/public/header.tpl'}>

<body>
<!--header part-->
<{include file="public/nav_no_search.tpl"}>
<!--end header part-->

<!--sidebar-menu-->
<{include file='admin/public/menu.tpl'}>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                        <h5>资讯搜索</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span2">
                                    <input class="span8"  type="text" name="post_title" placeholder="资讯标题">
                                </div>
                                <div class="span3">
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
                                </div>
                                <div class="span2">
                                    <select class="span12" name="category_id" id="category_id">
                                        <option value="">请选择资讯分类</option>
                                        <{foreach $cate['list'] as $c}>
                                        <option value="<{$c.Fpost_category_id}>"><{$c.Fcategory_name}></option>
                                        <{/foreach}>
                                    </select>
                                </div>
                                <div class="span2">
                                    <select class="span12" name="post_status">
                                        <option value="">请选择资讯状态</option>
                                        <option value="1">待审核</option>
                                        <option value="2">不通过</option>
                                        <option value="3">通过</option>
                                        <option value="4">下架</option>
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
                        <h5>资讯信息</h5>
                        <a class="label label-info js-btn-add-posts" href="<{'/medium/add.html'|getBaseUrl}>">添加资讯</a>
                    </div>
                    <div id="posts-list-content">

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="is_del" value="0">
    </div>
</div>

<!--end-main-container-part-->


<{include file="admin/public/footer.tpl"}>
</body>
</html>
