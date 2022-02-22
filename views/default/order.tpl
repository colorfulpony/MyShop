<h2>Order data</h2>
<form id="frmOrder" action="/cart/saveorder/" method="POST">
    <table>
        <tr>
            <td>№</td>
            <td>Name</td>
            <td>Count</td>
            <td>Price for one</td>
            <td>Full price</td>
        </tr>

        {foreach $rsProducts as $item name=products}
            <tr>
                <td>{$smarty.foreach.products.iteration}</td>
                <td><a href="/product/{$item['id']}/">{$item['name']}</a></td>
                <td>
                    <span id="itemCnt_{$item['id']}">
                        <input type="hidden" name="itemCnt_{$item['id']}" value="{$item['cnt']}"/>
                        {$item['cnt']}
                    </span>
                </td>
                <td>
                    <span id="itemPrice_{$item['id']}">
                        <input type="hidden" name="itemPrice_{$item['id']}" value="{$item['price']}"/>
                        {$item['price']}
                    </span>
                </td>
                <td>
                    <span id="itemRealPrice_{$item['id']}">
                        <input type="hidden" name="itemRealPrice_{$item['id']}" value="{$item['realPrice']}"/>
                        {$item['realPrice']}
                    </span>
                </td>
            </tr>
        {/foreach}
    </table>

    {if isset($arUser)}
        {$buttonClass = ""}
        <h2>Customer data</h2>
        <div id="orederUserInfoBox" {$buttonClass}>
            {$name = $arUser['name']}
            {$phone = $arUser['phone']}
            {$adress = $arUser['adress']}

            <table>
                <tr>
                    <td>Name*</td>
                    <td><input type="text" name="name" id="name" value="{$name}"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><input type="text" name="phone" id="phone" value="{$phone}"></td>
                </tr>
                <tr>
                    <td>Adress*</td>
                    <td><textarea name="adress" id="adress">{$adress}</textarea></td>
                </tr>
            </table>
        </div>
    {else}
        <div id="loginBox">
            <div class="menuCaption">Authorization</div>
            <table>
                <tr>
                    <td>Login</td>
                    <td><input type="text" name="loginEmail" id="loginEmail" value=""></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="loginPwd" id="loginPwd" value=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" onclick="login();" value="Login"></td>
                </tr>
            </table>
        </div>

        <div id="registerBox"> or <br>
            <div class="menuCaption">Register new user</div>
            email* : <br>
            <input type="text" name="email" id="email" value=""><br>
            password* : <br>
            <input type="password" name="pwd1" id="pwd1" value=""><br>
            password again* : <br>
            <input type="password" name="pwd2" id="pwd2" value=""><br>

            Name* : <input type="text" name="name" id="name" value=""><br>
            Phone* : <input type="text" name="phone" id="phone" value=""><br>
            Adress* : <textarea name="adress" id="adress"></textarea><br>
            
            <input type="button" onclick="registerNewUser();" value="Register">
        </div>
        {$buttonClass = "class='hideme'"}
    {/if}

    <input {$buttonClass} type="button" id="btnSaveOrder" value="Make order" onclick="saveOrder();">
</form>