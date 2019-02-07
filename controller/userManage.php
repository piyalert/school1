<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 5:32 PM
 */
require_once __DIR__.'/../model/User.php';

$modelUser = new User();

$fn = $modelUser->input('fn');
if($fn=='delete'){
    $id = $modelUser->input('id');
    $row = $modelUser->deleteUser($id);
    if($row>0){
        $_SESSION['E_STATUS']='success';
        $_SESSION['E_MESSAGE'] = 'Delete User Success';
    }else{
        $_SESSION['E_STATUS']='error';
        $_SESSION['E_MESSAGE'] = 'Delete User Fail!!!';
    }
}

$USERS = $modelUser->selectByStatus('student');
if(count($USERS)<=0){
    $USERS=[];
}

