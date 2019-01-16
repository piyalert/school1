<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 5:53 PM
 */
require_once __DIR__."/../model/About.php";
$MA = new About();

$detail = '';
$result  = $MA->selectLast('item');
if(isset($result['id'])){
 $detail = $result['detail'];
}