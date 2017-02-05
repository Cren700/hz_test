
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
<{/foreach}>