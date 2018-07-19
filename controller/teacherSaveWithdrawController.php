<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/6/2018
 * Time: 11:33 AM
 */

require_once __DIR__ . '/../model/Saving.php';
$MS = new Saving();

$fn = $MS->input('fn');
if ($fn == 'withdraw') {
    $user_id = $MS->input('user_id');
    $withdraw = $MS->input('withdraw');
    $input = [
        'user_id' => $user_id,
        'active_user'=>$SESSION_user_id,
        'event'=>'withdraw',
        'balance'=>$withdraw,
        'year'=>$UrlYear,
        'date_at'=>$UrlYMD
    ];
    $result = $MS->insertSaving($input);
}

$SAVELIST = [];
$result = $MS->selectSavingBalanceAll($UrlYear, $menuSave);
if (count($result) > 0) {
    $SAVELIST = $result;
}