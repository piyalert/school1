<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */

require_once __DIR__.'/../model/Student.php';
$MStudent = new Student();

$STUDENTLISTS = [];
$result = $MStudent->selectStudentByClassAndYear($menuPortfolio,$UrlYear);
if(count($result)>0){
    $STUDENTLISTS=$result;
}

