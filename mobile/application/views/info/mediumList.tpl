
<{if $info['list']|default:array()}>
    <{foreach $info['list'] as $l}>
    <div class="nav_list_item show" id="container">
        <div class="nav_list_item_jj" id="art286">
            <div class="nav_list_item_jj_l">
                <a href="<{'/posts?id='|cat:$l['Fid']|getBaseUrl}>"><{$l['Fpost_title']}></a>
                <p>
                    • <span><{$l['Fpost_author']}></span><span class="js-date-dif" rel="<{$l['Fcreate_time']}>"></span>
                    <span><{if $l['Fpost_status'] eq 1 }>待审核<{elseif $l['Fpost_status'] eq 2}>审核不通过<{elseif $l['Fpost_status'] eq 3}>已发布<{else}>已下架<{/if}></span>
                </p>
            </div>
            <div class="nav_list_item_jj_r">
                <img class="lazy beforeEnd" src="<{$l['Fpost_coverimage']}>" alt="<{$l['Fpost_title']}>">
            </div>
        </div>
    </div>
    <{/foreach}>
<{/if}>