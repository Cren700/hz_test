
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
            <th>ID</th>
            <th>标题</th>
            <th>发布者</th>
            <th>作者</th>
            <th>分类</th>
            <th>封面</th>
            <th>状态</th>
            <th>发布时间</th>
            <th>最后修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>">
                <td><{$i['Fid']}></td>
                <td><a href="<{"/posts/detail/"|cat:$i['Fid']|getBaseUrl}>" title="<{$i['Fpost_title']}>"><{$i['Fpost_title']}></a></td>
                <td><{$i['Fuser_id']}></td>
                <td><{$i['Fpost_author']}></td>
                <td><{$cate[$i['Fpost_category_id']]|default:''}></td>
                <td><img style="width: 100px; height:75px; <{if !isset($i['Fpost_coverimage']) || !$i['Fpost_coverimage']}>display: none<{/if}>" src="<{$i['Fpost_coverimage']|default:''}>" title ="<{$i['Fpost_title']}>" alt="<{$i['Fpost_title']}>" ></td>
                <td class="js-posts-status"><{if $i['Fis_del']}>已删除<{elseif $i['Fpost_status'] eq 1 }>待审核<{elseif $i['Fpost_status'] eq 2}>审核不通过<{elseif $i['Fpost_status'] eq 3}>已发布<{else}>已下架<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td>
                    <{if $i['Fis_del']}>
                        <button class="btn btn-danger btn-mini js-btn-recycle">还原</button>
                    <{elseif $i['Fpost_status'] eq 1}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">审核不通过</button>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">发布</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fpost_status'] eq 2}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="1">提交审核</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fpost_status'] eq 3}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="4">下架</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{else}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="1">提交审核</button>
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
