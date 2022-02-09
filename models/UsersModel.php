<?php 
/**
 * User Model
 */

/**
 * @param string $email user's email
 * @param string $pwdMD5 user's pwd
 * @param string $name  user's name
 * @param string $phone user's phone
 * @param string $adress user's adress
 * 
 * @return array New user data
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $adress) {
    $email = htmlspecialchars(db()->real_escape_string($email));
    $name = htmlspecialchars(db()->real_escape_string($name));
    $phone = htmlspecialchars(db()->real_escape_string($phone));
    $adress = htmlspecialchars(db()->real_escape_string($adress));

    $sql = "INSERT INTO
            users (`email`, `pwd`, `name`, `phone`, `adress`)
            VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')";

    $rs = db()->query($sql);

    if($rs) {
        $sql = "SELECT * FROM users  
				WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
				LIMIT 1";

        $rs = db()->query($sql);
        $rs = createSmartyRsArray($rs);
        
        if(isset($rs[0])) {
            $rs['success'] = 1;
        } else {
            $rs['success'] = 0;
        }
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

/**
 * @param string $email Email
 * @param string $pwd1 Password
 * @param string $pwd2 Password mismatch
 * 
 * @return array results
 */
function checkRegisterParams($email, $pwd1, $pwd2)
{
    $res = null;

    if(!$email) {
        $res['success'] = false;
        $res['message'] = 'Enter email';
    }

    if(!$pwd1) {
        $res['success'] = false;
        $res['message'] = 'Enter password';
    }

    if(!$pwd2) {
        $res['success'] = false;
        $res['message'] = 'Enter password again';
    }

    if($pwd1 !== $pwd2) {
        $res['success'] = false;
        $res['message'] = 'Password mismatch';
    }
    return $res;
    
}

/**
 * Check email(if there is email in DB)
 * 
 * @param string $email
 * @return array array - sring from table users or empty array
 */
function checkUserEmail($email) 
{
    $email = db()->real_escape_string($email);
    $sql = "SELECT id FROM users WHERE email = '{$email}'";

    $rs = db()->query($sql);
    $rs = createSmartyRsArray($rs);

    return $rs;
}

function loginUser($email, $pwd)
{
    $email = htmlspecialchars(db()->real_escape_string($email));
    $pwd   = md5($pwd);

    $sql = "SELECT * FROM users
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";

    $rs = db()->query($sql);

    $rs = createSmartyRsArray($rs);
    if(isset($rs[0])){
        $rs['success'] = 1;
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

/**
 * Change user information
 * 
 * @param string $name username
 * @param string $phone user's phone
 * @param string $adress user's adress
 * @param string $pwd1 new user's password
 * @param string $pwd2 new user's password again
 * @param string $curPwd current user's password
 * 
 * @return boolean  TRUE if all is success
 */
function updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwd)
{

}