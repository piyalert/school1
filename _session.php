<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/5/2018
 * Time: 10:54 AM
 */

session_start();
date_default_timezone_set("Asia/Bangkok");

function formatDate($strDate){
    if($strDate=='')return '';
    $months= ["","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
    $y = date('Y',strtotime($strDate))+543;
    $m = date('n',strtotime($strDate));
    $d = date('j',strtotime($strDate));
    return $d.'/'.$months[$m].'/'.$y;
}
function dayTTE($strDate){
    if($strDate=='')return'';
    $months= ["มกราคม"=>1, "กุมภาพันธ์"=>2, "มีนาคม"=>3, "เมษายน"=>4, "พฤษภาคม"=>5, "มิถุนายน"=>6, "กรกฎาคม"=>7, "สิงหาคม"=>8, "กันยายน"=>9, "ตุลาคม"=>10, "พฤศจิกายน"=>11, "ธันวาคม"=>12];
    $cut = explode('/',$strDate);
    return ($cut[2]-543).'-'.$months[$cut[1]].'-'.$cut[0];
}
$ARR_MONTH = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน ','ตุลาคม','พฤศจิกายน','ธันวาคม'];

$SCHOOL_YEAR = intval(date('Y'))+543; //'2561';

$menuAction = '';
$menuSub = '';
$menuCourse='';
$menuClass = '';
$menuSave = '';
$menuAbout = '';
$menuGrade = '';
$menuCheck = '';
$menuVisiting='';
$menuPortfolio='';
$menuHealth = '';


$SESSION_user_id = isset($_SESSION['id'])?$_SESSION['id']:0;
$SESSION_user_username = isset($_SESSION['username'])?$_SESSION['username']:'';
$SESSION_user_img_path = (isset($_SESSION['img_path']) && $_SESSION['img_path']!='')?$_SESSION['img_path']:'/school/upload/user.png';
$SESSION_user_status = isset($_SESSION['status'])?$_SESSION['status']:'';
$SESSION_user_gender = isset($_SESSION['gender'])?$_SESSION['gender']:'';