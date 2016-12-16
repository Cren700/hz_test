
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
            <th>ID</th>
            <th>产品名称</th>
            <th>分类</th>
            <th>商家名称</th>
            <th>产品库存</th>
            <th>产品价格</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <{foreach $info['list'] as $i}>
            <tr rel="<{$i['Fproduct_id']}>">
                <td><{$i['Fproduct_id']}></td>
                <td><a href="<{"/product/detail/"|cat:$i['Fproduct_id']|getBaseUrl}>" title="<{$i['Fproduct_name']}>"><{$i['Fproduct_name']}></a></td>
                <td><{$cate[$i['Fcategory_id']]}></td>
                <td><{$i['Fstore_id']}></td>
                <td><{$i['Fproduct_num']}></td>
                <td><{$i['Fproduct_price']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fcreate_time']}></td>
                <td><{'Y-m-d H:i'|date:$i['Fupdate_time']}></td>
                <td class="js-product-status"><{if $i['Fis_del']}>已删除<{elseif $i['Fproduct_status'] eq 1 }>待审核<{elseif $i['Fproduct_status'] eq 2}>已上架<{elseif $i['Fproduct_status'] eq 3}>下架<{else}>已完成<{/if}></td>
                <td>
                    <{if $i['Fis_del']}>
                        <button class="btn btn-danger btn-mini js-btn-recycle">还原</button>
                    <{elseif $i['Fproduct_status'] eq 1}>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">上架</button>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">下架</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fproduct_status'] eq 2}>
                        <button class="btn btn-warning btn-mini js-btn-status" data-status="3">下架</button>
                        <button class="btn btn-success btn-mini js-btn-status" data-status="4">已完成</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{elseif $i['Fproduct_status'] eq 3}>
                        <button class="btn btn-info btn-mini js-btn-status" data-status="1">审核不通过</button>
                        <button class="btn btn-primary btn-mini js-btn-status" data-status="2">上架</button>
                        <button class="btn btn-danger btn-mini js-btn-delete">删除</button>
                    <{else}>
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
