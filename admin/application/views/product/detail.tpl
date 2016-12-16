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
                    <div class="widget-title"> <span class="icon"> <i class="icon-list-alt"></i> </span>
                        <h5><{if $is_new}>添加产品<{else}>产品详情<{/if}></h5>
                    </div>
                    <form action="<{'/product/save.html'|getBaseUrl}>" method="post" class="form-horizontal" id="form">
                        <div class="widget-content nopadding">
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品名称</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_name" placeholder="产品名称" value="<{$product['Fproduct_name']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品分类</label>
                                    <div class="controls">
                                        <select name="category_id" class="span11" id="category_id">
                                            <option value="">请选择产品分类</option>
                                            <{foreach $cate['list'] as $c}>
                                            <option value="<{$c.Fcategory_id}>" <{if isset($product['Fcategory_id']) && $product['Fcategory_id'] eq $c.Fcategory_id }>selected<{/if}>><{$c.Fcategory_name}></option>
                                            <{/foreach}>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品库存</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_num" placeholder="产品库存" value="<{$product['Fproduct_num']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品价格</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="product_price" placeholder="产品价格" value="<{$product['Fproduct_price']|default:''}>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span12">
                                    <label class="control-label">产品备注</label>
                                    <div class="controls">
                                        <textarea class="span11" name="remark" placeholder="产品备注"><{$product['Fremark']|default:''}></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" class="btn btn-success js-btn-submit" value="提 交" />
                                <a href="<{'/product.html'|getBaseUrl}>" class="btn" title="返回列表">返回列表</a>
                            </div>
                            <input type="hidden" name="product_id" value="<{$product['Fproduct_id']|default:''}>">
                            <input type="hidden" name="is_new" value="<{$is_new}>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end-main-container-part-->


<{include file="public/footer.tpl"}>
</body>
</html>
