/**
 *  Функция добавления товара в корзину
 *  
 *  @param integer itemId ID продукта
 *  @return в случае успеха обновятся данные корзины на странице
 */
function addToCart(itemId){
    console.log("js - addToCart()");
    $.ajax({
		type: 'POST',
		async: true,
		url: "/cart/addtocart/" + itemId + '/',
		dataType: 'json',
		success: function(data){
			if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                
                $('#addCart_'+ itemId).hide();
                $('#removeCart_'+ itemId).show();
			}
		},
        error: function (request, status, error) {
            alert(request.responseText);
        }
	});   
}

/**
 * Удаление продукта из корзины
 * 
 * @param integer itemId ID продукта
 * @return в случае успеха обновятся данные корзины на странице
 */
function removeFromCart(itemId){
    console.log("js - removeFromCart("+itemId+")");
    $.ajax({
		type: 'POST',
		async: true,
		url: "/cart/removefromcart/" + itemId + '/',
		dataType: 'json',
		success: function(data){
			if(data['success']){
                
                $('#cartCntItems').html(data['cntItems']);
                
                $('#addCart_'+ itemId).show();
                $('#removeCart_'+ itemId).hide();
			}
		}
	});    
}

/**
 * Full amount of the product
 * 
 * @param integer itemId ID продукта
 */
 function conversionPrice(itemId){
    var newCnt = $('#itemCnt_' + itemId).val();
	console.log(newCnt);
	var itemPrice = $('#itemPrice_' + itemId).attr('value');
	console.log(itemPrice);
	var itemRealPrice = newCnt * itemPrice;
	console.log(itemRealPrice);
	
	$('#itemRealPrice_' + itemId).html(itemRealPrice);
}