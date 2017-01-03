<{include file="public/header.tpl"}>
<body>
<{if $info['Fproduct']['Fproduct_status'] eq 2}>

订单信息:
<{$info['Fproduct']['Fproduct_name']}>
<br><{$info['Fproduct']['Fproduct_price']}>
<br><{$info['FcartInfo']['Fproduct_num']}>
<br><{$info['FcartInfo']['Fproduct_num'] * $info['Fproduct']['Fproduct_price']}>
<{else }>
不能下单啦
<{/if}>
<a href="<{'/order/create.html?id='|cat:$info['FcartInfo']['Fid']|getBaseUrl}>">确定</a>
<{include file='public/footer.tpl'}>
</body>
</html>