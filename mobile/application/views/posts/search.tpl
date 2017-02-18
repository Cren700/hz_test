<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_box.tpl"}>
</div>
<{if $info['code'] eq 0}>
<section class="content" id="section_content" style="padding-top: 1rem">
    <div class="new_item_shape">
        <{assign var=preg value='/'|cat:$keyword|cat:'/'}>
        <{assign var=rep value='<span style="color:red; margin-right:0">'|cat:$keyword|cat:'</span>'}>
        <{foreach $info['data']['list'] as $l}>
        <{if $l['Fpost_coverimage']}>
        <div class="new_shape_one">
            <a href="<{'/posts?id='|cat:$l['Fid']|getBaseUrl}>" title="<{$l['Fpost_title']}>" class="article_link">
                <div class="article_txt">
                    <h3><{$preg|preg_replace:$rep:$l['Fpost_title']}></h3>
                    <div class="item_info">
                        <span><{$preg|preg_replace:$rep:$l['Fpost_author']}></span>
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
    </div>
</section>
<{else}>

<section class="content" id="section_content">
    <div class="nav_list_item show">
        <div class="nodata">
            <div class="nodata_img">
                <img src="<{'no_data.png'|baseImgUrl}>">
            </div>
            <p class="nodata_txt"><{if isset($info.msg)}><{$info.msg}><{else}>暂无数据<{/if}></p>
        </div>
    </div>
</section>
<{/if}>
<{include file="public/footer.tpl"}>
</body>
</html>