<{include file="public/header.tpl"}>
<body>
<{include file='public/nav.tpl'}>
<div class="container">
    <div class="nav_tab pro_nav nav_tab_width">
        <ul class="clearfix">
            <li class="<{if $cate_id eq ''}> active<{/if}>"><a href="<{'/product.html'|getBaseUrl}>" ">所有计划</a></li>
            <{foreach $cate as $c}>
            <li class="<{if $cate_id eq $c['Fcategory_id']}> active<{/if}>"> <a href="<{'/product?id='|cat:$c['Fcategory_id']|getBaseUrl}>"><{$c['Fcategory_name']}></a></li>
            <{/foreach}>
        </ul>
    </div>
    <div class="tab_list">
    </div>
    <input type="hidden" name="cate_id" value="<{$cate_id}>">
    <input type="hidden" name="collect" value="<{$collect}>">
</div>
<{include file="public/footer.tpl"}>
</body>
</html>