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

if($fn=="editParent"){
    $parent = $MStudent->input("parent");
    $student_id = $MStudent->input("student_id");
    $result = $MStudent->editStudent(['parent'=>$parent], ['id'=>$student_id]);
}
elseif($fn=="deleteStudent"){
    $student_id = $MStudent->input("student_id");
    $result = $MStudent->deleteStudent($student_id);
}



$result = $MStudent->selectStudentByClassAndYear($menuClass,$UrlYear);
if(count($result)>0){
    $STUDENTLISTS=$result;
}

$result = $MUser->selectByStatus('student');
if(count($result)>0){
    $USERLISTS=$result;
}


