
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
            <th>标题</th>
            <th>用户名</th>
            <th>关注时间</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr >
                <td><{$i['Fproduct_id']}></td>
                <td>
                    <a href="<{"/product/detail/"|cat:$i['Fproduct_id']|cat:'?_d=1'|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a>
                </td>
                <td><{$i['Fuser_id']}></td>
                <td><{'Y-m-d H:i:s'|date:$i['Fcreate_time']}></td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
</div>
<{$page}>
<{/if}>
<!--end table info-->
