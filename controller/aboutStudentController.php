<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */
require_once __DIR__.'/../model/Student.php';
$MStudent = new Student();

$STUDENTS = [];
$result = $MStudent->aboutStudent('10',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('20',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('1',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('2',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('3',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('4',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('5',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}
$result = $MStudent->aboutStudent('6',$UrlYear);
if(count($result)>0){
    $STUDENTS[]=$result;
}