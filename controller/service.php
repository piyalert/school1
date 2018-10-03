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

//insert data list course ad to class
elseif ($fn=='insertCourseList'){
    require_once __DIR__.'/../model/Course.php';
    $MC = new Course();

    $list = $MC->input('list_sub_id');
    $class = $MC->input('class');
    $year = $MC->input('year');
    if ($year!='')
        $year = $year>2500?$year-543:$year;


    $result = $MC->insertCourseList($list,$class,$year);
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

//insert list saving
elseif ($fn=='insertListSaving'){
    require_once __DIR__.'/../model/Saving.php';
    $MS = new Saving();

    $active_user = $MS->input('active_user');
    $year = $MS->input('year');
    $list = $MS->input('list');
    $date = $MS->input('date');

    $result = $MS->insertSavingDepositList($active_user , $year , $date, $list);
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
elseif ($fn=='insertSaving'){
    require_once __DIR__.'/../model/Saving.php';
    $MS = new Saving();

    $user_id = $MS->input('user_id');
    $active_user = $MS->input('active_user');
    $year = $MS->input('year');
    $balance = $MS->input('balance');
    $ymd = $MS->input('ymd');
    $type = $MS->input('type');

    if ($type=='withdraw'){
        $input = [
            'user_id'=>$user_id,
            'active_user'=>$active_user,
            'event'=>$type,
            'balance'=>$balance,
            'year'=>$year,
            'date_at'=>$ymd
        ];
        $result = $MS->insertSaving($input);
    }else{
        $result = $MS->insertUpdateSaving($active_user , $user_id , $year , $ymd , $balance , $type );
    }


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
elseif ($fn=='searchSaving') {
    require_once __DIR__ . '/../model/Saving.php';
    $MS = new Saving();

    $user_id = $MS->input('user_id');
    $date = $MS->input('date');

    $result = $MS->selectSavingYMDUserId($user_id,$date);
    if (isset($result['id'])) {
        echo json_encode([
            'status' => true,
            'message' => 'Success',
            'data' => $result
        ]);
        exit;
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Error',
            'data' => []
        ]);

    }
}


//search
elseif ($fn=='searchUser'){
    require_once __DIR__."/../model/User.php";
    $MU = new User();
    $attr = $MU->input('attr');
    $value = $MU->input('value');

    $result = $MU->searchAttr($attr,$value);
    if($result > 0){
        echo json_encode([
            'status'=> true,
            'message'=> 'Success',
            'data'=>$result
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

//about
elseif ($fn=='insertAbout'){
    require_once __DIR__.'/../model/About.php';
    $MA = new About();

    $detail = $MA->input('detail');
    $type = $MA->input('type');
    $year = $MA->input('year');
    if ($year!='')
        $year = $year>2500?$year-543:$year;

    $input = [
        'detail'=>$detail,
        'type'=>$type,
        'year'=>$year
    ];

    $result = $MA->insertAbout($input);
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
elseif ($fn=='updateAbout'){
    require_once __DIR__.'/../model/About.php';
    $MA = new About();

    $detail = $MA->input('detail');
    $type = $MA->input('type');
    $year = $MA->input('year');
    $id = $MA->input('id');
    if ($year!='')
        $year = $year>2500?$year-543:$year;

    $input = [
        'detail'=>$detail,
        'type'=>$type,
        'year'=>$year
    ];

    $result = $MA->updateAbout($input,['id'=>$id]);
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

//check name
elseif ($fn=='insertListCheck'){
    require_once __DIR__.'/../model/Check.php';
    $MC = new Check();

    $date = $MC->input('date');
    $year = $MC->input('year');
    $list = $MC->input('list');

    $result = $MC->insertUpdateCheckList($year,$date,$list);
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

//visiting
elseif ($fn=='insertVisiting'){
    require_once __DIR__.'/../model/Visiting.php';
    $MV = new Visiting();

    $user_id = $MV->input('user_id');
    $title = $MV->input('title');
    $detail = $MV->input('detail');
    $date_at = $MV->input('date_at');


    $input = [
        'user_id'=>$user_id,
        'title'=>$title,
        'detail'=>$detail,
        'date_at'=>$date_at
    ];

    $result = $MV->insertThis($input);
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
elseif ($fn=='updateVisiting'){
    require_once __DIR__.'/../model/Visiting.php';
    $MV = new Visiting();

    $user_id = $MV->input('user_id');
    $title = $MV->input('title');
    $detail = $MV->input('detail');
    $date_at = $MV->input('date_at');
    $id = $MV->input('id');


    $input = [
        'user_id'=>$user_id,
        'title'=>$title,
        'detail'=>$detail,
        'date_at'=>$date_at
    ];

    $result = $MV->updateThis($input,['id'=>$id]);
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

//portfolio
elseif ($fn=='insertPortfolio'){
    require_once __DIR__.'/../model/Portfolio.php';
    $MV = new Portfolio();

    $user_id = $MV->input('user_id');
    $title = $MV->input('title');
    $detail = $MV->input('detail');
    $date_at = $MV->input('date_at');


    $input = [
        'user_id'=>$user_id,
        'title'=>$title,
        'detail'=>$detail,
        'date_at'=>$date_at
    ];

    $result = $MV->insertThis($input);
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
elseif ($fn=='updatePortfolio'){
    require_once __DIR__.'/../model/Portfolio.php';
    $MV = new Portfolio();

    $user_id = $MV->input('user_id');
    $title = $MV->input('title');
    $detail = $MV->input('detail');
    $date_at = $MV->input('date_at');
    $id = $MV->input('id');


    $input = [
        'user_id'=>$user_id,
        'title'=>$title,
        'detail'=>$detail,
        'date_at'=>$date_at
    ];

    $result = $MV->updateThis($input,['id'=>$id]);
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

