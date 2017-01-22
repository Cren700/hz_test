<{include file='public/header.tpl'}>
<body>
<!--header part-->
<{include file="public/header_part.tpl"}>

<!--end header part-->

<!--sidebar-menu-->
<{include file='public/menu.tpl'}>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
    <{include file='public/nav.tpl'}>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>专题中资讯列表</h5>
                        <a class="label label-info" id="js-btn-add-posts" href="javascript:;">添加资讯</a>
                    </div>
                    <div id="posts-list-content">
                        <!--table info-->
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>标题</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <{foreach $posts as $i}>
                                    <tr rel="<{$i['Fid']}>">
                                        <td><{$i['Fid']}></td>
                                        <td><a href="<{"/posts/detail/"|cat:$i['Fid']|getBaseUrl}>" title="<{$i['Fpost_title']}>"><{$i['Fpost_title']}></a></td>
                                        <td>
                                            <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                                        </td>
                                    </tr>
                                <{/foreach}>
                                </tbody>
                            </table>
                        </div>
                        <!--end table info-->
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="post_id" value="<{$theme['Fpost_id']}>">
        <input type="hidden" name="id" value="<{$theme['Fid']}>">
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
