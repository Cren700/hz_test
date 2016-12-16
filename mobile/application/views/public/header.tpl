<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <meta name="description" content="<{$seo['description']}>">
    <meta name="keywords" content="<{$seo['keywords']}>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=yes">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="<{''|getBaseUrl}>static/css/amazeui.min.css" rel="stylesheet" type="text/css">
    <link href="<{''|getBaseUrl}>static/css/common/window_dialog.css" rel="stylesheet" type="text/css">
    <link href="<{''|getBaseUrl}>static/css/common/public.css" rel="stylesheet" type="text/css">
    <{foreach $cssArr as $css}>
        <link href="<{$css['url']|getBaseUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
    <title><{$seo['title']}></title>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div>
    <a href="<{''|getBaseUrl}>">首页</a>
    <{if !$uid}><a href="<{'/login.html'|getBaseUrl}>">登录</a><{/if}>
    <{if !$uid}><a href="<{'/account/register.html'|getBaseUrl}>">注册</a><{/if}>
</div>