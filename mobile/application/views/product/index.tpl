<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_product_box.tpl"}>
    <nav class="home_nav">
        <div class="nav_list">
            <a href="<{'/product.html'|getBaseUrl}>" class="header_nav<{if $cate_id eq ''}> select<{/if}>">所有计划</a>
            <{foreach $cate as $c}>
            <a href="<{'/product?id='|cat:$c['Fcategory_id']|getBaseUrl}>" class="header_nav <{if $cate_id eq $c['Fcategory_id']}> select<{/if}>"><{$c['Fcategory_name']}></a>
            <{/foreach}>
        </div>
        <div class="top_menu_more">
            <div class="list_shadow"></div>
            <a href="javascript:void(0);" class="more_btn"></a>
        </div>
    </nav>
    <input type="hidden" name="cate_id" value="<{$cate_id}>">
</div>
<section class="content" id="section_content">
    <div class="new_item">

    </div>
</section>

<{include file='public/footer.tpl'}>
</body>
</html>