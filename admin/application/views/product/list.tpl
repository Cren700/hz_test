
<!--table info-->
<{if count($info['list']) eq 0}>
<div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">温馨提示!</h4>
    无相应的产品信息
</div>
<{else}>
<div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" id="bacth_selected">&nbsp;全选</th>
            <th>ID</th>
            <th>产品名称</th>
            <th>分类</th>
            <th>商家名称</th>
            <th>产品价格</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>状态</th>
            <th>编辑</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fproduct_id']}>" class="tdWrap">
                <td><input type="checkbox" class="js-checkbox-sub" ref="<{$i['Fproduct_id']}>"></td>
                <td><{$i['Fproduct_id']}></td>
                <td>
                    <a href="<{"/product/detail/"|cat:$i['Fproduct_id']|cat:'?_d=1'|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a>
                </td>
                <td><{$cate[$i['Fcategory_id']]}></td>
                <td><{$i['Fstore_name']}></td>
                <td><{$i['Fproduct_price']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td class="js-product-status"><{if $i['Fis_del']}>已删除<{elseif $i['Fproduct_status'] eq 1}>待审核<{elseif $i['Fproduct_status'] eq 2}>通过<{elseif $i['Fproduct_status'] eq 3}>下架<{elseif $i['Fproduct_status'] eq 4}>已完成<{else}>不通过<br><span class="checkNotApproved min-btn btn-primary" style="cursor: pointer">查看原因</span><p style="display: none"><{$i['Fremark']}></p><{/if}></td>
                <td>
                    <{if 'product/detail'|hasPower}>
                    <a href="<{"/product/detail/"|cat:$i['Fproduct_id']|getBaseUrl}>" title="<{$i['Fproduct_name']}>">编辑</a>
                    <{/if}>
                </td>
                <td>
                    <{if 'product/status'|hasPower}>
                    <{if $i['Fis_del']}>
                        <button class="btn btn-danger btn-mini js-btn-recycle">还原</button>
                    <{elseif $i['Fproduct_status'] eq 1}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="5">不通过</button>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">通过</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fproduct_status'] eq 2}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">下架</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fproduct_status'] eq 3}>
                        <button class="btn btn-info btn-mini js-btn-status" data-status="1">待审核</button>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">通过</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fproduct_status'] eq 5}>
                        <button class="btn btn-info btn-mini js-btn-status" data-status="1">待审核</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{else}>
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
