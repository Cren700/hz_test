<{include file="public/header.tpl"}>
<body>
<{include file="public/header_back.tpl"}>
<section class="content" id="section_content" style="padding-top: 1rem">
    <div class="new_item">

    </div>
</section>
<input type="hidden" value="<{$option['store_id']|default:''}>" name="id">
<input type="hidden" value="<{$option['type']|default:''}>" name="type">
<{include file='public/footer.tpl'}>
</body>
</html>