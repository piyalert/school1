<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/9/2018
 * Time: 4:35 PM
 */
require_once __DIR__.'/../model/Check.php';
require_once __DIR__.'/../model/Holiday.php';
$MC = new Check();
$MH = new Holiday();


$fn = $MC->input('fn');
if($fn=='addHoliday'){
    $ymd = $MH->input('holiday');
    $detail = $MH->input('detail');
    $input = [
        'ymd'=>$ymd,
        'detail'=>$detail
    ];
    $MH->insertThis($input);
}
elseif ($fn=='editHoliday'){
    $id = $MH->input('holiday_id');
    $ymd = $MH->input('holiday');
    $detail = $MH->input('detail');
    $input = [
        'ymd'=>$ymd,
        'detail'=>$detail
    ];
    $MH->editThis($input,['id'=>$id]);
}

elseif ($fn=='deleteHoliday'){
    $id = $MH->input('holiday_id');
    $MH->deleteThis($id);
}


$CHECKLIST = [];
$LASTLIST = [];
$HOLIDAYLIST = [];
$result = $MC->selectList($menuCheck,$UrlYear);
if(count($result)>0){
    $CHECKLIST = $result;
    $LASTLIST = $MC->selectLastDate($menuCheck,$UrlYear,$UrlYMD);
}

$result = $MH->selectMonthHoliday($UrlYMD);
if(count($result)>0){
    $HOLIDAYLIST = $result;
}



