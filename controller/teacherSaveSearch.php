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

$USER = [];
$SAVELIST = [];


$id = $MS->input('id');
if($id!=''){

    $result = $MU->selectById($id);
    if(isset($result['id'])){
        $USER = $result;
    }

    $result = $MS->selectSavingByUserId($id);
    if(count($result)>0){
        $SAVELIST = $result;
    }


}