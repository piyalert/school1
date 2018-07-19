<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/6/2018
 * Time: 2:44 PM
 */
require_once __DIR__."/../model/Saving.php";
require_once __DIR__."/../model/User.php";
$MS = new Saving();
$MU = new User();


$fn = $MS->input('fn');
if($fn=='deleteSaving'){
    $saving_id = $MS->input('id_saving');
    $result = $MS->deleteSaving($saving_id);
}





$USER = [];
$SAVELIST = [];
$USER_id = 0;
$USER_username = '';
$USER_name = '';
$USER_surname = '';
$USER_balance = 0;



$id = $MS->input('id');
if($id!=''){

    $result = $MU->selectById($id);
    if(isset($result['id'])){
        $USER = $result;
        $USER_id = $result['id'];
        $USER_username = $result['username'];
        $USER_name = $result['name'];
        $USER_surname = $result['surname'];
    }

    $result = $MS->selectSavingByUserId($id);
    if(count($result)>0){
        $SAVELIST = $result;
    }

    $result = $MS->selectTotalSavingByUserId($id);
    if(isset($result['user_id'])){
        $USER_balance = $result['sum_deposit'] - $result['sum_withdraw'];
    }


}