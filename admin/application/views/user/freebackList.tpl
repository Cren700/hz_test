
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
                <th>反馈ID</th>
                <th>用户联系方式</th>
                <th>反馈类型</th>
                <th>反馈信息</th>
                <th>反馈时间</th>
                <th>最后处理时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <{foreach $info['list'] as $i}>
                <tr rel="<{$i['Fid']}>">
                    <td><{$i['Fid']}></td>
                    <td><{$i['Frelation']}></td>
                    <td><{if $i['Ftype'] eq 1 }>需求报道<{/if}></td>
                    <td><{$i['Fcontent']}></td>
                    <td><{'Y-m-d H:i:s'|date:$i['Fcreate_time']}></td>
                    <td><{'Y-m-d H:i:s'|date:$i['Fupdate_time']}></td>
                    <td class="js-user-status"><{if $i['Fstatus'] eq 0 }>未处理<{else}>已处理<{/if}></td>
                    <td>
                        <{if 'user/freebackstatus'|hasPower}>
                            <{if $i['Fstatus'] eq 0}>
                            <button class="btn btn-primary btn-mini js-btn-status" data-status="1">已处理</button>
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
