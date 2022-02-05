	{* левый столбец *}

<div id="leftColumn">
	<div id="leftMenu">
		<div class="menuCaption">Меню:</div>
			{foreach $rsCategories as $item}
				<a href="/category/{$item['id']}/">{$item['name']}</a><br />
				
				{if isset($item['children'])}
					{foreach $item['children'] as $itemChild}
						--<a href="/category/{$itemChild['id']}/">{$itemChild['name']}</a><br />
					{/foreach}
				{/if}
				
			{/foreach}
	</div>  

	<div id="registerBox">
		<div class="menuCaption showHidden" onclick="showRegisterBox();">Register</div>
		<div id="registerBoxHidden">
			email: <br>
			<input type="text" name="email" id="email" value=""><br>
			password: <br>
			<input type="password" name="pwd1" id="pwd1" value=""><br>
			password again: <br>
			<input type="password" name="pwd2" id="pwd2" value=""><br>
			<input type="button" name="button" onclick="registerNewUser();" value="Register">
		</div>
	</div>

	<div class="menuCaption">Корзина</div>
   	<a href="/cart/" title="Перейти в корзину">В корзине</a>
    <span id="cartCntItems">
        {if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
    </span>
</div>
