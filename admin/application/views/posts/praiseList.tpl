
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
            <th>资讯ID</th>
            <th>标题</th>
            <th>用户名</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr class="tdWrap">
                <td><{$i['Fpraise_post_id']}></td>
                <td><a href="<{"/posts/detail/"|cat:$i['Fpraise_post_id']|getBaseUrl}>" title="<{$i['Fpost_title']}>"><{$i['Fpost_title']}></a></td>
                <td><{$i['Fuser_id']}></td>
            </tr>
            <{/foreach}>
        </tbody>
    </table>
</div>
<{$page}>
<{/if}>
<!--end table info-->
