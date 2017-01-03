<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div>
    <ul>
        <{foreach $info['list'] as $list}>
        <li><a href="<{'/product/detail/'|cat:$list['Fproduct_id']|getBaseUrl}>"><{$list['Fproduct_name']}></a></li>
        <{/foreach}>
    </ul>
</div>
</body>
</html>