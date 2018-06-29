<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/15/2018
 * Time: 3:09 PM
 */

$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';


//insert date check list : check student come to school
if($fn=='insertCheckList'){

    require_once __DIR__.'/../model/DateCheck.php';
    $MDC = new DateCheck();

    $date = $MDC->input('date');
    $list = $MDC->input('list');

    $result = $MDC->insertCheckList($list,$date);
    if($result > 0){
        echo json_encode([
            'status'=> true,
            'message'=> 'Success',
            'data'=>[]
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=> 'Error',
            'data'=>[]
        ]);
        exit;
    }

}

//insert data list user add to class
elseif ($fn=='insertStudent'){
    require_once __DIR__.'/../model/Student.php';
    $MS = new Student();

    $list = $MS->input('list_user_id');
    $class = $MS->input('class');
    $year = $MS->input('year');
    if ($year!='')
        $year = $year>2500?$year-543:$year;


    $result = $MS->insertStudentList($list,$class,$year);
    if($result > 0){
        echo json_encode([
            'status'=> true,
            'message'=> 'Success',
            'data'=>[]
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=> 'Error',
            'data'=>[]
        ]);
        exit;
    }
}

//insert news by froala
elseif ($fn=='insertNews'){
    require_once __DIR__.'/../model/News.php';
    $MN = new News();

    $detail = $MN->input('detail');
    $title = $MN->input('title');
    $img = $MN->input('img');
    $year = $MN->input('year');
    if ($year!='')
    $year = $year>2500?$year-543:$year;

    $input = [
        'detail'=>$detail,
        'title'=>$title,
        'img'=>$img,
        'year'=>$year
    ];

    $result = $MN->insertNews($input);
    if($result > 0){
        echo json_encode([
            'status'=> true,
            'message'=> 'Success',
            'data'=>[]
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=> 'Error',
            'data'=>[]
        ]);
        exit;
    }
}
elseif ($fn=='updateNews'){
    require_once __DIR__.'/../model/News.php';
    $MN = new News();

    $detail = $MN->input('detail');
    $title = $MN->input('title');
    $img = $MN->input('img');
    $year = $MN->input('year');
    $id= $MN->input('id');
    if ($year!='')
        $year = $year>2500?$year-543:$year;

    $input = [
        'detail'=>$detail,
        'title'=>$title,
        'img'=>$img,
        'year'=>$year
    ];

    $result = $MN->updateNews($input,['id'=>$id]);
    if($result > 0){
        echo json_encode([
            'status'=> true,
            'message'=> 'Success',
            'data'=>[]
        ]);
        exit;
    }else{
        echo json_encode([
            'status'=> false,
            'message'=> 'Error',
            'data'=>[]
        ]);
        exit;
    }
}


