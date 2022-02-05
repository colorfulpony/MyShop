{* cart's shablon *}
<h1>Cart</h1>

{if ! $rsProducts}
    Shopping Cart is empty
    {else}
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
            {foreach $rsProducts as $item name=products}
            <tr>
                <td>
                    {$smarty.foreach.products.iteration}
                </td>
                <td>
                    <a href="/product/{$item['id']}/">{$item['name']}</a><br />
                </td>
                <td>
                    <input name="itemCnt_{$item['id']}" id="itemCnt_{$item['id']}" type="text" value="1" onchange="conversionPrice({$item['id']});">
                </td>
                <td>
                    <span id="itemPrice_{$item['id']}" value="{$item['price']}">
                        {$item['price']}
                    </span>
                </td>
                <td>
                    <span id="itemRealPrice_{$item['id']}">
                        {$item['price']}
                    </span>
                </td>
                <td>
                    <a id="removeCart_{$item['id']}" href="#" onClick="removeFromCart({$item['id']}); return false;" alt="Remove From Shopping Cart">Remove</a>
                    <a id="addCart_{$item['id']}" class="hideme" href="#" onClick="addToCart({$item['id']}); return false;" alt="Add to Shopping Cart">Add</a>
                </td>
                <td>
                    <span id="orderTable">
                       <p id="totalPrice"></p> 
                    </span>
                </td>
            </tr>
            {/foreach}
        </table>
{/if}