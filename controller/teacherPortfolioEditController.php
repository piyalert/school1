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


$user_id = $MPortfolio->input('uid');
$USER_USERNAME = '';
$USER_NAME = '';
$result = $MUser->selectById($user_id);
if(isset($result['id'])){
    $USER_USERNAME = $result['username'];
    $USER_NAME = $result['name'].' '.$result['surname'];
}

$PORTFOLIO_ID = $MPortfolio->input('id',0);
$PORTFOLIO_DATE = '';
$PORTFOLIO_TITLE = '';
$PORTFOLIO_DETAIL = '';
$result = $MPortfolio->selectThisId($PORTFOLIO_ID);
if(isset($result['id'])){
    $PORTFOLIO_DATE = $result['date_at'];
    $PORTFOLIO_TITLE = $result['title'];
    $PORTFOLIO_DETAIL = $result['detail'];
}else{
    $PORTFOLIO_ID=0;
}

