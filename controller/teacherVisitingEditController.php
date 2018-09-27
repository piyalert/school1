<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Visiting.php';
$MVisiting = new Visiting();
$MUser = new User();





$VISITINGS = [];
$user_id = $MVisiting->input('uid');
$result = $MVisiting->selectThisAll(['user_id'=>$user_id]);
if(count($result)>0){
    $VISITINGS=$result;
}
$USER_USERNAME = '';
$USER_NAME = '';
$result = $MUser->selectById($user_id);
if(isset($result['id'])){
    $USER_USERNAME = $result['username'];
    $USER_NAME = $result['name'].' '.$result['surname'];
}

$VISITING_ID = $MVisiting->input('id');
$VISITING_DATE = '';
$VISITING_TITLE = '';
$VISITING_DETAIL = '';
$result = $MVisiting->selectThisId($VISITING_ID);
if(isset($result['id'])){
    $VISITING_DATE = $result['date_at'];
    $VISITING_TITLE = $result['title'];
    $VISITING_DETAIL = $result['detail'];
}else{
    $VISITING_ID=0;
}

