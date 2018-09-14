<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/5/2018
 * Time: 10:54 AM
 */

session_start();
date_default_timezone_set("Asia/Bangkok");
$ARR_MONTH = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน ','ตุลาคม','พฤศจิกายน','ธันวาคม'];

$SCHOOL_YEAR = '2561';

$menuAction = '';
$menuSub = '';
$menuCourse='';
$menuClass = '';
$menuSave = '';
$menuAbout = '';
$menuGrade = '';
$menuCheck = '';


$SESSION_user_id = isset($_SESSION['id'])?$_SESSION['id']:0;
$SESSION_user_username = isset($_SESSION['username'])?$_SESSION['username']:'';
$SESSION_user_img_path = (isset($_SESSION['img_path']) && $_SESSION['img_path']!='')?$_SESSION['img_path']:'/school/upload/user.png';
$SESSION_user_status = isset($_SESSION['status'])?$_SESSION['status']:'';