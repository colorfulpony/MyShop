<?php
/**
 * User Controller
 */

include_once '../models/CategoriesModel.php';
include_once '../models/UsersModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';


/**
 * AJAX user register   
 * Initialize session var ($_SESSION['user])
 * 
 * @return json array with new user's data
 */
function registerAction()
{
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);
    
    $pwd1   = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
    $pwd2   = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;
    $phone  = isset($_REQUEST['phone'])  ? $_REQUEST['phone']  : null;
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
    $name   = isset($_REQUEST['name'])   ? $_REQUEST['name']   : null;

	$resData = null;
    $resData = checkRegisterParams($email, $pwd1, $pwd2); 


	if(! $resData && checkUserEmail($email)){
        $resData['success'] = false; 
        $resData['message'] = "User with this email('{$email}')already exists"; 
    }

    if(! $resData ){
        $pwdMD5 = md5($pwd1);

        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $adress);
        
        if($userData['success']){
            $resData['message'] = 'User successfully registred'; 
			$resData['success'] = 1; 
			
			$userData = $userData[0];
			$resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
			$resData['userEmail'] = $email;
        
			$_SESSION['user'] = $userData;
			$_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
        } else {
            $resData['success'] = 0; 
            $resData['message'] = 'Register error'; 
        }  
    }
    
    echo json_encode($resData);
}

/**
 * Logout User
 */
function logoutAction()
{
    $resData = null;
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        unset($_SESSION['cart']);

        $resData['success'] = 1;
        $resData['message'] = "You have successfully logged out";
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Unable to log out";
    }

    echo json_encode($resData);
    // redirect('/');
}

/**
 * AJAX login user
 * 
 * @return json array user's data
 */
function loginAction()
{
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
    $pwd = trim($pwd);

    $userData = loginUser($email, $pwd);

    if($userData['success']){
        $userData = $userData[0];

        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];

        $resData = $_SESSION['user'];
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
        $resData['message'] = "False login or password";
    }

    echo json_encode($resData);  

}

/**
 * Show user account page
 * 
 * @link /user/
 * @param object $smarty shablonizator
 */
function indexAction($smarty)
{
    // if user is not logined - redirect to main page
    if(!isset($_SESSION['user'])) {
        redirect();
    }

    //get category list for menu
    $rsCategories = getAllMainCatsWithChildren();

    //get user's order list
    $rsUserOrders = getCurUserOrders();
    // d($rsUserOrders);

    $smarty->assign('pageTitle', 'User account');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsUserOrders', $rsUserOrders);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'user');
    loadTemplate($smarty, 'footer');
}

/**
 * Update user's information
 * 
 * @return json function execution result 
 */
function updateAction()
{
    //> If user is not logined - logout 
    if(!isset($_SESSION['user'])) 
    {
        redirect('/');
    } 
    //<

    //> initialize variable
    $resData = array();
    $phone  = isset($_REQUEST['phone'])  ? $_REQUEST['phone']	: null;
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress']	: null;
    $name   = isset($_REQUEST['name'])   ? $_REQUEST['name']	: null;
	$pwd1	= isset($_REQUEST['pwd1'])	 ? $_REQUEST['pwd1']	: null;
    $pwd2	= isset($_REQUEST['pwd2'])	 ? $_REQUEST['pwd2']	: null;
	$curPwd = isset($_REQUEST['curPwd']) ? $_REQUEST['curPwd']	: null;
    //<

    // check if curretn password is correct
    $curPwdMD5 = md5($curPwd);
    if(!$curPwd || ($_SESSION['user']['pwd'] != $curPwdMD5)) {
        $resData['success'] = 0;
        $resData['message'] = "Сurrent password is incorrect";
        echo json_encode($resData);
        return false;
    }

    //Update user's information
    $res = updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwdMD5);
    if($res) {
        $resData['success'] = 1;
        $resData['message'] = "Information is saved";
        $resData['userName'] = $name;

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['adress'] = $adress;

        $newPwd = $_SESSION['user']['pwd'];
        if($pwd1 && ($pwd1 == $pwd2)) {
            $newPwd = md5(trim($pwd1));
        }
        $_SESSION['user']['pwd'] = $newPwd;
        $_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Data save error";
    }

    echo json_encode($resData);
}