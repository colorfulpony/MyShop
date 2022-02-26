<h1>Your register information</h1>
<table style="border: 0;" >
    <tr>
        <td>Login(email)</td>
        <td>{$arUser['email']}</td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" name="name" id="newName" value="{$arUser['name']}"></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><input type="text" name="phone" id="newPhone" value="{$arUser['phone']}"></td>
    </tr>
    <tr>
        <td>Adress</td>
        <td><textarea id="newAdress" name="adress">{$arUser['adress']}</textarea></td>
    </tr>
    <tr>
        <td>New password</td>
        <td><input type="password" name="pwd1" id="newPwd1" value=""></td>
    </tr>
    <tr>
        <td>New password again</td>
        <td><input type="password" name="pwd2" id="newPwd2" value=""></td>
    </tr>
    <tr>
        <td>Current password</td>
        <td><input type="password" name="curPwd" id="curPwd" value=""></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="button" value="Save changes" onclick="updateUserData();"></td>
    </tr>
</table>

<h2>Orders:</h2>
{if ! $rsUserOrders}
    There is no orders
{else}
    <table border="1" cellpadding="1" cellspacing="1"> 
        <tr>
            <th>№</th>
            <th>Action</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Date of payment</th>
            <th>Other info</th>
        </tr>
        {foreach $rsUserOrders as $item name=orders}
            <tr>
                <td>{$smarty.foreach.orders.iteration}</td>
                <td><a href="#" onclick="showProducts('{$item['id']}'); return false;">Show order's products</a></td>
                <td>{$item['id']}</td>
                <td>{$item['status']}</td>
                <td>{$item['date_create']}</td>
                <td>{$item['date_payment']}&nbsp;</td>
                <td>{$item['comment']}</td>
            </tr>

            <tr class="hideme" id="purchasesForOrderId_{$item['id']}">
                <td colspan="7">
                    {if $item['children']}
                        <table border="1" cellpadding="1" width="100%" sellspacing="1">
                            <tr>
                                <th>№</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                            {foreach $item['children'] as $itemChild name=products}
                                <tr>
                                    <td>{$smarty.foreach.products.iteration}</td>
                                    <td>{$itemChild['product_id']}</td>
                                    <td><a href="/product/{$itemChild['id']}/">{$itemChild['name']}</a></td>
                                    <td>{$itemChild['price']}</td>
                                    <td>{$itemChild['amount']}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                </td>
            </tr>
        {/foreach}
    </table>
{/if}