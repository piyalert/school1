<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 5:53 PM
 */
require_once __DIR__."/../model/Health.php";
$MHealth = new Health();

$VISITING_ID = $MHealth->input('id');
$VISITING_DATE = '';
$VISITING_TITLE = '';
$VISITING_DETAIL = '';
$result = $MHealth->selectThisId($VISITING_ID);
if(isset($result['id'])){
    $VISITING_DATE = $result['date_at'];
    $VISITING_TITLE = $result['title'];
    $VISITING_DETAIL = $result['detail'];
}