<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 10:45 AM
 */
require_once __DIR__.'/../model/News.php';
$MNews = new News();


$id = $MNews->input('id');
$news = $MNews->selectNewsId($id);
$img = 'upload/file_upload/null.png';
$title = '';
$detail = '';
$date = '';
if(isset($news['id'])){
    $img = $news['img'];
    $title = $news['title'];
    $detail = $news['detail'];
    $date = $news['create_at'];
}