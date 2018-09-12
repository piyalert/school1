<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 9/12/2018
 * Time: 11:19 AM
 */
require_once __DIR__.'/../model/Grade.php';
$MG = new Grade();




$HEADER = [];
$STUDENT = [];
$result = $MG->selectGradeByClass($UrlYear , $menuGrade);
if(isset($result['header'])){
    $HEADER = $result['header'];
}
if(isset($result['student'])){
    $STUDENT = $result['student'];
}