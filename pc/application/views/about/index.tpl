<{include file="public/header.tpl"}>
<body>
<{include file="public/nav.tpl"}>
<div class="container about_container clearfix">
    <div class="side_about">
        <ul>
            <{foreach $info as $k => $i}>
                <li class="<{if $k eq 0}>active<{/if}>"><{$i['Ftypename']}></li>
            <{/foreach}>
        </ul>
    </div>
    <div class="about_content">

        <{foreach $info as $k => $i}>
        <div class="about_content_jj" id="p<{$k+1}>">
            <h3><{$i['Ftypename']}></h3>
            <{$i['Fcontent']}>
        </div>
        <{/foreach}>
    </div>
</div>
</div>
<{include file='public/footer.tpl'}>
</body>
</html>