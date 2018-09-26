<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 11:37 AM
 */
require_once __DIR__.'/../model/User.php';


$fn = isset($_REQUEST['fn'])?$_REQUEST['fn']:'';
$id='';
$username = '';
$passwordCheck = true;
$password = '';
$name = '';
$surname ='';
$id_card= '';
$birthday='';
$address= '';
$phone='';
$img_path='/school/upload/user.png';
$gender='';
$status='';


//father
$name_father='';
$data_father='';

//mother
$name_mother='';
$data_mother='';

//normal
$date_admission='';
$report_grade='';
$date_issue='';
$note_issue='';
$detail_report='';
$address_birth='';
$old_school='';
$note_change_school='';
$home_birth='';



if ($fn=='edit'){
    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    $modelUser = new User();
    $user = $modelUser->selectById($id);
    if(count($user)){
        $username = $user['username'];
        $passwordCheck = false;
        $name = $user['name'];
        $surname = $user['surname'];
        $id_card= $user['id_card'];
        $birthday = $user['birthday'];
        $address= $user['address'];
        $phone= $user['phone'];
        $img_path= (strlen($user['img_path'])>10)?$user['img_path']:'/school/upload/user.png';
        $gender= $user['gender'];
        $status= $user['status'];

        //father
        $name_father=$user['name_father'];
        $data_father=$user['data_father'];

        //mother
        $name_mother=$user['name_mother'];
        $data_mother=$user['data_mother'];

        //normal
        $date_admission=$user['date_admission'];
        $report_grade=$user['report_grade'];
        $date_issue=$user['date_issue'];
        $note_issue=$user['note_issue'];
        $detail_report=$user['detail_report'];
        $address_birth=$user['address_birth'];
        $old_school=$user['old_school'];
        $note_change_school=$user['note_change_school'];
        $home_birth=$user['home_birth'];

    }
    
}
elseif ($fn=='insert'){

    $username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
    $password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $surname = isset($_REQUEST['surname'])?$_REQUEST['surname']:'';
    $id_card = isset($_REQUEST['id_card'])?$_REQUEST['id_card']:'';
    $birthday = isset($_REQUEST['birthday'])?$_REQUEST['birthday']:'';
    $address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $img_path= isset($_REQUEST['img_path'])?$_REQUEST['img_path']:'';
    $gender= isset($_REQUEST['gender'])?$_REQUEST['gender']:'f';
    $status= isset($_REQUEST['status'])?$_REQUEST['status']:'';

    $name_father= isset($_REQUEST['name_father'])?$_REQUEST['name_father']:'';
    $data_father= isset($_REQUEST['data_father'])?$_REQUEST['data_father']:'';

    $name_mother= isset($_REQUEST['name_mother'])?$_REQUEST['name_mother']:'';
    $data_mother= isset($_REQUEST['data_mother'])?$_REQUEST['data_mother']:'';

    $date_admission= isset($_REQUEST['date_admission'])?$_REQUEST['date_admission']:'';
    $report_grade= isset($_REQUEST['report_grade'])?$_REQUEST['report_grade']:'';
    $date_issue= isset($_REQUEST['date_issue'])?$_REQUEST['date_issue']:'';
    $note_issue= isset($_REQUEST['note_issue'])?$_REQUEST['note_issue']:'';
    $detail_report= isset($_REQUEST['detail_report'])?$_REQUEST['detail_report']:'';
    $address_birth= isset($_REQUEST['address_birth'])?$_REQUEST['address_birth']:'';
    $old_school= isset($_REQUEST['old_school'])?$_REQUEST['old_school']:'';
    $note_change_school= isset($_REQUEST['note_change_school'])?$_REQUEST['note_change_school']:'';
    $home_birth = isset($_REQUEST['home_birth'])?$_REQUEST['home_birth']:'';


    if($birthday!==''){
        $cutBD = explode('-',$birthday);
        $y= $cutBD[0];
        $m= $cutBD[1];
        $d= $cutBD[2];
        if($y>2500){
            $y = $y-543;
        }
        $birthday= $y.'-'.$m.'-'.$d;
    }


    $modelUser = new User();
    $input = [
        'username'=> $username,
        'password'=> $password,
        'name'=> $name,
        'surname'=> $surname,
        'id_card'=> $id_card,
        'birthday'=> $birthday,
        'address'=> $address,
        'phone'=> $phone,
        'img_path'=> $img_path,
        'gender'=> $gender,
        'status'=> $status,

        'name_father'=> $name_father,
        'data_father'=> $data_father,

        'name_mother'=>$name_mother,
        'data_mother'=>$data_mother,

        'date_admission'=>$date_admission,
        'report_grade'=>$report_grade,
        'date_issue'=>$date_issue,
        'note_issue'=>$note_issue,
        'detail_report'=>$detail_report,
        'address_birth'=>$address_birth,
        'old_school'=>$old_school,
        'note_change_school'=>$note_change_school,
        'home_birth'=>$home_birth

    ];
    $result = $modelUser->insertUser($input);
    if($result>0){
        header("Location: /school/userManage.php");
        exit();
    }else{
        $_SESSION['error']="Unable to Save User!!!!";
        header("Location: /school/register.php");
        exit();
    }
}
elseif ($fn=='update'){

    $username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
    $name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
    $surname = isset($_REQUEST['surname'])?$_REQUEST['surname']:'';
    $id_card = isset($_REQUEST['id_card'])?$_REQUEST['id_card']:'';
    $birthday = isset($_REQUEST['birthday'])?$_REQUEST['birthday']:'';
    $address = isset($_REQUEST['address'])?$_REQUEST['address']:'';
    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:'';
    $img_path= isset($_REQUEST['img_path'])?$_REQUEST['img_path']:'';
    $gender= isset($_REQUEST['gender'])?$_REQUEST['gender']:'f';
    $status= isset($_REQUEST['status'])?$_REQUEST['status']:'';

    $name_father= isset($_REQUEST['name_father'])?$_REQUEST['name_father']:'';
    $data_father= isset($_REQUEST['data_father'])?$_REQUEST['data_father']:'';

    $name_mother= isset($_REQUEST['name_mother'])?$_REQUEST['name_mother']:'';
    $data_mother= isset($_REQUEST['data_mother'])?$_REQUEST['data_mother']:'';

    $date_admission= isset($_REQUEST['date_admission'])?$_REQUEST['date_admission']:'';
    $report_grade= isset($_REQUEST['report_grade'])?$_REQUEST['report_grade']:'';
    $date_issue= isset($_REQUEST['date_issue'])?$_REQUEST['date_issue']:'';
    $note_issue= isset($_REQUEST['note_issue'])?$_REQUEST['note_issue']:'';
    $detail_report= isset($_REQUEST['detail_report'])?$_REQUEST['detail_report']:'';
    $address_birth= isset($_REQUEST['address_birth'])?$_REQUEST['address_birth']:'';
    $old_school= isset($_REQUEST['old_school'])?$_REQUEST['old_school']:'';
    $note_change_school= isset($_REQUEST['note_change_school'])?$_REQUEST['note_change_school']:'';
    $home_birth = isset($_REQUEST['home_birth'])?$_REQUEST['home_birth']:'';

    $id = isset($_REQUEST['id'])?$_REQUEST['id']:'';
    if($birthday!==''){
        $cutBD = explode('-',$birthday);
        $y= $cutBD[0];
        $m= $cutBD[1];
        $d= $cutBD[2];
        if($y>2500){
            $y = $y-543;
        }
        $birthday= $y.'-'.$m.'-'.$d;
    }


    $modelUser = new User();
    $input = [
        'username'=> $username,
        'name'=> $name,
        'surname'=> $surname,
        'id_card'=> $id_card,
        'birthday'=> $birthday,
        'address'=> $address,
        'phone'=> $phone,
        'img_path'=> $img_path,
        'gender'=> $gender,
        'status'=> $status,

        'name_father'=> $name_father,
        'data_father'=> $data_father,

        'name_mother'=>$name_mother,
        'data_mother'=>$data_mother,

        'date_admission'=>$date_admission,
        'report_grade'=>$report_grade,
        'date_issue'=>$date_issue,
        'note_issue'=>$note_issue,
        'detail_report'=>$detail_report,
        'address_birth'=>$address_birth,
        'old_school'=>$old_school,
        'note_change_school'=>$note_change_school,
        'home_birth'=>$home_birth,
    ];
    $result = $modelUser->updateUser($input,['id'=>$id]);
    if($result>0){
        if($SESSION_user_id==$id){
            $_SESSION['img_path'] = $img_path;
        }
        $_SESSION['success']="Update to Edit User Success";
        header("Location: /school/register.php?fn=edit&id=".$id);
        exit();
    }else{
        $_SESSION['error']="Unable to Edit User FAIL!!!!";
        header("Location: /school/register.php?fn=edit&id=".$id);
        exit();
    }
}



