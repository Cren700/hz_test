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
</div>
<section class="content" id="section_content">
    <div class="new_item_shape" style="margin-top: -1rem">

    </div>
    <a href="javascript:;" class="js-next-page">Next</a>
    <input type="hidden" name="cate_id" value="<{$cate_id|default:''}>">
</section>
<{include file="public/footer.tpl"}>
</body>
</html>