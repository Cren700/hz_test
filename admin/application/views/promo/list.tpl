
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
            <th><input type="checkbox" id="bacth_selected">&nbsp;全选</th>
            <th>ID</th>
            <th>广告名称</th>
            <th>广告分类</th>
            <th>图片</th>
            <th>地址</th>
            <th>投放厂商</th>
            <th>广告优先级</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Factive_id']}>">
                <td><input type="checkbox" class="js-checkbox-sub" ref="<{$i['Factive_id']}>"></td>
                <td><{$i['Factive_id']}></td>
                <td>
                    <{if 'promo/detail'|hasPower}>
                    <a href="<{"/promo/detail/"|cat:$i['Factive_id']|getBaseUrl}>" title="<{$i['Factive_name']}>"><{$i['Factive_name']}></a>
                    <{else}>
                    <a href="<{"/promo/detail/"|cat:$i['Factive_id']|cat:'?_d=1'|getBaseUrl}>" title="<{$i['Factive_name']}>"><{$i['Factive_name']}></a>
                    <{/if}>
                </td>
                <td><{$cate[$i['Fcategory_id']]}></td>
                <td><img src="<{$i['Fimage_path']}>" style="width: 150px; height: 120px;" alt=""></td>
                <td><{$i['Factive_url']}></td>
                <td><{$i['Fvendor']}></td>
                <td><{$i['Flevel']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td class="js-promo-status"><{if $i['Fstatus'] eq 0 }>禁用<{elseif $i['Fstatus'] eq 1}>使用<{/if}></td>
                <td>
                    <{if 'promo/status'|hasPower}>
                    <{if $i['Fstatus'] eq 0}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">启用</button>
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
