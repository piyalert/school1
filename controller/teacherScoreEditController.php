<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 9/12/2018
 * Time: 11:19 AM
 */
require_once __DIR__.'/../model/Grade.php';
$MG = new Grade();




$GRADE = [];
$STUDENT = [];
$result = $MG->selectGradeByStudentId($UrlYear , $menuGrade,$StudentId);

if(isset($result['grade'])){
    $GRADE = $result['grade'];
}
if(isset($result['student'])){
    $STUDENT = $result['student'];

    $USERNAME = $STUDENT['name'].' '.$STUDENT['surname'];
}