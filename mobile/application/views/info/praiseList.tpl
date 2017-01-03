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
        <li><a href="<{'/posts.html?id='|cat:$list['Fpraise_post_id']|getBaseUrl}>"><{$list['Fpraise_post_id']}></a></li>
        <{/foreach}>
    </ul>
</div>
</body>
</html>