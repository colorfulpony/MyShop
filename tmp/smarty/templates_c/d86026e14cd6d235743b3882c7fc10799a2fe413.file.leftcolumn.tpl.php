<?php /* Smarty version Smarty-3.1.6, created on 2022-02-08 18:21:08
         compiled from "../views/default\leftcolumn.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1519361fd4d3e6a7995-85674210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd86026e14cd6d235743b3882c7fc10799a2fe413' => 
    array (
      0 => '../views/default\\leftcolumn.tpl',
      1 => 1644340867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1519361fd4d3e6a7995-85674210',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_61fd4d3e6ef3b',
  'variables' => 
  array (
    'rsCategories' => 0,
    'item' => 0,
    'itemChild' => 0,
    'cartCntItems' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61fd4d3e6ef3b')) {function content_61fd4d3e6ef3b($_smarty_tpl) {?>	

<div id="leftColumn">
	<div id="leftMenu">
		<div class="menuCaption">Меню:</div>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
				<a href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a><br />
				
				<?php if (isset($_smarty_tpl->tpl_vars['item']->value['children'])){?>
					<?php  $_smarty_tpl->tpl_vars['itemChild'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemChild']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemChild']->key => $_smarty_tpl->tpl_vars['itemChild']->value){
$_smarty_tpl->tpl_vars['itemChild']->_loop = true;
?>
						--<a href="/category/<?php echo $_smarty_tpl->tpl_vars['itemChild']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['itemChild']->value['name'];?>
</a><br />
					<?php } ?>
				<?php }?>
				
			<?php } ?>
	</div>  

	<div id="userBox" class="hideme">
		<a href="#" id="userLink"></a><br>
		<input type="button" onclick="logout();" value="Logout"/>
		<a href="#" onclick="logout();">Logout</a>
	</div>

	<div id="loginBox">
		<div class="menuCaption">Login</div>
		<input type="text" name="loginEmail" id="loginEmail" value=""><br>
		<input type="password" name="loginPwd" id="loginPwd" value=""><br>
		<input type="button" onclick="login();" value="Sign In">
	</div>

	<div id="registerBox">
		<div class="menuCaption showHidden" onclick="showRegisterBox();">Регистрация</div>
		<div id="registerBoxHidden">
			email:<br />
			<input type="text" id="email" name="email" value=""/><br />
			пароль: <br />
			<input type="password" id="pwd1" name="pwd1" value=""/><br />
			повторить пароль:<br />
			<input type="password" id="pwd2" name="pwd2" value=""/><br />
			<input type="button" onclick="registerNewUser();" value="Зарегистрироваться"/>
		</div>
	</div>

	<div class="menuCaption">Корзина</div>
   	<a href="/cart/" title="Перейти в корзину">В корзине</a>
    <span id="cartCntItems">
        <?php if ($_smarty_tpl->tpl_vars['cartCntItems']->value>0){?><?php echo $_smarty_tpl->tpl_vars['cartCntItems']->value;?>
<?php }else{ ?>пусто<?php }?>
    </span>
</div>
<?php }} ?>