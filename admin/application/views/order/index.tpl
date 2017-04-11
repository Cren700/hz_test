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
                        <h5>订单搜索</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group" style="padding: 10px">
                                <div class="span2">
                                    <label style="display: inline-block">订单号</label>
                                    <input class="span8"  type="text" name="order_no" placeholder="订单号">
                                </div>
                                <div class="span2">
                                    <label style="display: inline-block">用户名</label>
                                    <input class="span8" type="text" name="user_id" placeholder="用户名">
                                </div>
                                <div class="span2">
                                    <label style="display: inline-block">产品ID</label>
                                    <input class="span8" type="text" name="product_id" placeholder="产品ID">
                                </div>
                                <div class="span3">
                                    <label style="display: inline-block">时间</label>
                                    <input type="text" data-date-format="yyyy-mm-dd" name="min_date"  class="datepicker span5" placeholder="开始时间">
                                    <label style="display: inline-block"> - </label>
                                    <input class="datepicker span5" data-date-format="yyyy-mm-dd" type="text" name="max_date" placeholder="结束时间">
                                </div>
                                <div class="span3">
                                    <select class="span8" name="order_status">
                                        <option value="">请选择订单状态</option>
                                        <option value="1">初始订单</option>
                                        <option value="2">取消订单</option>
                                        <option value="3">支付成功</option>
                                        <option value="4">内部处理失败</option>
                                        <option value="4">渠道支付失败</option>
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
                        <h5>订单信息</h5>
                    </div>
                    <div id="order-list-content">

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="is_del" value="0">
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
