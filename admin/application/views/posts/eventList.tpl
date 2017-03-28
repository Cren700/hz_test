
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
            <th>编号</th>
            <th>行业名称</th>
            <th>数量</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>" class="tdWrap">
                <td><{$i['Fpartners_id']}></td>
                <td><{$i['Fpartners_name']}></td>
                <td class="js-txt-num"><{$i['Fnum']}></td>
                <td>
                    <{if 'posts/delevent'|hasPower}>
                    <button class="btn btn-success btn-mini js-btn-submit" style="display: none">确认修改</button>
                    <button class="btn btn-primary btn-mini js-btn-status">编辑</button>
                    <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
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
