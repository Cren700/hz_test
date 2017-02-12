<{include file="public/header.tpl"}>
<body>
<div class="wrap">
    <{include file="public/header_box.tpl"}>
</div>
<section class="content" style="padding-top: 1rem">
    <div class="topic_content">
        <div class="topic_content_list">
            <ul id="container">
                <{if isset($theme['list'])}>
                <{foreach $theme['list'] as $l}>
                <li>
                    <div class="topice_list_img">
                        <a href="<{'/theme/posts.html?id='|cat:$l['Fid']|getBaseUrl}>" target="_blank">
                            <img src="<{$l['Ftheme_coverimage']}>" alt="<{$l['Ftheme_title']}>"></a>
                    </div>
                    <div class="topice_list_txt">
                        <p><{$l['Ftheme_title']}></p>
                    </div>
                </li>
                <{/foreach}>
                <{/if}>
            </ul>
        </div>
    </div>
    <input type="hidden" name="cate_id" value="<{$cate_id|default:''}>">
</section>
<{include file="public/footer.tpl"}>
</body>
</html>