<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Portfolio.php';
$MPortfolio = new Portfolio();
$MUser = new User();

$PORTFOLIOS = [];
$user_id = $MPortfolio->input('uid');
$result = $MPortfolio->selectThisAll(['user_id'=>$user_id]);
if(count($result)>0){
    $PORTFOLIOS=$result;
}
$USER_USERNAME = '';
$USER_NAME = '';
$result = $MUser->selectById($user_id);
if(isset($result['id'])){
    $USER_USERNAME = $result['username'];
    $USER_NAME = $result['name'].' '.$result['surname'];
}

