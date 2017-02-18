
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
            <th>产品名称</th>
            <th>数量</th>
            <th>单价</th>
            <th>总价</th>
            <th>商户名称</th>
            <th>付款渠道</th>
            <th>订单状态</th>
            <th>发布时间</th>
            <th>最后修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Forder_no']}>">
                <td style="text-align: center"><{$i['Forder_no']}></td>
                <td><{$i['Fuser_id']}></td>
                <td><a href="<{"/store/detail/"|cat:$i['Fproduct_id']|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a></td>
                <td><{$i['Fproduct_num']}></td>
                <td><{$i['Fproduct_price']}></td>
                <td><{$i['Fproduct_tol_amt']}></td>
                <td><{$i['Fstore_name']|default:''}></td>
                <td><{if $i['Fpay_channel'] eq 1}>微信<{elseif $i['Fpay_channel'] eq 2}>支付宝<{/if}></td>
                <td class="js-order-status"><{if $i['Forder_status'] eq 1}>初始订单<{elseif $i['Forder_status'] eq 2}>订单取消<{elseif $i['Forder_status'] eq 3}>支付成功<{elseif $i['Forder_status'] eq 4}>内部处理<{elseif $i['Forder_status'] eq 5}>渠道支付失败<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td>
                    <{if $i['Forder_status'] eq 1}>
                        <button class="btn btn-danger btn-mini js-btn-cancel" data-status="2">取消订单</button>
                        <button class="btn btn-warning btn-mini js-btn-deal" data-status="4">内部处理</button>
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
