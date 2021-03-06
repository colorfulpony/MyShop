<?php 

/**
 * Model for table orders
 */

/**
 * Make new order(without reference to the product)
 * 
 * @param string $name
 * @param string $phone
 * @param string $adress
 * 
 * @return int ID make order
 */
function makeNewOrder($name, $phone, $adress) 
{
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $comment = "User ID: ($userId)<br />
                Name: ($name)<br />
                Phone: ($phone)<br />
                Adress: ($adress)";
    $userIp = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO
            orders (`user_id`, `date_payment`, `status`, `comment`, `user_ip`)
            VALUES ('$userId', null, '0', '$comment', '$userIp')";

    $rs = db()->query($sql);

    if($rs) {
        $sql = "SELECT `id` 
                FROM `orders` 
                WHERE `user_id`='{$userId}'  
                ORDER BY `id` 
                DESC LIMIT 1";
        $rs = db()->query($sql);

        $rs = createSmartyRsArray($rs);

        if(isset($rs[0])){
            return $rs[0]['id'];
        }
    }
}

function getOrdersWithProductsByUser($userId)
{
    $userId = intval($userId);
    $sql = "SELECT * FROM orders
            WHERE `user_id` = '{$userId}'
            ORDER BY id DESC";

    $rs = db()->query($sql);

    $smartyRs = array();
    while($row = $rs->fetch_assoc()) {
        $rsChildren = getPurchaseForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
        
    }

    return $smartyRs;
}