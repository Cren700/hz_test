<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>
    <meta name="description" content="<{$seo['description']}>">
    <meta name="keywords" content="<{$seo['keywords']}>">
    <title><{$seo['title']}></title>
    <link rel="stylesheet" href="<{"style.css"|baseCssUrl}>" />
    <{foreach $cssArr as $css}>
        <link href="<{$css|baseCssUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
</head>