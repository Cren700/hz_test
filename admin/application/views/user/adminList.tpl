
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
                <th>用户名称</th>
                <th>角色类型</th>
                <th>创建时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <{foreach $info['list'] as $i}>
                <tr rel="<{$i['Fid']}>">
                    <td><{$i['Fuser_id']}></td>
                    <td><{$i['Frole_name']}></td>
                    <td><{'Y-m-d H:i:s'|date:$i['Fcreate_time']}></td>
                    <td class="js-user-status"><{if $i['Fstatus'] eq 0 }>禁用<{else}>使用中<{/if}></td>
                    <td>
                        <a href="<{"/user/getAdminInfo.html?id="|cat:$i['Fid']|getBaseUrl}>" title="点击查看用户详情">查看</a>
                        <{if $i['Fstatus'] eq 0}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">启用</button>
                        <{else}>
                        <button class="btn btn-danger btn-mini js-btn-status" data-status="0">禁用</button>
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
