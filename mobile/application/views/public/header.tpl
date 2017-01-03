<!DOCTYPE html>
<html lang="en">
<head>
    <title><{$seo['title']}></title>
    <meta charset="UTF-8" />
    <meta name="description" content="<{$seo['description']}>">
    <meta name="keywords" content="<{$seo['keywords']}>">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <{foreach $cssArr as $css}>
<link href="<{$css|baseCssUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
    <link rel="stylesheet" href="<{"style.css"|baseCssUrl}>" />
    <link rel="stylesheet" href="<{"layer.css"|baseCssUrl}>" />
</head>