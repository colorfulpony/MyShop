<?php
/**
 * User Controller
 */

include_once '../models/UsersModel.php';
include_once '../models/CategoriesModel.php';

function registerAction()
{
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);
    
    $pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
    $pwd1 = trim($pwd1);
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;
    $pwd2 = trim($pwd2);

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $phone = trim($phone);
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
    $adress = trim($adress);
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);

    $resData = null;
    $resData = checkRegisterParams($email, $pwd1, $pwd2);
}