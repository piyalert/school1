<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Health.php';
$MHealth = new Health();
$MUser = new User();

$user_id = $MHealth->input('uid');
$VISITING_ID = $MHealth->input('id', 0);
$fn = $MHealth->input('fn');

if ($fn == 'insertUpdate') {
    $title = $MHealth->input('title');
    $input = [
        'user_id' => $user_id,
        'title' => $title,
        'height' => $MHealth->input('height'),
        'weight' => $MHealth->input('weight'),
        'congenital_disease' => $MHealth->input('congenital_disease'),
        'disabled' => $MHealth->input('disabled'),
        'disabled_note' => $MHealth->input('disabled_note'),
        'fillings' => $MHealth->input('fillings','N'),
        'scaling' => $MHealth->input('scaling','N'),
        'extraction' => $MHealth->input('extraction','N'),
        'detail' => $MHealth->input('detail'),
        'date_at' => $MHealth->input('date_at')
    ];

    if($VISITING_ID==0){
        $result = $MHealth->insertThis($input);
        $_SESSION['E_MESSAGE'] = 'Add data success.';
    }else{
        $result = $MHealth->updateThis($input,['id'=>$VISITING_ID]);
        $_SESSION['E_MESSAGE'] = 'Edit data success.';
    }

    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        if($VISITING_ID==0){
            $_SESSION['E_MESSAGE'] = $title.'. Add data success.';
            header("Location: /school/teacher_healthlist.php?uid=$user_id&class=$menuHealth");
            exit();
        }
    }else{
        $_SESSION['E_STATUS'] = 'error';
        $_SESSION['E_MESSAGE'] = 'Data Error!!';
    }

}
elseif ($fn=='deleteHealth'){
    $id = $MHealth->input('delete_id');
    $result = $MHealth->deleteThis($id);
    if($result>0){
        $_SESSION['E_STATUS'] = 'success';
        $_SESSION['E_MESSAGE'] = 'Delete data success.';
        header("Location: /school/teacher_healthlist.php?uid=$user_id&class=$menuHealth");
        exit();
    }
}

$USER_USERNAME = '';
$USER_NAME = '';
$result = $MUser->selectById($user_id);
if (isset($result['id'])) {
    $USER_USERNAME = $result['username'];
    $USER_NAME = $result['name'] . ' ' . $result['surname'];
}

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
if (isset($result['id'])) {
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

} else {
    $VISITING_ID = 0;
}

