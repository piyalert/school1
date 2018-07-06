<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/6/2018
 * Time: 11:33 AM
 */

require_once __DIR__.'/../model/Saving.php';
$MS = new Saving();

$SAVELIST = [];


$result = $MS->selectSavingLastDeposit($UrlYear,$menuSave);
if(count($result)>0){
    $SAVELIST=$result;
}