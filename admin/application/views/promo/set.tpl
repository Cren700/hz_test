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
                        <h5>推荐规则</h5>
                        <{if 'promo/addpromorule'|hasPower}><a class="label label-info js-btn-add-promo" href="<{'/promo/addPromoRule.html'|getBaseUrl}>">添加推荐规则</a>
                        <{/if}>
                    </div>
                    <div id="promo-list-content">
                        <!--table info-->
                        <{if $info['list']}>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>规则类型</th>
                                    <th>返利金额</th>
                                    <th>返利积分</th>
                                    <th>状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <{foreach $info['list'] as $i}>
                                <tr rel="<{$i.Frule_id}>">
                                    <td><{$i.Frule_id}></td>
                                    <td><{if $i.Fshare_type eq 1}>订单返利<{/if}></td>
                                    <td><{$i.Famount}></td>
                                    <td><{$i.Fintegral}></td>
                                    <td class='js-status'><{if $i.Fstatus eq 0}>禁用<{else}>启用<{/if}></td>
                                    <td><{"Y-m-d H:i:s"|date:$i.Fcreate_time}></td>
                                    <td>
                                        <{if 'promo/ruledetail'|hasPower}><a href="<{'/promo/ruleDetail/'|cat:$i.Frule_id|getBaseUrl}>" class="btn btn-primary btn-mini js-btn-delete">编辑</a><{/if}>
                                        <{if 'promo/rulestatus'|hasPower}>
                                        <{if $i['Fstatus'] eq 0}>
                                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">启用</button>
                                        <{else}>
                                        <button class="btn btn-danger btn-mini js-btn-status" data-status="0">禁用</button>
                                        <{/if}>
                                        <{/if}>
                                    </td>
                                </tr>
                                <{/foreach}>
                            </table>
                        </div>
                        <{else}>
                        <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
                            <h4 class="alert-heading">温馨提示!</h4>
                            无相应信息
                        </div>
                        <{/if}>
                        <!--end table info-->
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
