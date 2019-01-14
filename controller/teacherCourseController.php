<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/29/2018
 * Time: 4:56 PM
 */

require_once __DIR__.'/../model/Course.php';
require_once __DIR__.'/../model/Subject.php';
$MC = new Course();
$MS = new Subject();

$COURSELIST = [];
$SUBJECTLIST = [];
$fn = $MC->input('fn','');

if($fn=='deleteCourse'){
    $id = $MC->input('delete_id');
    $result = $MC->deleteCourse($id);
}


$result = $MC->selectCourseByRoomAndYear($menuCourse,$UrlYear);
if(count($result)>0){
    $COURSELIST=$result;
}

$result = $MS->selectSubRemove('N');
if(count($result)>0){
    $SUBJECTLIST=$result;
}