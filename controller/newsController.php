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



//select default
$result = $MNews->selectAll();
if(count($result)>0){
    $NEWSLIST = $result;
}



