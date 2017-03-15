
<!--table info-->
<{if count($info['list']) eq 0}>
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">温馨提示!</h4>
    无相应的评论信息
</div>
<{else}>
<div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" id="bacth_selected">&nbsp;全选</th>
            <th>产品名称</th>
            <th>评论者</th>
            <th>评分情况</th>
            <th class="span5">内容</th>
            <th>状态</th>
            <th>评论时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fcomment_id']}>">
                <td><input type="checkbox" class="js-checkbox-sub" ref="<{$i['Fcomment_id']}>"></td>
                <td><a href="<{"/product/detail/"|cat:$i['Fcomment_pro_id']|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a></td>
                <td><{$i['Fcomment_user_name']}></td>
                <td>
                    <p>
                        保障安心度: <{$i['Fstart1']}><br/>
                        理赔放心度: <{$i['Fstart2']}><br/>
                        服务满意度: <{$i['Fstart3']}><br/>
                        用户喜爱度: <{$i['Fstart4']}>
                    </p>
                </td>
                <td ><{$i['Fcomment_content']}></td>
                <td class="js-comment-status"><{if $i['Fcomment_approved'] eq 0}>禁用<{elseif $i['Fcomment_approved'] eq 1 }>启用<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcomment_date']}></td>
                <td>
                    <{if 'product/statuscomment'|hasPower}>
                    <{if $i['Fcomment_approved'] eq 0}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">通过审核</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fcomment_approved'] eq 1}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">审核不通过</button>
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
