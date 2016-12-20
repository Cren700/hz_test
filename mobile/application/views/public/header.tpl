<!DOCTYPE html>
<html lang="en">
<head>
    <title><{$seo['title']}></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="<{"style.css"|baseCssUrl}>" />
    <{foreach $cssArr as $css}>
<link href="<{$css|baseCssUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
</head>