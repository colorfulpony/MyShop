<?php

/**
 * Модель для таблицы продукции (products)
 * 
 */

/**
 * Получаем последние добавленные товары
 * 
 * @param integer $limit Лимит товаров
 * @return array Массив товаров 
 */
function getLastProducts($limit = null)
{
    $sql = "SELECT *
            FROM `products` 
            ORDER BY id DESC";
    if($limit){
        $sql .= " LIMIT {$limit}";
    }
   
   $rs = db()->query($sql); 
   
   return createSmartyRsArray($rs); 
}

/**
 * Получить продукты для категории $itemId
 * 
 * @param integer $itemId ID категории
 * @return array массив продуктов 
 */
function getProductsByCat($itemId)
{
   $itemId = intval($itemId);
   $sql = "SELECT * 
            FROM products
            WHERE category_id = '{$itemId}'";
   
   $rs = db()->query($sql); 
   
   return createSmartyRsArray($rs);   
}


/**
 * Получить данные продукта по ID 
 * 
 * @param integer $itemId ID продукта
 * @return array массив данных продукта 
 */
function getProductById($itemId)
{
   $itemId = intval($itemId);
   $sql = "SELECT * 
            FROM products
            WHERE id = '{$itemId}'";
   
   $rs = db()->query($sql); 
   return $rs->fetch_assoc();   
}

/**
 * Get Product list for ID's array 
 * 
 * @param array $itemsIds
 * @return array product's array data
 */
function getProductsFromArray($itemsIds)
{
   $strIds = implode($itemsIds, ", ");
   $sql = "SELECT *
           FROM products 
           WHERE id in ({$strIds})";
   $rs = db()->query($sql);
   
   return createSmartyRsArray($rs);
}