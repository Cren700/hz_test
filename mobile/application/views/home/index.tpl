<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_box.tpl"}>
    <nav class="home_nav">
        <div class="nav_list">
            <a href="<{''|getBaseUrl}>" class="header_nav <{if $cate_id eq ''}> select<{/if}>">最新</a>
            <{foreach $cate as $c}>
                <a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>" class="header_nav <{if $cate_id eq $c['Fpost_category_id']}> select<{/if}>"><{$c['Fcategory_name']}></a>
            <{/foreach}>
        </div>
        <div class="top_menu_more">
            <div class="list_shadow"></div>
            <a href="javascript:void(0);" class="more_btn"></a>
        </div>
    </nav>
</div>
<section class="content" id="section_content">
    <div class="new_item_shape">

    </div>
    <input type="hidden" name="cate_id" value="<{$cate_id|default:''}>">
</section>
<{include file="public/footer.tpl"}>
</body>
</html>