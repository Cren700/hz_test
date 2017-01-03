
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
            <th>提现价格</th>
            <th>银行卡账户名</th>
            <th>银行名称</th>
            <th>银行卡号</th>
            <th>地址信息</th>
            <th>订单状态</th>
            <th>发布时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Forder_no']}>">
                <td><{$i['Forder_no']}></td>
                <td><{$i['Fuser_id']}></td>
                <td><{$i['Famount']}></td>
                <td><{$i['Fcard_name']}></td>
                <td><{$i['Fbank_name']}></td>
                <td><{$i['Fcard_no']}></td>
                <td><{$i['Fcountry']|cat:$i['Fprovice']|cat:$i['Fcity']|cat:$i['Faddress']}></td>
                <td class="js-order-status"><{if $i['Forder_status'] eq 1}>初始订单<{elseif $i['Forder_status'] eq 2}>订单取消<{elseif $i['Forder_status'] eq 3}>提现成功<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td>
                    <{if $i['Forder_status'] eq 1}>
                        <button class="btn btn-danger btn-mini js-btn-cancel" data-status="2">取消订单</button>
                        <button class="btn btn-success btn-mini js-btn-success" data-status="3">提现成功</button>
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
