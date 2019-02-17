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

            $se = $item['score_exam'];
            $ce = $item['center_exam'];
            $fe = $item['final_exam'];
            $sum = (is_numeric($se)?$se:0) + (is_numeric($ce)?$ce:0) + (is_numeric($fe)?$fe:0);
            $sum = ($sum==0)?'':$sum;

            $listGrade[$key]= ['score'=>$item['score'] , 'final_exam'=>$sum ];
        }

        //student grade
        foreach ($arrStudent as $k=>$item){
            $student_id = $item['id'];
            $g = [];
            $gSum =0;
            $gCount =0;
            $pSum =0;
            foreach ($arrSubject as $item2){
                $course_id = $item2['id'];
                $key = $course_id.''.$student_id;
                if(isset($listGrade[$key])){
                    $g[] = $listGrade[$key];
                    $score = $listGrade[$key]['score'];
                    $final = $listGrade[$key]['final_exam'];
                }else{
                    $g[] = ['score'=>'' , 'final_exam'=>'' ];
                    $score = '';
                    $final = '';
                }
                if(is_numeric($score)){
                    $gSum = $gSum + $score;
                    $gCount = $gCount+1;
                }
                $final = is_numeric($final)?$final:0;
                $pSum = $pSum+$final;
            }
            $arrStudent[$k]['seq'] = ($k+1);
            $arrStudent[$k]['gpa']= $gCount>0?($gSum/$gCount):'';
            $arrStudent[$k]['sum_score']=$pSum;
            $sort = intval($arrStudent[$k]['gpa']);
            $arrStudent[$k]['sort'] = intval(($sort*100).''.$pSum);

            $arrStudent[$k]['grade'] = $g;
        }

        if(count($arrStudent)>0){
            $this->sksort($arrStudent,'sort',false);
            foreach ($arrStudent as $k => $item){
                $arrStudent[$k]['seq'] = ($k+1);
            }
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
                $se = $listGrade[$key]['score_exam'];
                $ce = $listGrade[$key]['center_exam'];
                $fe = $listGrade[$key]['final_exam'];
                $arrSubject[$k]['grade'] = $listGrade[$key]['score'];
                $arrSubject[$k]['score_exam'] = $se;
                $arrSubject[$k]['center_exam'] = $ce;
                $arrSubject[$k]['final_exam'] = $fe;
                $sum = (is_numeric($se)?$se:0) + (is_numeric($ce)?$ce:0) + (is_numeric($fe)?$fe:0);
                $sum = ($sum==0)?'':$sum;
                $arrSubject[$k]['sum_score'] = $sum;
            }else{
                $arrSubject[$k]['grade'] = '';
                $arrSubject[$k]['score_exam'] = '';
                $arrSubject[$k]['center_exam'] = '';
                $arrSubject[$k]['final_exam'] = '';
                $arrSubject[$k]['sum_score'] = '';
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

            if($class>=10){
                $class_str = 'ชั้นอนุบาล '.($class/10);
            }else{
                $class_str = 'ชั้นประถมศึกษาปีที่ '.$class;
            }
            $arrStudent[$key]['class_str'] = $class_str;
            $arrStudent[$key]['year_str'] = $year+543;

            $arrStudent[$key]['seq'] = $this->fnRangGrade($user_id,$year,$class);


            $grade = $this->selectGradeByStudentId($year,$class,$id);
            $arrStudent[$key]['grade'] = $grade['grade'];


        }

        //close DB
        $this->close();

        return $arrStudent;

    }



    /*
     * ========================= function =========================
     */


    function sksort(&$array, $subkey="id", $sort_ascending=false) {

        if (count($array))
            $temp_array[key($array)] = array_shift($array);

        foreach($array as $key => $val){
            $offset = 0;
            $found = false;
            foreach($temp_array as $tmp_key => $tmp_val)
            {
                if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
                {
                    $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                        array($key => $val),
                        array_slice($temp_array,$offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
        }

        if ($sort_ascending) $array = array_reverse($temp_array);

        else $array = $temp_array;
    }

    function fnRangGrade($user_id , $year , $class){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;
        $this_db_course = $this->FKCourse;

        //connect DB
        $this->connect();


        //student in class
        $sql = "select s.* from $this_db_student s  left join $this_db_user u on s.user_id = u.id where s.class=:class and s.year=:year";
        $params = [':class'=>$class, ':year'=>$year];
        $arrStudent = $this->queryAll($sql,$params);

        //subject in class
        $sql = "select id from $this_db_course  where classroom =:class and year =:year";
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
            $gSum =0;
            $gCount =0;
            $pSum =0;
            foreach ($arrSubject as $item2){
                $course_id = $item2['id'];
                $key = $course_id.''.$student_id;
                if(isset($listGrade[$key])){
                    $score = $listGrade[$key]['score'];
                    $final = $listGrade[$key]['final_exam'];
                }else{
                    $score = '';
                    $final = '';
                }
                if(is_numeric($score)){
                    $gSum = $gSum + $score;
                    $gCount = $gCount+1;
                }
                $final = is_numeric($final)?$final:0;
                $pSum = $pSum+$final;
            }
            $arrStudent[$k]['seq'] = ($k+1);
            $arrStudent[$k]['gpa']= $gCount>0?($gSum/$gCount):'';
            $arrStudent[$k]['sum_score']=$pSum;
            $arrStudent[$k]['sort'] = intval((intval($arrStudent[$k]['gpa'])*100).''.$pSum);

        }

        $dataReturn = '';
        if(count($arrStudent)>0){
            $this->sksort($arrStudent,'sort',false);
            foreach ($arrStudent as $k => $item){
                if($arrStudent[$k]['user_id']==$user_id && is_numeric($arrStudent[$k]['gpa'])){
                    $dataReturn = $k+1;
                }
            }
        }


        //close DB
        $this->close();
        return $dataReturn;



    }


}