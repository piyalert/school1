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
$DEPOSIT = 0;
$WITHDRAW = 0;

$result = $MS->selectSavingByUserId($user_id);
if(count($result)>0){
    $SAVELIST=$result;
    foreach ($SAVELIST as $item){
        if($item['event']=='withdraw'){
            $WITHDRAW = $WITHDRAW + $item['balance'];
        }else{
            $DEPOSIT = $DEPOSIT + $item['balance'];
        }
    }
}




