
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
            <th>产品ID</th>
            <th>理赔金额</th>
            <th>授权书</th>
            <th>原因</th>
            <th>提供证据</th>
            <th>商户名称</th>
            <th>状态</th>
            <th>修改时间</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>">
                <td><{$i['Fid']}></td>
                <td><{$i['Fuser_id']}></td>
                <td><{$i['Freal_name']}></td>
                <td><{$i['Fidentity']}></td>
                <td><{$i['Fphone']}></td>
                <td><{$i['Fproduct_id']}></td>
                <td><{$i['Famount']}></td>
                <td><{$i['Fletter_auth_path']}></td>
                <td><{$i['Freason']}></td>
                <td><{$i['Fevidence']}></td>
                <td><{$i['Fstore_id']}></td>
                <td class="js-order-status"><{if $i['Fstatus'] eq 1}>初始订单<{elseif $i['Fstatus'] eq 2}>处理中<{elseif $i['Fstatus'] eq 3}>已完成<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{$i['Fremark']}></td>
                <td>
                    <{if $i['Fstatus'] eq 1}>
                        <button class="btn btn-danger btn-mini js-btn-cancel" data-status="2">处理中</button>
                        <button class="btn btn-success btn-mini js-btn-success" data-status="3">已完成</button>
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
