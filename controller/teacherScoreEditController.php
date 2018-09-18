<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 9/12/2018
 * Time: 11:19 AM
 */
require_once __DIR__.'/../model/Grade.php';
$MG = new Grade();


$fn = $MG->input('fn');
if($fn=='addUpdateGrade'){
    $year = $MG->input('year');
    $studentId = $MG->input('student_id');
    $countInput = $MG->input('countInput');
    $countInput = intval($countInput);
    for($i=0;$i<$countInput;$i++){
        $course_id = $MG->input('courseId'.$i);
        $grade = $MG->input('grade'.$i);
        $final_exam = $MG->input('final_exam'.$i);

        $input = [
            'course_id'=>$course_id,
            'student_id'=>$studentId,
            'year'=> $year,
            'score'=>$grade,
            'final_exam'=>$final_exam
        ];

        $condition = [
            'course_id'=>$course_id,
            'student_id'=>$studentId,
            'year'=> $year
        ];

        $result = $MG->insertUpdateThis($input,$condition);

    }
    $_SESSION['E_STATUS'] = 'success';
    $_SESSION['E_MESSAGE'] = 'แก้ไขข้อมูลสำเร็จ';

}



$GRADE = [];
$STUDENT = [];
$result = $MG->selectGradeByStudentId($UrlYear , $menuGrade,$StudentId);

if(isset($result['grade'])){
    $GRADE = $result['grade'];
}
if(isset($result['student'])){
    $STUDENT = $result['student'];

    $USERNAME = $STUDENT['name'].' '.$STUDENT['surname'];
}