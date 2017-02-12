<!DOCTYPE html>
<html lang="en" style="font-size: 37.5px;">
<head>
    <title><{$seo['title']}></title>
    <meta charset="UTF-8" />
    <meta name="description" content="<{$seo['description']}>">
    <meta name="keywords" content="<{$seo['keywords']}>">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <{foreach $cssArr as $css}>
<link href="<{$css|baseCssUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
    <link rel="stylesheet" href="<{"style.css"|baseCssUrl}>" />
    <link rel="stylesheet" href="<{"layer.css"|baseCssUrl}>" />
</head>
<body>

<div class="topic_banner">
    <a href="<{$theme['data']['Fmurl']|default:'#'}>"><img class="lazy beforeEnd" src="<{$theme['data']['Ftheme_coverimage']}>" alt="<{$theme['data']['Ftheme_title']}>"></a>
</div>
<div class="">
    <div class="topic_Introduction">
        <p><a href="<{$theme['data']['Fmurl']|default:'#'}>"><{$theme['data']['Ftheme_excerpt']}></a></p>
    </div>
    <div class="topic_detail_list">
        <ul>
            <{foreach $theme['postList'] as $l}>
            <li>
                <div class="topic_datail">
                    <a href="<{'/posts.html?id='|cat:$l['Fid']|getBaseUrl}>">
                        <div class="topic_datail_txt">
                            <h3><{$l['Fpost_title']}></h3>
                            <div class="topic_info">
                                <span><{$l['Fpost_author']}></span>
                                <span class="js-date-dif" rel="<{$l['Fcreate_time']}>"></span>
                            </div>
                        </div>
                        <div class="topic_datail_img">
                            <img class="lazy beforeEnd" src="<{$l['Fpost_coverimage']}>">
                        </div>
                    </a>
                </div>
            </li>
            <{/foreach}>
        </ul>
    </div>
</div>


<!-- Page footer-->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date(); a = s.createElement(o),
                m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-89300241-1', 'auto');
    ga('send', 'pageview');
</script>
<{include file="public/no_nav_footer.tpl"}>
</body></html>