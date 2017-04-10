
<!--table info-->
<{if count($info['list']) eq 0}>
    <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
        <h4 class="alert-heading">温馨提示!</h4>
        无相应信息
    </div>
    <{else}>
    <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>用户ID</th>
                <th>用户类型</th>
                <th>账户金额</th>
                <th>账户优惠券</th>
                <th>账户积分</th>
                <th>建立时间</th>
                <th>更新时间</th>
                <th>备注</th>
            </tr>
            </thead>
            <tbody>
            <{foreach $info['list'] as $i}>
                <tr class="tdWrap">
                    <td><{$i['Fuser_id']}></td>
                    <td><{if $i['Fuser_type'] eq 1}>内部管理用户<{elseif $i['Fuser_type'] eq 2}>合作商户<{elseif $i['Fuser_type'] eq 3}>媒体用户<{else}>普通用户<{/if}></td>
                    <td><{$i['Famount']}></td>
                    <td><{$i['Fcoupon']}></td>
                    <td><{$i['Fintegral']}></td>
                    <td><{'Y-m-d H:i:s'|date:$i['Fcreate_time']}></td>
                    <td><{'Y-m-d H:i:s'|date:$i['Fupdate_time']}></td>
                    <td><{$i['Fremark']}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
    </div>
    <{$page}>
    <{/if}>
<!--end table info-->
