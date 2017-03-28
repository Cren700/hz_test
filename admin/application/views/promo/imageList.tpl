
<!--table info-->
<{if count($info['list']) eq 0}>
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">温馨提示!</h4>
    无相应的广告信息
</div>
<{else}>
<div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>图片</th>
            <th>地址</th>
            <th>广告优先级</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>编辑</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>" class="tdWrap">
                <td><{$i['Fid']}></td>
                <td><img src="<{$i['Fimage_url']}>" style="width: 150px; height: 120px;" alt=""></td>
                <td><{$i['Furl']}></td>
                <td><{$i['Flevel']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td class="js-promo-status"><{if $i['Fstatus'] eq 0 }>禁用<{elseif $i['Fstatus'] eq 1}>使用<{/if}></td>
                <td>
                    <{if 'promo/imageDetail'|hasPower}>
                    <a href="<{"/promo/imageDetail/"|cat:$i['Fid']|getBaseUrl}>">编辑</a>
                    <{/if}>
                </td>
                <td>
                    <{if 'promo/status'|hasPower}>
                    <{if $i['Fstatus'] eq 0}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">使用</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fstatus'] eq 1}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">禁用</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
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
