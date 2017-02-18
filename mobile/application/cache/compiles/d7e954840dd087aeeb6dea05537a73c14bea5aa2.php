<?php /* Smarty version Smarty-3.1.19, created on 2016-11-27 11:53:10
         compiled from "application/views/login/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1145157118583a57cc7f9699-02170166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c92c0dae64a4e284a74884bcc2e8e21240be2a94' => 
    array (
      0 => 'application/views/login/index.tpl',
      1 => 1480218705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1145157118583a57cc7f9699-02170166',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_583a57cc82ddd8_29546819',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_583a57cc82ddd8_29546819')) {function content_583a57cc82ddd8_29546819($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('public/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="header">
    <div class="am-g">
        <h1>HD优聘</h1>
        <p>HD优聘由惠东人亲自打造的兼职招聘平台,<br>发布最真实的惠东兼职招聘工作,HD优聘为你提供优质的兼职信息,找工作到HD优聘.</p>
    </div>
    <hr />
</div>
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
