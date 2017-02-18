<?php /* Smarty version Smarty-3.1.19, created on 2016-11-27 11:55:55
         compiled from "application/views/public/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60480532583a594b55d382-11056974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30c3c378622ad7446954bcb852702022e1e2cc65' => 
    array (
      0 => 'application/views/public/footer.tpl',
      1 => 1476112296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60480532583a594b55d382-11056974',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'jsArr' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_583a594b572ba5_07718992',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583a594b572ba5_07718992')) {function content_583a594b572ba5_07718992($_smarty_tpl) {?><script src="<?php echo getBaseUrl('');?>
/static/js/common/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo getBaseUrl('');?>
/static/js/common/global.js"></script>
<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['jsArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
    <script type="text/javascript" src="<?php echo getBaseUrl($_smarty_tpl->tpl_vars['js']->value['url']);?>
"></script>
<?php } ?>
<?php }} ?>
