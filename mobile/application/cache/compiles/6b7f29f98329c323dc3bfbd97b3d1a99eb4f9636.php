<?php /* Smarty version Smarty-3.1.19, created on 2016-11-27 11:57:59
         compiled from "application/views/public/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1666358433583a594b4ffe42-55388092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '08673d22179c0df1c1abd797f4a1fea4bee911f5' => 
    array (
      0 => 'application/views/public/header.tpl',
      1 => 1480219077,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1666358433583a594b4ffe42-55388092',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_583a594b551859_70644408',
  'variables' => 
  array (
    'seo' => 0,
    'cssArr' => 0,
    'css' => 0,
    'uid' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583a594b551859_70644408')) {function content_583a594b551859_70644408($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['description'];?>
">
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['keywords'];?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=yes">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="<?php echo getBaseUrl('');?>
static/css/amazeui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getBaseUrl('');?>
static/css/common/window_dialog.css" rel="stylesheet" type="text/css">
    <link href="<?php echo getBaseUrl('');?>
static/css/common/public.css" rel="stylesheet" type="text/css">
    <?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cssArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
        <link href="<?php echo getBaseUrl($_smarty_tpl->tpl_vars['css']->value['url']);?>
" rel="stylesheet" type="text/css">
    <?php } ?>
    <title><?php echo $_smarty_tpl->tpl_vars['seo']->value['title'];?>
</title>
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
    <a href="<?php echo getBaseUrl('');?>
">首页</a>
    <?php if (!$_smarty_tpl->tpl_vars['uid']->value) {?><a href="<?php echo getBaseUrl('/login.html');?>
">登录</a><?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['uid']->value) {?><a href="<?php echo getBaseUrl('/account/register.html');?>
">注册</a><?php }?>
</div><?php }} ?>
