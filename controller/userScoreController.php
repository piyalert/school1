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
$result = $MG->selectGradeByUserId($user_id);
if(isset($result)){
    $GRADE = $result;
}