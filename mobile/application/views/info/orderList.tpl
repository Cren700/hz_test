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
        <li><{$list['Forder_no']}> <{$list['Fproduct_name']}> </li>
        <{/foreach}>
    </ul>
</div>
</body>
</html>