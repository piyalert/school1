<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 5:32 PM
 */
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Student.php';

$modelUser = new User();
$modelStudent = new Student();

$fn = $modelUser->input('fn');
if($fn=='delete'){
    $id = $modelUser->input('id');
    $row = $modelUser->deleteUser($id);
    if($row>0){
        $_SESSION['E_STATUS']='success';
        $_SESSION['E_MESSAGE'] = 'Delete User Success';
    }else{
        $_SESSION['E_STATUS']='error';
        $_SESSION['E_MESSAGE'] = 'Delete User Fail!!!';
    }
}

$STUDENT = [];
$sql = "select * from (select * from student order by year DESC) as s group by s.user_id";
$result = $modelStudent->selectQuery($sql);
if(count($result)>0){
    foreach ($result as $item){
        $STUDENT[$item['user_id']] = $item;
    }
}

$USERS = $modelUser->selectByStatus('student');
if(count($USERS)>0){
    foreach ($USERS as $key=>$item){
        $learning = 'non';
        $user_id = $item['id'];
        if(isset($STUDENT[$user_id])){
            $i_status = $STUDENT[$user_id]['status'];
            $i_class = $STUDENT[$user_id]['class'];
            if($i_status=='pass'){
                $learning = 'Pass.';
            }elseif ($i_status=='resign'){
                $learning = 'Resign Class '.$i_class;
            }else{
                $learning = 'Learning Class '.$i_class;
            }
        }
        $USERS[$key]['learning'] = $learning;
    }
}else{
    $USERS = [];
}

