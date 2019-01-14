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
$DOCID = $MD->input('docid','');

$TITLE = '';
$GROUP = '';
$FILES = [];

if($fn=='updateDoc'){
    $id = $MD->input('doc_id','');
    if($id==''){
        $InPutTitle = $MD->input('title');
        $InPutGroup = $MD->input('group');
        $InPutDate = date('Y-m-d');
        $input = [
            'title'=>$InPutTitle,
            'groups'=>$InPutGroup,
            'date_at'=>$InPutDate
        ];
        $LastId = $MD->insertThis($input);
        if($LastId>0){
            for ($i=1;$i<10;$i++){
                $fileName = $MDL->input('file_name_'.$i);
                $filePath = $MDL->input('file_path_'.$i);
                if($fileName!='' && $filePath!=''){
                    $input=[
                        'title_id'=>$LastId,
                        'name'=>$fileName,
                        'path'=>$filePath
                    ];
                    $result = $MDL->insertThis($input);
                }
            }
        }
    }
    else{
        $InPutTitle = $MD->input('title');
        $InPutGroup = $MD->input('group');
        $InPutDate = date('Y-m-d');
        $input = [
            'title'=>$InPutTitle,
            'groups'=>$InPutGroup,
            'date_at'=>$InPutDate
        ];
        $result = $MD->updateThis($input,['id'=>$id]);
        if($result>0){
            $result = $MDL->deleteThisCondition(['title_id'=>$id]);
            for ($i=1;$i<10;$i++){
                $fileName = $MDL->input('file_name_'.$i);
                $filePath = $MDL->input('file_path_'.$i);
                if($fileName!='' && $filePath!=''){
                    $input=[
                        'title_id'=>$LastId,
                        'name'=>$fileName,
                        'path'=>$filePath
                    ];
                    $result = $MDL->insertThis($input);
                }
            }
        }
    }
    header("Location: /school/document-list.php");
    exit();
}

//select default
if($DOCID!=''){
    $result = $MD->selectThisId($DOCID);
    if(isset($result['id'])){
        $DOCID = $result['id'];
        $TITLE = $result['title'];
        $GROUP = $result['groups'];
        $result = $MDL->selectThisCondition(['title_id'=>$DOCID]);
        if(count($result)>0){
            $FILES = $result;
        }
    }
}




