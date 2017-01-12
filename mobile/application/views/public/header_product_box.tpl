
<header>
    <div class="row">
        <div class="col-xs-4">
            <a href="<{''|getBaseUrl}>" class="logo">
                <img src="<{'logo.png'|baseImgUrl}>">
            </a>
        </div>
        <div class="col-xs-8">
            <form class="search_form" id="js-search_form" action="<{'/product/search.html'|getBaseUrl}>" method="get">
                <i class="search_icon">&nbsp;</i>
                <div class="search_txt">
                    <input type="search" id="js-txt-search" value="<{$keyword|default:''}>" name="keyword" autocomplete="off" placeholder="搜你想搜的">
                </div>
                <i class="search_close">&nbsp;</i>
            </form>
        </div>
    </div>
</header>