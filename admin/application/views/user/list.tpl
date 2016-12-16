
<!--table info-->
<{if count($info['list']) eq 0}>
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">温馨提示!</h4>
    无相应的资讯信息
</div>
<{else}>
<div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>用户ID</th>
            <th>用户名称</th>
            <th>用户昵称</th>
            <th>用户真实名称</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>是否认证</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>">
                <td><a href="<{"/user/detail/"|cat:$i['Fid']|getBaseUrl}>" title="<{$i['Fuser_id']}>"><{$i['Fid']}></a></td>
                <td><{$i['Fuser_id']}></td>
                <td><{$i['Freal_name']}></td>
                <td><{$i['Fnick_name']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td class="js-posts-status"><{if $i['Fstatus'] eq 0 }>禁用<{else}>使用中<{/if}></td>
                <td class="js-posts-status"><{if $i['Fatte_status'] eq 0 }>未认证<{else}>已认证<{/if}></td>
                <td>
                    <a href="<{"/user/info/"|cat:$i['Fid']|getBaseUrl}>" title="点击查看用户详情">点击查看</a>
                    <{if $i['Fstatus'] eq 0}>
                        <button class="btn btn-danger btn-mini js-btn-recycle">启用</button>
                    <{else}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">禁用</button>
                    <{/if}>
                    <{if $i['Fatte_status'] eq 0}>
                    <button class="btn btn-danger btn-mini js-btn-recycle">通过认证</button>
                    <{else}>
                        <button class="btn btn-danger btn-mini js-btn-delete">取消认证</button>
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
