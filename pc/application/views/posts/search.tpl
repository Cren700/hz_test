<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="search_box">
    <div class="search_box_com">
        <div class="search_jj clearfix">
            <form name="search_form" method="get" action="<{'/posts/search'|getBaseUrl}>">
                <input type="text" name="keyword" class="search_txt"  value="<{$keyword|default:''}>">
                <input type="button"  class="search_btn" value="站内搜索" name="">
            </form>
        </div>
        <div class="search_result_list">
            <ul class="clearfix">
                <li <{if $type == 'posts'}> class="active"<{/if}> id="search_posts_btn">资讯</li>
                <li <{if $type == 'product'}> class="active"<{/if}> id="search_product_btn">产品</li>
            </ul>
            <p>含"<span class="search_keyword"><{$keyword}></span>"的搜索结果约<span><{if ($info['code'] == 0) }><{count($info['data'])}><{else}>0<{/if}></span>条</p>
        </div>
        <div class="search_result_item_box">
            <div class="search_result_item">
                <{if $info['code'] == 0}>
                <{assign var=preg value='/'|cat:$keyword|cat:'/'}>
                <{assign var=rep value='<span class="search_dent">'|cat:$keyword|cat:'</span>'}>
                <{foreach $info['data']['list'] as $l}>
                <div class="search_result_item_jj clearfix">
                    <div class="search_item_img">
                        <a href="<{'/posts.html?id='|cat:$l['Fid']|getBaseUrl}>">
                            <img src="<{$l['Fpost_coverimage']}>">
                        </a>
                    </div>
                    <div class="search_item_txt">
                        <h2><a href="<{'/posts.html?id='|cat:$l['Fid']|getBaseUrl}>"><{$preg|preg_replace:$rep:$l['Fpost_title']}></a>
                        </h2>
                        <p class="search_item_text"><{$preg|preg_replace:$rep:$l['Fpost_excerpt']}></p>
                        <p class="info_left">
                            ● <span class="info_name"><{$preg|preg_replace:$rep:$l['Fpost_author']}></span>
                            ● <span class="info_time js-date-dif" rel="<{$l['Fupdate_time']}>"></span>
                        </p>
                    </div>
                </div>
                <{/foreach}>
                <{/if}>
            </div>
        </div>
    </div>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>