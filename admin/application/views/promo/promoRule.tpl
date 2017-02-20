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
                        <h5><{if $is_new}>添加推广规则<{else}>推广规则详情<{/if}></h5>
                    </div>
                    <form action="<{'/promo/savePromoRule.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">规则类型</label>
                                    <div class="controls">
                                        <select name="share_type" id="">
                                            <option value="1" <{if $info['Fstatus']|default:'' eq 1}>select<{/if}>>订单返利</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">返利金额</label>
                                    <div class="controls">
                                        <input class="span4" name="amount" placeholder="返利金额" value="<{$info['Famount']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">返利积分</label>
                                    <div class="controls">
                                        <input class="span4" name="integral" placeholder="返利积分" value="<{$info['Fintegral']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success" value="提 交" />
                                <a href="<{'/promo/set'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="rule_id" value="<{$info['Frule_id']|default:''}>">
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
