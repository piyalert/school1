<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/28/2018
 * Time: 4:28 PM
 */

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Grade.php';
$MUser = new User();
$MG = new Grade();

$user_id = $MUser->input('id');

//profile
$username = '';
$passwordCheck = true;
$password = '';
$name = '';
$surname ='';
$id_card= '';
$birthday='';
$address= '';
$phone='';
$img_path='upload/user.png';
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

$GRADE = [];
$searchUser = false;
if($user_id!=''){
    $searchUser = true;

    $user = $MUser->selectById($user_id);
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

    $result = $MG->selectGradeByUserId($user_id);
    if(isset($result)){
        $GRADE = $result;
    }


}
