
<!--table info-->
<{if count($info['list']) eq 0}>
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">温馨提示!</h4>
    无相应的订单信息
</div>
<{else}>
<div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>订单号</th>
            <th>用户名</th>
            <th>真实名称</th>
            <th>身份证</th>
            <th>电话号码</th>
            <th>产品名称</th>
            <th>理赔金额</th>
            <th>原因</th>
            <th>提供证据</th>
            <th>商户名称</th>
            <th>状态</th>
            <th>修改时间</th>
            <th>备注</th>
            <th>编辑信息</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>">
                <td style="text-align: center"><{$i['Forder_no']}></td>
                <td><{$i['Fuser_id']}></td>
                <td><{$i['Freal_name']}></td>
                <td><{$i['Fidentity']}></td>
                <td><{$i['Fphone']}></td>
                <td>
                    <a href="<{"/product/detail/"|cat:$i['Fproduct_id']|cat:'?_d=1'|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a>
                </td>
                <td><{$i['Famount']}></td>
                <td><{$i['Freason']}></td>
                <td><{$i['Fevidence']}></td>
                <td><{$i['Fstore_name']}></td>
                <td class="js-order-status"><{if $i['Fstatus'] eq 1}>理赔中<{elseif $i['Fstatus'] eq 2}>理赔失败<{elseif $i['Fstatus'] eq 3}>理赔完成<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{$i['Fremark']}></td>
                <td>
                    <{if 'order/claimsdetail'|hasPower}>
                    <a href="<{'/order/claimsDetail.html?id='|cat:$i['Fid']|getBaseUrl}>">编辑</a>
                    <{/if}>
                </td>
                <td>
                    <{if $i['Fstatus'] eq 1}>
                        <{if 'order/claimorderstatus'|hasPower}>
                        <button class="btn btn-danger btn-mini js-btn-cancel" data-status="2">理赔失败</button>
                        <button class="btn btn-success btn-mini js-btn-success" data-status="3">已完成</button>
                        <{/if}>
                    <{elseif $i['Fstatus'] eq 2}>
                    <{if 'order/claimorderstatus'|hasPower}>
                        <button class="btn btn-danger btn-mini js-btn-cancel" data-status="1">重启订单</button>
                    <{/if}>
                    <{/if}>
                </td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
</div>
<{$page}>
<{/if}>
<!--end table info-->
