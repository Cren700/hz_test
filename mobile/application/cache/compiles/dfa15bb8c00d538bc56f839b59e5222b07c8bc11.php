<?php /* Smarty version Smarty-3.1.19, created on 2016-12-09 00:03:17
         compiled from "application/views/login/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1465231274584984298dabf3-91642753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ae1753482f3ae9683282286cc33c6adf5ed1ca3' => 
    array (
      0 => 'application/views/login/index.tpl',
      1 => 1481212996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1465231274584984298dabf3-91642753',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5849842990bfc2_03166466',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5849842990bfc2_03166466')) {function content_5849842990bfc2_03166466($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('public/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <h1 class="am-login-t">登录</h1>
        <hr class="am-login-hr">
        <br>

        <form id="form" class="am-form" action="/login/loginHandel.html" method="post">
            <label for="phone">手机号码:<input type="text" value="13631255371" name='phone'></label>
            <label for="password">密码:<input type="password" value="123456" name='pwd'></label>

            <label for="vc">验证码:
                <input type="text" value="" name="vc" autocomplete="off">
                <div class="am-form-vc">
                    <button id="js-get-vc" >获取验证码</button>
                    <img id="js-vc-img" class="am-form-vc-img" src="" alt="">
                </div>
            </label>
            <label for="remember-me">
                <input id="remember-me" type="checkbox">
                记住密码
            </label>
            <div class="am-cf">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
            </div>
        </form>
        <p>© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>

</body>
<?php echo $_smarty_tpl->getSubTemplate ("public/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</html><?php }} ?>
