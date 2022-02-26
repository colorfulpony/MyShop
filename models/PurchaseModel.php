<?php

/**
 * Model for table purchase
 */

/**
 * @param int $orderId order ID
 * @param array $cart cart array
 * 
 * @return boolean TRUE if success add to DB
 */
function setPurchaseForOrder($orderId, $cart)
{
    $sql = "INSERT INTO purchase
            (order_id, product_id, price, amount)
            VALUES";

    $values = array();
    // form array of strings for request for each product
    foreach ($cart as $item) {
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }

    // convert array to string
    $sql .= implode(', ', $values);
    $rs = db()->query($sql);

    return $rs;
}

function getPurchaseForOrder($orderId)
{   
    $sql = "SELECT `pe`.*, `ps`.name
            FROM purchase as `pe`
            JOIN products as `ps` ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = {$orderId}";

    $rs = db()->query($sql);
    return createSmartyRsArray($rs);
}