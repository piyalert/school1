<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/9/2018
 * Time: 4:35 PM
 */
require_once __DIR__.'/../model/Check.php';
require_once __DIR__.'/../model/Holiday.php';
require_once __DIR__.'/../model/Student.php';
$MC = new Check();
$MH = new Holiday();
$MS = new Student();


$fn = $MC->input('fn');


$CHECKLIST = [];
$HOLIDAYLIST = [];
$STUDENT = [];
$studentCheckMonth = [];

//holiday
$result = $MH->selectMonthHoliday($UrlYMD);
if(count($result)>0){
    $HOLIDAYLIST = $result;
}

//student >> check
$result = $MS->selectStudentLast($user_id);
if(isset($result['id'])){
    $STUDENT = $result;
    $student_id = $result['id'];
    $result = $MC->selectListDay($student_id,$day_y,$day_m);
    if(count($result)>0){
        $studentCheckMonth = $result;
    }
}




