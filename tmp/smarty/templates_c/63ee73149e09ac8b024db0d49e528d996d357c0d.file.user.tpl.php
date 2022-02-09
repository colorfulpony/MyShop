<?php /* Smarty version Smarty-3.1.6, created on 2022-02-09 22:04:51
         compiled from "../views/default\user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3182462042bdb14db82-16930338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63ee73149e09ac8b024db0d49e528d996d357c0d' => 
    array (
      0 => '../views/default\\user.tpl',
      1 => 1644440690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3182462042bdb14db82-16930338',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_62042bdb14e4c',
  'variables' => 
  array (
    'arUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62042bdb14e4c')) {function content_62042bdb14e4c($_smarty_tpl) {?><h1>Your register information</h1>
<table border="0">
    <tr>
        <td>Login(email)</td>
        <td><?php echo $_smarty_tpl->tpl_vars['arUser']->value['email'];?>
</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" id="newName" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
"></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><input type="text" id="newPhone" value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['phone'];?>
"></td>
    </tr>
    <tr>
        <td>Adress</td>
        <td><textarea id="newAdress"><?php echo $_smarty_tpl->tpl_vars['arUser']->value['adress'];?>
</textarea></td>
    </tr>
    <tr>
        <td>New password</td>
        <td><input type="password" id="newPwd1" value=""></td>
    </tr>
    <tr>
        <td>New password again</td>
        <td><input type="password" id="newPwd2" value=""></td>
    </tr>
    <tr>
        <td>Current password</td>
        <td><input type="password" id="curPwd" value=""></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="button" value="Save changes" onclick="updateUserData();"></td>
    </tr>
</table><?php }} ?>