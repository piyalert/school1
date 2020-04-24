<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 2:59 PM
 */
require_once __DIR__."/../model/User.php";
$MUser = new User();


$fn = $MUser->input('fn');
if($fn=='login'){
    $username = $MUser->input('username');
    $password = $MUser->input('password');
   // $password = md5($password);
   $password = $password;
    $result = $MUser->login($username,$password);
    if(isset($result['id'])){
        $_SESSION = $result;
        header("Location: /school/index.php");
        exit();
    }else{
        $_SESSION['error'] = 'Login Fail Check Username & Passsword !!!!';
    }
}