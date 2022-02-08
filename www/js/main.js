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
 * Подсчет стоимости купленного товара
 * 
 * @param integer itemId ID продукта
 * 
 */
function conversionPrice(itemId){
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;

    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
 * Получение данных с формы
 * 
 */
function getData(obj_form){
          var hData = {};
          $('input, textarea, select',  obj_form).each(function(){
               if(this.name && this.name!=''){
                    hData[this.name] = this.value;
					console.log('hData[' + this.name + '] = ' + hData[this.name]);
               }
          });
          return hData;
};

/**
 * Регистрация нового пользователя
 * 
 */
function registerNewUser(){
    var postData = getData('#registerBox');
    
     $.ajax({
		type: 'POST',
		async: true,
		url: "/user/register/",
        data: postData,
		dataType: 'json',
		success: function(data){
			if(data['success']){
                alert('Регистрация прошла успешно');
                
                //> блок в левом столбце
                $('#registerBox').hide();
                
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show();
                //<
			} else {
                alert(data['message']);
            }
            
		}
	});   
}

function logout(){  
    var postData = getData('#registerBox');

     $.ajax({
		type: 'POST',
		async: true,
		url: "/user/logout/",
        data: postData,
		dataType: 'json',
		success: function(data){
			if(data['success']){
                alert(data['message']);

                window.location = '/';

                $('#userBox').hide();
                $('#registerBox').show();
			} else {
                alert(data['message']);
            }
            
		}
	});   
}