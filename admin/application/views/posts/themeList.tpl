
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
            <th><input type="checkbox" id="bacth_selected">&nbsp;全选</th>
            <th>ID</th>
            <th>标题</th>
            <th>发布者ID</th>
            <th>专题图片</th>
            <th>Banner图片</th>
            <th>状态</th>
            <th>发布时间</th>
            <th>最后修改时间</th>
            <th>资讯</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fid']}>">
                <td><input type="checkbox" class="js-checkbox-sub" ref="<{$i['Fid']}>"></td>
                <td><{$i['Fid']}></td>
                <td><a href="<{"/posts/detailTheme/"|cat:$i['Fid']|getBaseUrl}>" title="<{$i['Ftheme_title']}>"><{$i['Ftheme_title']}></a></td>
                <td><{$i['Fuser_id']}></td>
                <td><img style="width: 100px; height:75px; <{if !isset($i['Ftheme_coverimage']) || !$i['Ftheme_coverimage']}>display: none<{/if}>" src="<{$i['Ftheme_coverimage']|default:''}>" title ="<{$i['Ftheme_title']}>"alt="<{$i['Ftheme_title']}>" ></td>
                <td><img style="width: 100px; height:75px; <{if !isset($i['Fbanner_path']) || !$i['Fbanner_path']}>display: none<{/if}>" src="<{$i['Fbanner_path']|default:''}>" title ="<{$i['Ftheme_title']}>"alt="<{$i['Ftheme_title']}>" ></td>
                <td class="js-posts-status"><{if $i['Ftheme_status'] eq 0 }>下架<{elseif $i['Ftheme_status'] eq 1}>上架<{/if}></td>
                <td><{'y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td><a href="<{'/posts/postsTheme.html?id='|cat:$i['Fid']|getBaseUrl}>">查看资讯</a></td>
                <td>
                    <{if 'posts/statustheme'|hasPower}>
                    <{if $i['Ftheme_status'] eq 0}>
                        <button class="btn btn-success btn-mini js-btn-status" data-status="1">上架</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Ftheme_status'] eq 1}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="0">下架</button>
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
