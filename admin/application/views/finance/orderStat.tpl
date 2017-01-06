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
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                    <h5>搜索</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="#" method="get" class="form-horizontal">
                        <div class="control-group" style="padding: 10px">
                            <div class="span4">
                                <label style="display: inline-block">搜索时间</label>
                                <input type="text" data-date-format="yyyy-mm-dd" name="date" value="<{'Y-m-d'|date:time()}>" class="datepicker span8" placeholder="搜索时间">
                            </div>
                            <button type="submit" class="btn btn-success js-btn-submit">搜 索</button>
                            <input type="reset" class="btn btn-success" value="重 置"/>
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
