<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 10:45 AM
 */
require_once __DIR__.'/../model/News.php';
$MNews = new News();


$NEWSLIST = [];
$result = $MNews->selectAll();
if(count($result)>0){
    $NEWSLIST = $result;
}