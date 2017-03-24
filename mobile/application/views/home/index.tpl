<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_box.tpl"}>
    <nav class="home_nav">
        <div class="nav_list">
            <{foreach $cate as $k => $c}>
                <{if !$cate_id && $k == 0}>
                <a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>" class="header_nav select"><{$c['Fcategory_name']}></a>
                <{assign var='cate_id' value=$c['Fpost_category_id']}>
                <{else}>
                <a href="<{'/home/index?id='|cat:$c['Fpost_category_id']|getBaseUrl}>" class="header_nav <{if $cate_id eq $c['Fpost_category_id']}> select<{/if}>"><{$c['Fcategory_name']}></a>
                <{/if}>
                <{if $k == 0}>
                    <a href="<{'/theme.html'|getBaseUrl}>" class="header_nav">专题</a>
                <{/if}>
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