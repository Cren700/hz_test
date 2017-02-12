<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container clearfix">
    <div class="topice_banner">
        <a href="<{$theme['Furl']|cat:'?id='|cat:$id}>">
            <img src="<{$theme['data']['Fbanner_path']|default:''}>" alt="">
        </a>
    </div>
    <div class="topice_h2">
        <span>专题文章</span>
        <em>&nbsp;</em>
    </div>
    <{if $theme['postList']}>
    <div class="topice_jj">
        <ul class="clearfix">
            <{foreach $theme['postList'] as $l}>
            <li>
                <a href="<{'/posts.html?id='|cat:$l['Fid']|getBaseUrl}>">
                    <div class="topice_jj_img">
                        <img src="<{$l['Fpost_coverimage']}>" alt="">
                    </div>
                    <div class="topice_jj_txt">
                        <h3><{$l['Fpost_title']}></h3>
                        <div class="topic_txt_box">
                            <p><{$l['Fpost_excerpt']}></p>
                        </div>
                    </div>
                </a>
            </li>
            <{/foreach}>
        </ul>
    </div>
    <{/if}>
</div>
<{include file="public/footer.tpl"}>
</body>
</html>