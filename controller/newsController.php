<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 11:31 AM
 */
require_once __DIR__.'/../model/News.php';
$MNews = new News();

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';

$NEWSLIST = [];

if($fn=='delete'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $MNews->deleteNews($id);
}

//select default
$result = $MNews->selectAll();
if(count($result)>0){
    $NEWSLIST = $result;
}



