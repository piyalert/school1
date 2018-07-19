<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/5/2018
 * Time: 10:54 AM
 */

session_start();
date_default_timezone_set("Asia/Bangkok");

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
$SESSION_user_status = '';