<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <header>
        <div class="row">
            <div class="col-xs-4">
                <a href="<{''|getBaseUrl}>" class="logo">
                    <img src="<{'logo.png'|baseImgUrl}>">
                </a>
            </div>
            <div class="col-xs-8">
                <form class="search_form" method="post">
                    <i class="search_icon">&nbsp;</i>
                    <div class="search_txt">
                        <input type="search" name="" placeholder="搜你想搜的">
                    </div>
                    <i class="search_close">&nbsp;</i>
                </form>
            </div>
        </div>
    </header>
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
    <div id="new_item_shape">

    </div>
    <a href="javascript:;" class="js-next-page">Next</a>
    <input type="hidden" name="cate_id" value="<{$cate_id|default:''}>">
</section>
<{include file="public/footer.tpl"}>
</body>
</html>