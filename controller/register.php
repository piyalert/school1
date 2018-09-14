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
    $status= isset($_REQUEST['status'])?$_REQUEST['status']:'student';
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
        'status'=> $status
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
    $status= isset($_REQUEST['status'])?$_REQUEST['status']:'student';
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
        'id'=>$id
    ];
    $result = $modelUser->updateUser($input);
    if($result>0){
        $_SESSION = $input;
        $_SESSION['success']="Update to Edit User Success";
        header("Location: /school/register.php?fn=edit&id=".$id);
        exit();
    }else{
        $_SESSION['error']="Unable to Edit User FAIL!!!!";
        header("Location: /school/register.php?fn=edit&id=".$id);
        exit();
    }
}



