<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */

require_once __DIR__.'/../model/Student.php';
require_once __DIR__.'/../model/User.php';
$MStudent = new Student();
$MUser = new User();

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
$STUDENTLISTS = [];
$USERLISTS = [];




$result = $MStudent->selectStudentByClassAndYear($menuClass,$UrlYear);
if(count($result)>0){
    $STUDENTLISTS=$result;
}

$result = $MUser->selectByStatus('student');
if(count($result)>0){
    $USERLISTS=$result;
}


