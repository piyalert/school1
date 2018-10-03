<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/16/2018
 * Time: 5:53 PM
 */
require_once __DIR__."/../model/Portfolio.php";
$MPortfolio = new Portfolio();

$PORTFOLIO_ID = $MPortfolio->input('id');
$PORTFOLIO_DATE = '';
$PORTFOLIO_TITLE = '';
$PORTFOLIO_DETAIL = '';
$result = $MPortfolio->selectThisId($PORTFOLIO_ID);
if(isset($result['id'])){
    $PORTFOLIO_DATE = $result['date_at'];
    $PORTFOLIO_TITLE = $result['title'];
    $PORTFOLIO_DETAIL = $result['detail'];
}