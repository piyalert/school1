<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/15/2018
 * Time: 11:44 AM
 */
require_once __DIR__.'/../model/Student.php';
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/Check.php';
require_once __DIR__.'/../model/Holiday.php';
$MC = new Check();
$MS = new Student();
$MU = new User();

$CHECKS = [];

$sc = 0;
$scp = 0;
$sl = 0;
$slp = 0;
$sm = 0;
$smp = 0;
$ss = 0;
$ssp = 0;

$studentName = '';
$studentId = '';
$resStudent = $MS->selectThis(['id'=> $student_id]);
if(isset($resStudent['id'])){
    $user_id = $resStudent['user_id'];

    $resUser = $MU->selectById($user_id);
    if(isset($resUser['id'])){

        $studentName = $resUser['name'].' '.$resUser['surname'];
        $studentId = $resUser['username'];

    }

    $resStu = $MS->selectStudentLast($user_id);
    if(isset($resStu['id'])){
        if ($resStu['class'] >= 10) {
            $studentClass = "อนุบาล ".($resStu['class']/10);
        } else {
            $studentClass = "ประถมศึกษาปีที่ " . $resStu['class'];
        }
    }

    $resLStu = $MS->selectThisAll(['user_id'=>$user_id]);
    if(count($resLStu)>0){
        $listStuId = '';
        foreach ($resLStu as $key=>$item){
            if($key==0){
                $listStuId = $item['id'];
            }else{
                $listStuId .= ','.$item['id'];
            }
        }

        $sql = 'SELECT * FROM date_check WHERE student_id IN ('.$listStuId.') ORDER BY date_at DESC';
        $resCheck = $MS->selectQuery($sql);
        $checkD = '';
        foreach ($resCheck as $item){
            $_s = '';
            $_status = $item['check_status'];
            $_c = true;
            if($item['date_at'] == $checkD){
                $_c= false;
            }elseif($_status=='missing'){
                $_s = 'ขาด';
                $sm+=1;
            }elseif ($_status=='leave'){
                $_s = 'ลา';
                $sl+=1;
            }
            elseif ($_status=='late'){
                $_s = 'มาสาย';
                $sc+=1;
            }
            elseif ($_status=='come'){
                $_s = 'มา';
                $sc+=1;
            }else{
                $_c= false;
            }

            $checkD = $item['date_at'];
            if($_c){
                $CHECKS[] = [
                    'date_at'=> $item['date_at'],
                    'date_thai'=> $MC->dateFullThai($item['date_at']),
                    'check_status'=> $_status,
                    'check_str'=> $_s
                ];
            }

        }

        $ss = $sc+$sl+$sm;
        if($ss>0){
            $scp = ($sc*100)/$ss;
            $slp = ($sl*100)/$ss;
            $smp = ($sm*100)/$ss;
        }


        $ssp = 100.00;

    }

}
