<?php

/**
 *  cartController.php
 * 
 *  Контроллер работы с корзиной (/cart/)
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';


/**
 * Добавление продукта в корзину
 * 
 * @param integer id GET параметр - ID добавляемого продукта
 * @return json информация об операции (успех, колво элементов в корзине) 
 */
 function addtocartAction(){
     $itemId = isset($_GET['id']) ? intval($_GET['id']) : null; 
     if(! $itemId) return false;
	 
     $resData = array();

     // если значение не найдено, то добавляем
     if(isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false){
         $_SESSION['cart'][] = $itemId;
         $resData['cntItems'] = count($_SESSION['cart']);
         $resData['success'] = 1;
     } else {
         $resData['success'] = 0;
     }

     echo json_encode($resData);
  }
  
    /**
   * Удаление продукта из корзины
   * 
   * @param integer id GET параметр - ID удаляемого из корзины продукта
   * @return json информация об операции (успех, колво элементов в корзине) 
   */
  function removefromcartAction(){
     $itemId = isset($_GET['id']) ? intval($_GET['id']) : null; 
     if(! $itemId) exit();
     
     $resData = array();
     $key = array_search($itemId, $_SESSION['cart']);
     if($key !== false){
         unset($_SESSION['cart'][$key]);
         $resData['success'] = 1;
          $resData['cntItems'] = count($_SESSION['cart']);
     } else {
         $resData['success'] = 0;
     }
     
     echo json_encode($resData);
  }

/**
 * Cart page
 * 
 * @link /cart/
 */
function indexAction($smarty){
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getProductsFromArray($itemsIds);

    $smarty->assign('pageTitle', 'Shopping Cart');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}

/**
 * Make oreder page
 */
function orderAction($smarty)
{
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    
    if(! $itemsIds) {
        redirect('/cart/');
        return;
    }
    
    $itemsCnt = array();
    foreach($itemsIds as $item) {
        $postVar = 'itemCnt_' . $item;
        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }

    $rsProducts = getProductsFromArray($itemsIds);
    
    $i = 0;
    foreach($rsProducts as &$item) {
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 0;
        if($item['cnt']) {
            $item['realPrice'] = $item['cnt'] * $item['price'];
        } else {
            unset($rsProducts[$i]);
        }
        $i++;
    }
    
    if(!$rsProducts) {
        echo "Cart is empty";
        return;
    }

    $_SESSION['saleCart'] = $rsProducts;

    $rsCategories = getAllMainCatsWithChildren();

    if(!isset($_SESSION['user'])) {
        $smarty->assign('hideLoginBox', 1);
    }

    $smarty->assign('pageTitle', 'Order');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}
