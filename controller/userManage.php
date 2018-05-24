<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 5:32 PM
 */
require_once __DIR__.'/../model/User.php';

$modelUser = new User();


$USERS = $modelUser->selectByStatus('student');
if(count($USERS)<=0){
    $USERS=[];
}

