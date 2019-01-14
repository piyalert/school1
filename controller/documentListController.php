<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 11:31 AM
 */
require_once __DIR__.'/../model/Document.php';
require_once __DIR__.'/../model/DocumentList.php';
$MD = new Document();
$MDL = new DocumentList();

$fn = $MD->input('fn');

$DOCLIST = [];

if($fn=='delete'){
    $id = $MD->input('delete_id');
    $MD->deleteThis($id);
    $MDL->deleteThisCondition(['title_id'=>$id]);
}

//select default
$result = $MD->selectThisAll();
if(count($result)>0){
    $DOCLIST = $result;
    foreach ($DOCLIST as $key=>$item){
        $doc_id = $item['id'];
        $result = $MDL->selectThisCondition(['title_id'=>$doc_id]);
        if(count($result)>0){
            $DOCLIST[$key]['files'] = $result;
        }else{
            $DOCLIST[$key]['files'] = [];
        }
    }

}




