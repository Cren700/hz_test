
<{foreach $list as $l}>
<{if $l['Fpost_coverimage']}>
<div class="new_shape_one">
    <a href="<{'/posts?id='|cat:$l['Fid']|getBaseUrl}>" title="<{$l['Fpost_title']}>" class="article_link">
        <div class="article_txt">
            <h3><{$l['Fpost_title']}></h3>
            <div class="item_info">
                <span><{$l['Fpost_author']}></span>
                <span class="js-date-dif" rel="<{$l['Fupdate_time']}>"></span>
            </div>
        </div>
        <div class="article_img">
            <img src="<{$l['Fpost_coverimage']}>">
        </div>
    </a>
</div>
<{elseif $l['Fpost_coverimage'] eq null}>
<div class="new_shape_two">
    <a href="<{'/posts?id='|cat:$l['Fid']|getBaseUrl}>" title="<{$l['Fpost_title']}>" class="article_link">
        <h3><{$l['Fpost_title']}></h3>
        <div class="item_info">
            <span><{$l['Fpost_author']}></span>
            <span class="js-date-dif" rel="<{$l['Fupdate_time']}>"></span>
        </div>
    </a>
</div>
<{/if}>
<!--
<div class="new_shape_three">
    <a href="articlex.html" class="article_link">
        <h3>5家网络互助保障平台用户数超百万人年内行业融资过亿</h3>
        <div class="article_img">
            <div class="article_img_item">
                <img src="image/106.jpg">
            </div>
            <div class="article_img_item">
                <img src="image/101.jpg">
            </div>
            <div class="article_img_item">
                <img src="image/103.jpg">
            </div>
        </div>
        <div class="item_info">
            <span>互助之家的朋友们</span>
            <span>2小时前</span>
        </div>
    </a>
</div>-->
<{/foreach}>