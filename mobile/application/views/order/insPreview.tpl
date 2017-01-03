<{include file="public/header.tpl"}>
<body>
<{if $info['Fproduct']['Fproduct_status'] eq 2}>

订单信息:
<{$info['Fproduct']['Fproduct_name']}>
<br><{$info['Fproduct']['Fproduct_price']}>
<br>1
<br><{$info['Fproduct']['Fproduct_price']}>
<{else }>
不能下单啦
<{/if}>
<a href="<{'/order/insCreate.html?id='|cat:$info['Fproduct']['Fproduct_id']|getBaseUrl}>">确定</a>
<{include file='public/footer.tpl'}>
</body>
</html>