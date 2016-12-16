<?php /* Smarty version Smarty-3.1.19, created on 2016-12-09 00:02:49
         compiled from "application/views/public/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1631420905584984299401d3-58465728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36209aae9cbb241d25303db24181f2120f2f6b0c' => 
    array (
      0 => 'application/views/public/footer.tpl',
      1 => 1476112296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1631420905584984299401d3-58465728',
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
  'unifunc' => 'content_58498429950d45_82271524',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58498429950d45_82271524')) {function content_58498429950d45_82271524($_smarty_tpl) {?><script src="<?php echo getBaseUrl('');?>
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
