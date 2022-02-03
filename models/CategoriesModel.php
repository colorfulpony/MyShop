<?php

/**
 * Модель для таблицы категорий (categories)
 * 
 */


 /**
 * Получить дочернии категории для категории $catId
 * 
 * @param integer $catId ID категории
 * @return array массив дочерних категорий 
 */

function getChildrenForCat($catId)
{
   $sql = "SELECT * 
            FROM categories
            WHERE 
            parent_id = '{$catId}'";
       
   $rs = db()->query($sql);   
	
   return createSmartyRsArray($rs); 
}
 


/**
 * Получить главные категории с привязками дочерних
 * 
 * @return array массив категорий 
 */
function getAllMainCatsWithChildren(){
	$sql = 'SELECT * 
            FROM categories
            WHERE parent_id = 0';
	
   $rs = db()->query($sql); 
	
	$smartyRs = array();
	while ($row = $rs->fetch_assoc()) {
		
		$rsChildren = getChildrenForCat($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
        }
		
       $smartyRs[] = $row;
    }	

	return $smartyRs;
}


/**
 * Получить данные категории по id
 * 
 * @param integer $catId ID категории
 * @return array массив - строка категории 
 */
function getCatById($catId)
{ 
   $catId = intval($catId);
   $sql = "SELECT * 
            FROM categories
            WHERE 
            id = '{$catId}'";
            
   $rs = db()->query($sql); 
   
   return $rs->fetch_assoc(); 
    
}
