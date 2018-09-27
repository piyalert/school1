<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 5:53 PM
 */
require_once __DIR__."/../model/Visiting.php";
$MVisiting = new Visiting();

$VISITING_ID = $MVisiting->input('id');
$VISITING_DATE = '';
$VISITING_TITLE = '';
$VISITING_DETAIL = '';
$result = $MVisiting->selectThisId($VISITING_ID);
if(isset($result['id'])){
    $VISITING_DATE = $result['date_at'];
    $VISITING_TITLE = $result['title'];
    $VISITING_DETAIL = $result['detail'];
}