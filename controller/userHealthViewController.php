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
$VISITING_HEIGHT = '';
$VISITING_WEIGHT = '';
$VISITING_CONGENITAL_DISEASE = '';
$VISITING_DISABLED = '';
$VISITING_DISABLED_NOTE = '';
$VISITING_FILLINGS = '';
$VISITING_SCALING = '';
$VISITING_EXTRACTION = '';

$result = $MHealth->selectThisId($VISITING_ID);
if(isset($result['id'])){
    $VISITING_DATE = $result['date_at'];
    $VISITING_TITLE = $result['title'];
    $VISITING_DETAIL = $result['detail'];
    $VISITING_HEIGHT = $result['height'];
    $VISITING_WEIGHT = $result['weight'];
    $VISITING_CONGENITAL_DISEASE = $result['congenital_disease'];
    $VISITING_DISABLED = $result['disabled'];
    $VISITING_DISABLED_NOTE = $result['disabled_note'];
    $VISITING_FILLINGS = $result['fillings'];
    $VISITING_SCALING = $result['scaling'];
    $VISITING_EXTRACTION = $result['extraction'];


}