<?php /* Smarty version Smarty-3.1.6, created on 2022-02-04 19:06:27
         compiled from "../views/default\cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:540361fd62ef035ae7-29340958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba49ac498b8cf2b9e90bf9a7a8f97ee29f5cd8d0' => 
    array (
      0 => '../views/default\\cart.tpl',
      1 => 1643997951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '540361fd62ef035ae7-29340958',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_61fd62ef036d4',
  'variables' => 
  array (
    'rsProducts' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61fd62ef036d4')) {function content_61fd62ef036d4($_smarty_tpl) {?>
<h1>Cart</h1>

<?php if (!$_smarty_tpl->tpl_vars['rsProducts']->value){?>
    Shopping Cart is empty
    <?php }else{ ?>
        <h2>Cart's data</h2>
        <table>
            <tr>
                <td>
                    #
                </td>
                <td>
                    Name
                </td>
                <td>
                    Amount
                </td>
                <td>
                    Price for one
                </td>
                <td>
                    Full price
                </td>
                <td>
                    Action
                </td>
                <td>
                    Total Price
                </td>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsProducts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['iteration']++;
?>
            <tr>
                <td>
                    <?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['products']['iteration'];?>

                </td>
                <td>
                    <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a><br />
                </td>
                <td>
                    <input name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" type="text" value="1" onchange="conversionPrice(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
);">
                </td>
                <td>
                    <span id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                    </span>
                </td>
                <td>
                    <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                    </span>
                </td>
                <td>
                    <a id="removeCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" href="#" onClick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;" alt="Remove From Shopping Cart">Remove</a>
                    <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="hideme" href="#" onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
); return false;" alt="Add to Shopping Cart">Add</a>
                </td>
                <td>
                    <span id="orderTable">
                       <p id="totalPrice"></p> 
                    </span>
                </td>
            </tr>
            <?php } ?>
        </table>
<?php }?><?php }} ?>