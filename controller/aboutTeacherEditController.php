<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 4:48 PM
 */
require_once __DIR__."/../model/About.php";
$MAbout = new About();

$school_year = $MAbout->input('year',$year);
$school_id = 0;
$school_detail = '';
$result = $MAbout->selectByTypeYear('teacher',$school_year);
if(isset($result['id'])){
    $school_detail =  $result['detail'];
    $school_id = $result['id'];
}


