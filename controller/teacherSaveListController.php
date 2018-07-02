<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/2/2018
 * Time: 2:22 PM
 */
require_once __DIR__.'/../model/Saving.php';
$MS = new Saving();

$SAVELIST = [];






$result = $MS->selectSavingBalance($UrlYear,$menuSave);
if(count($result)>0){
    $SAVELIST=$result;
}




