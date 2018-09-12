<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/15/2018
 * Time: 11:44 AM
 */

require_once __DIR__.'/../model/Check.php';
require_once __DIR__.'/../model/Holiday.php';
$MC = new Check();
$MH = new Holiday();


$fn = $MC->input('fn');
if($fn=='editCheck'){
    $check_id = $MC->input('check_id');
    $check_status = $MC->input('status');
    $result = $MC->updateCheck(['check_status'=>$check_status],['id'=>$check_id]);
}

$studentName = '';
$result = $MC->selectStudent($student_id);
if(isset($result['id'])){
    $studentName = $result['name'].' '.$result['surname'];
}
$studentCheckMonth = [];
$result = $MC->selectListDay($student_id,$day_y,$day_m);
if(count($result)>0){
    $studentCheckMonth = $result;
}

$HOLIDAYLIST = [];
$result = $MH->selectMonthHoliday($UrlYMD);
if (count($result) > 0){
    $HOLIDAYLIST = $result;
}