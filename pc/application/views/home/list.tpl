<{foreach $list as $l}>
    <li>
        <div class="clearfix">
            <div class="list_item_img">
                <img class="lazy" width="175px" height="120px" src="<{$l['Fpost_coverimage']}>">
            </div>
            <div class="list_item_txt">
                <h2>
                    <a href="<{'/posts.html?id='|cat:$l['Fid']|getBaseUrl}>"><{$l['Fpost_title']}></a>
                </h2>
                <p><{$l['Fpost_excerpt']}></p>
                <div class="upload_info">
                    <p class="info_left">
                        ● <span class="info_name"><{$l['Fpost_author']}></span>
                        ● <span class="info_time js-date-dif" rel="<{$l['Fupdate_time']}>"></span>
                    </p>
                    <{if $l['Fpost_keyword']}>
                    <p class="info_right">
                        <i>&nbsp;</i>
                        <{assign var=keyword value=('、'|explode:$l['Fpost_keyword'])}>
                        <{foreach $keyword as $k}>
                            <a href=""><{$k}></a>
                        <{/foreach}>
                    </p>
                    <{/if}>
                </div>
            </div>
        </div>
    </li>
<{/foreach}>

