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
$news_id = isset($_REQUEST['id'])?$_REQUEST['id']:'';

$this_img = "";
$this_year = "";
$this_title = "";
$this_detail = "";

//select default
$result = $MNews->selectNewsId($news_id);
if(isset($result['id'])){
    $this_img = $result['img'];
    $this_title = $result['title'];
    $this_detail = $result['detail'];
    $this_year = $result['year'];
}



