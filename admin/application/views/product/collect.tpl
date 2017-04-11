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
                        <h5>搜索条件</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span2">
                                    <label style="display: inline-block">资讯ID</label>
                                    <input class="span8"  type="text" name="product_id" placeholder="资讯ID">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">用户名称</label>
                                    <input class="span8" type="text" name="user_id" placeholder="用户名称">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">时间</label>
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
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
                        <h5>收藏信息</h5>
                    </div>
                    <div id="collect-list-content">

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
