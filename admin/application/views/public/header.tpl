<!DOCTYPE html>
<html lang="en">
<head>
    <title><{$seo['title']}></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<{"bootstrap.min.css"|baseCssUrl}>" />
    <link rel="stylesheet" href="<{"matrix-style.css"|baseCssUrl}>" />
    <link rel="stylesheet" href="<{"matrix-media.css"|baseCssUrl}>" />
    <link href="<{"/static/font-awesome/css/font-awesome.css"|getBaseUrl}>" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <{foreach $cssArr as $css}>
    <link href="<{$css|baseCssUrl}>" rel="stylesheet" type="text/css">
    <{/foreach}>
</head>