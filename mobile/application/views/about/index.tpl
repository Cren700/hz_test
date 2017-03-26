<{include file="public/header.tpl"}>
<body>
<section>
    <div class="about_sec">
        <{foreach $info as $i}>
        <h2><{$i['Ftypename']}></h2>
        <article>
            <{$i['Fcontent']}>
        </article>
        <{/foreach}>
    </div>
</section>
<{include file="public/footer.tpl"}>
</body>
</html>