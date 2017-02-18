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
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>产品审核列表</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span3">
                                    <label style="display: inline-block">产品名称</label>
                                    <input class="span6" type="text" name="product_name" placeholder="产品名称">
                                </div>
                                <div class="span3">
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">产品分类</label>
                                    <select class="span8" name="category_id" id="category_id">
                                        <option value="">请选择产品分类</option>
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
                    <div id="product-list-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="status" value="1">
    <input type="hidden" name="is_del" value="0">
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
