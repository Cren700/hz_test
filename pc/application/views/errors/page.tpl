<{include file="public/header.tpl"}>
<body>


<{include file="public/no_footer.tpl"}>
<script>
    var msg = '<{$msg|default:"页面未找到,请重试!"}>';
$(function(){
    HZ.Dialog.showMsg({
        title: msg,
        url: baseUrl
    });
})
</script>
</body>
</html>