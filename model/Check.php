<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 8/9/2018
 * Time: 4:38 PM
 */
require_once __DIR__."/_DBPDO.php";

class Check extends _DBPDO
{
    public $DB = "date_check";
    private $FKUser = 'user';
    private $FKStudent = 'student';

    function insertCheck($input){
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

    function updateCheck($input , $condition){
        $this_db = $this->DB;

        $data_sql = $this->convertArrayToUpdate($input,$condition);
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


    function insertUpdateCheckList($year , $date , $list){
        $this_db = $this->DB;

        //connect DB
        $this->connect();

        $list_cut = explode(',',$list);
        for($i=0;$i<count($list_cut);$i++){
            $list_box = explode(':',$list_cut[$i]);
            $student_id = $list_box[0];
            $check_status = $list_box[1];
            $note = $list_box[2];

            $sql = "SELECT * FROM $this_db WHERE student_id=:student_id AND date_at=:date_at";
            $params = array(':student_id'=>$student_id,'date_at'=>$date);
            $result = $this->query($sql,$params);

            if(isset($result['id'])){
                $sql = "UPDATE $this_db SET check_status=:check_status , note=:note WHERE student_id=:student_id AND date_at=:date_at";
                $params = array(':check_status'=>$check_status,':note'=>$note,':student_id'=>$student_id,'date_at'=>$date);
                $lastId = $this->update($sql,$params);
            }else{
                $sql = "INSERT INTO $this_db ( student_id, date_at, year, check_status, note)
                VALUES ( :student_id , :date_at , :year , :check_status , :note )";
                $params = array(':student_id'=>$student_id , ':date_at'=>$date, ':year'=>$year , ':check_status'=>$check_status , ':note'=>$note);
                $lastId = $this->insert($sql,$params);
            }

        }

        //close DB
        $this->close();
        return $lastId;
    }


    function deleteCheck($id){
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

    function selectCheck($condition){
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

    function selectList($class , $year){
        //set parameter
        $this_db = $this->DB;
        $this_user = $this->FKUser;
        $this_student = $this->FKStudent;

        //connect DB
        $this->connect();
        $sql = "select s.* , u.name , u.surname , c.* from $this_student s 
        left join $this_user u on s.user_id = u.id
        left join 
        (
        select c.student_id,
        sum(if(c.check_status='come', 1, 0)) as s_come ,
        sum(if(c.check_status='missing', 1, 0)) as s_missing ,
        sum(if(c.check_status='leave', 1, 0)) as s_leave ,
        sum(if(c.check_status='late', 1, 0)) as s_late ,
        sum(if(c.check_status='blank', 1, 0)) as s_blank
        from $this_db c
        where c.year=:cyear
        group by c.student_id
        ) as c  on s.id = c.student_id
        where s.class=:class AND s.year=:year";
        $params= array(':cyear'=>$year , ':class'=>$class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function selectLastDate($class , $year,$ymd){
        //set parameter
        $this_db = $this->DB;
        $this_student = $this->FKStudent;

        //connect DB
        $this->connect();
        $sql = "select * from $this_student s 
        left join (select c.student_id , c.check_status from $this_db c where c.date_at =:ymd ) as c on s.id = c.student_id
        where s.class=:class AND s.year=:year";
        $params= array(':ymd'=>$ymd , ':class'=>$class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();

        $data_return = [];
        foreach ($result as $item){
            $data_return[$item['id']] = !is_null($item['check_status'])?$item['check_status']:'blank';
        }

        return $data_return;
    }

    //date
    function dateFullThai($ymd){
        $ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
        $ThMonth = array ( "","มกรามก", "กุมภาพันธ์", "มีนาคม", "เมษายน","พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม","กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม","" );

        $d = date("d",strtotime($ymd));
        $m = date("m",strtotime($ymd));
        $y = date("Y",strtotime($ymd));
        $w = date("w",strtotime($ymd));

        return 'วัน'.($ThDay[$w]).' ที่ '.$d .' เดือน'.($ThMonth[intval($m)]). ' พ.ศ. '.($y+543);
    }


    //teacher check show
    /* select name student */
    function selectStudent($student_id){
        //set parameter
        $this_student = $this->FKStudent;
        $this_user = $this->FKUser;

        //connect DB
        $this->connect();
        $sql = "SELECT u.id, u.name , u.surname FROM $this_student AS s LEFT JOIN  $this_user AS u ON s.user_id = u.id where s.id =:id";
        $params = [':id'=>$student_id];
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;

    }
    /* select check days list */
    function selectListDay($student_id , $year , $month){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "select c.* , DAY(c.date_at) as _day from $this_db c
                where YEAR(c.date_at) = :year
                and MONTH(c.date_at) = :month
                and c.student_id = :id ";
        $params = [':year'=>$year , ':month'=>$month,':id'=>$student_id];
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();
        $data_return = [];
        foreach ($result as $item){
            $data_return[intval($item['_day'])] = $item;
        }


        return $data_return;
    }

    /* group by year sum all */
    function selectGroupYear($user_id){
        //set parameter
        $this_db = $this->DB;
        $this_student = $this->FKStudent;

        //connect DB
        $this->connect();
        $sql = "select c.year , sum(if(STRCMP(c.check_status,\"come\") = 0 ,1,0)) as sum_com ,
sum(if(STRCMP(c.check_status,\"missing\") = 0 ,1,0)) as sum_missing,
sum(if(STRCMP(c.check_status,\"leave\") = 0 ,1,0)) as sum_leave,
sum(if(STRCMP(c.check_status,\"late\") = 0 ,1,0)) as sum_late
from $this_db  c 
left join $this_student s on c.student_id = s.id
where s.user_id = :id";
        $params = [':id'=>$user_id];
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }


}