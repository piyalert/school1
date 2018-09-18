<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 11:38 AM
 */
require_once __DIR__."/_DBPDO.php";

class Grade extends _DBPDO
{
    private $DB = 'grade';
    private $FKUser = 'user';
    private $FKStudent = 'student';
    private $FKCourse = 'course';
    private $FKSubject = 'subject';

    function insertThis($input){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToInsert($input);
        if(count($data_sql)<=0){
            return 0;
        }else{

            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "INSERT INTO $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->insert($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function editThis($input , $condition){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToUpdate($input,$condition);;
        if(count($data_sql)<=0){
            return 0;
        }else {
            //connect DB
            $this->connect();
            $sql_value = $data_sql['value'];
            $sql = "UPDATE $this_db $sql_value";
            $params = $data_sql['params'];
            $lastId = $this->update($sql,$params);

            //close DB
            $this->close();
            return $lastId;
        }
    }
    function deleteThis($id){
        $this_db = $this->DB;
        //set parameter

        //connect DB
        $this->connect();
        $sql = "DELETE FROM $this_db WHERE id=:id";
        $params= array(':id'=> $id);
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
    }
    function insertUpdateThis($input , $condition){
        //set parameter
        $this_db = $this->DB;
        $lastId = 0;

        //connect DB
        $this->connect();

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->query($sql,$params);
        if(isset($result['id'])){
            $data_sql = $this->convertArrayToUpdate($input,$condition);
            if(count($data_sql)>0){
                $sql_value = $data_sql['value'];
                $sql = "UPDATE $this_db $sql_value";
                $params = $data_sql['params'];
                $lastId = $this->update($sql,$params);
            }
        }else{
            $data_sql = $this->convertArrayToInsert($input);
            if(count($data_sql)>0){
                $sql_value = $data_sql['value'];
                $sql = "INSERT INTO $this_db $sql_value";
                $params = $data_sql['params'];
                $lastId = $this->insert($sql,$params);
            }
        }


        //close DB
        $this->close();

        return $lastId;

    }
    function selectThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    function selectAllThis($condition){
        //set parameter
        $this_db = $this->DB;

        //condition
        $data_sql = $this->convertArrayToCondition($condition);
        $sql_value = $data_sql['value'];
        $params = $data_sql['params'];

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ".$sql_value;
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }


    function selectGradeByClass($year , $class){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;
        $this_db_course = $this->FKCourse;
        $this_db_subject = $this->FKSubject;

        //connect DB
        $this->connect();


        //student in class
        $sql = "select u.name , u.surname , s.* from $this_db_student s  left join $this_db_user u on s.user_id = u.id where s.class=:class and s.year=:year";
        $params = [':class'=>$class, ':year'=>$year];
        $arrStudent = $this->queryAll($sql,$params);

        //subject in class
        $sql = "select s.name , s.detail , c.* from $this_db_course c  left join $this_db_subject s on c.subject_id = s.id where c.classroom =:class and c.year =:year";
        $params = [':class'=>$class, ':year'=>$year];
        $arrSubject = $this->queryAll($sql,$params);

        //grade
        $sql = "select g.* from $this_db g left join $this_db_course c on g.course_id = c.id where c.year =:year and c.classroom=:class";
        $params = [':class'=>$class, ':year'=>$year];
        $arrGrade = $this->queryAll($sql,$params);
        $listGrade = [];
        foreach ($arrGrade as $item){
            $key = $item['course_id'].''.$item['student_id'];
            $listGrade[$key]= ['score'=>$item['score'] , 'final_exam'=>$item['final_exam']];
        }

        //student grade
        foreach ($arrStudent as $k=>$item){
            $student_id = $item['id'];
            $g = [];
            foreach ($arrSubject as $item2){
                $course_id = $item2['id'];
                $key = $course_id.''.$student_id;
                if(isset($listGrade[$key])){
                    $g[] = $listGrade[$key];
                }else{
                    $g[] = ['score'=>'' , 'final_exam'=>'' ];
                }
            }
            $arrStudent[$k]['grade'] = $g;
        }



        //close DB
        $this->close();

        $dataReturn = [
            'header'=>$arrSubject,
            'student'=>$arrStudent
        ];
        return $dataReturn;
    }

    function selectGradeByStudentId($year , $class , $student_id){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;
        $this_db_course = $this->FKCourse;
        $this_db_subject = $this->FKSubject;

        //connect DB
        $this->connect();


        //student in class
        $sql = "select u.name , u.surname , s.* from $this_db_student s  left join $this_db_user u on s.user_id = u.id where s.class=:class and s.year=:year and s.id=:student_id";
        $params = [':class'=>$class, ':year'=>$year , ':student_id'=>$student_id];
        $arrStudent = $this->query($sql,$params);

        //subject in class
        $sql = "select s.name , s.detail , c.* from $this_db_course c  left join $this_db_subject s on c.subject_id = s.id where c.classroom =:class and c.year =:year";
        $params = [':class'=>$class, ':year'=>$year];
        $arrSubject = $this->queryAll($sql,$params);

        //grade
        $sql = "select g.* from $this_db g left join $this_db_course c on g.course_id = c.id where c.year =:year and c.classroom=:class and student_id=:student_id";
        $params = [':class'=>$class, ':year'=>$year  , ':student_id'=>$student_id];
        $arrGrade = $this->queryAll($sql,$params);
        $listGrade = [];
        foreach ($arrGrade as $item){
            $key = $item['course_id'];
            $listGrade[$key]= $item;//$item['score'];
        }

        //student grade
        foreach ($arrSubject as $k=>$item){
            $key =  $item['id'];
            if(isset($listGrade[$key])){
                $arrSubject[$k]['grade'] = $listGrade[$key]['score'];
                $arrSubject[$k]['final_exam'] = $listGrade[$key]['final_exam'];
            }else{
                $arrSubject[$k]['grade'] = '';
                $arrSubject[$k]['final_exam'] = '';
            }

        }



        //close DB
        $this->close();

        $dataReturn = [
            'student'=>$arrStudent,
            'grade'=>$arrSubject
        ];
        return $dataReturn;
    }

    function selectGradeByUserId($user_id){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;

        //connect DB
        $this->connect();

        $sql = "select t.* from $this_db_student as t left join  $this_db_user as u on u.id = t.user_id where t.user_id =:user_id order by t.year ASC , t.class ASC";
        $params = ['user_id'=>$user_id];
        $arrStudent = $this->queryAll($sql,$params);
        foreach ($arrStudent as $key=>$item){
            $id = $item['id'];
            $class = $item['class'];
            $year = $item['year'];

            if($class==10){
                $class_str = 'ชั้นอนุบาล 1';
            }elseif ($class==20){
                $class_str = 'ชั้นอนุบาล 2';
            }else{
                $class_str = 'ชั้นประถมศึกษาปีที่ '.$class;
            }
            $arrStudent[$key]['class_str'] = $class_str;
            $arrStudent[$key]['year_str'] = $year+543;


            $grade = $this->selectGradeByStudentId($year,$class,$id);
            $arrStudent[$key]['grade'] = $grade['grade'];


        }

        //close DB
        $this->close();

        return $arrStudent;

    }


}