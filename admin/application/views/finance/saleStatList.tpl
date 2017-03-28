
<!--table info-->
<{if count($info['list']) eq 0}>
    <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
        <h4 class="alert-heading">温馨提示!</h4>
        无相应的关注信息
    </div>
    <{else}>
    <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>产品ID</th>
                <th>产品名称</th>
                <th>购买次数</th>
                <th>总金额</th>
            </tr>
            </thead>
            <tbody>
            <{foreach $info['list'] as $i}>
                <tr class="tdWrap">
                    <td><{$i['Fproduct_id']}></td>
                    <td><a href="<{"/product/detail/"|cat:$i['Fproduct_id']:cat:'?_d=1'|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a></td>
                    <td><{$i['num']}></td>
                    <td><{$i['total']}></td>
                </tr>
                <{/foreach}>
            </tbody>
        </table>
    </div>
    <{$page}>
    <{/if}>
<!--end table info-->
