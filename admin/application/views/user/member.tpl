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
                        <h5>会员搜索</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span3">
                                    <label style="display: inline-block">会员名称</label>
                                    <input type="text" class="span8" name="user_id" placeholder="会员名称">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">时间</label>
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">会员状态</label>
                                    <select class="span6" name="status">
                                        <option value="">请选择会员状态</option>
                                        <option value="0">已删除</option>
                                        <option value="1">使用中</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success js-btn-submit">搜 索</button>
                                <input type="reset" class="btn btn-success" value="重 置"/>
                            </div>
                            <input type="hidden" name="user_type" value="<{$user_type}>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>会员列表</h5>
                    </div>
                    <div id="users-list-content">

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
