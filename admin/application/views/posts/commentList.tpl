
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
            <th>标题</th>
            <th>评论者</th>
            <th>评论者IP</th>
            <th class="span5">内容</th>
            <th>状态</th>
            <th>评论时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fcomment_id']}>">
                <td><a href="<{"/posts/detail/"|cat:$i['Fcomment_post_id']|getBaseUrl}>" title="<{$i['Fpost_title']}>"><{$i['Fpost_title']}></a></td>
                <td><{$i['Fcomment_author_name']}></td>
                <td><{$i['Fcomment_author_ip']}></td>
                <td ><{$i['Fcomment_content']}></td>
                <td class="js-comment-status"><{if $i['Fcomment_approved'] eq 0}>待审核<{elseif $i['Fcomment_approved'] eq 1 }>通过审核<{elseif $i['Fcomment_approved'] eq 2}>审核不通过<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcomment_date']}></td>
                <td>
                    <{if $i['Fcomment_approved'] eq 0}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="1">通过审核</button>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="2">审核不通过</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fcomment_approved'] eq 1}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="0">待审核</button>
                    <button class="btn btn-warning btn-mini js-btn-status" data-status="2">审核不通过</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fcomment_approved'] eq 2}>
                    <button class="btn btn-warning btn-mini js-btn-status" data-status="0">待审核</button>
                    <button class="btn btn-primary btn-mini js-btn-status" data-status="1">通过审核</button>
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
