<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/14/2018
 * Time: 3:07 PM
 */
require_once __DIR__."/_DBPDO.php";

class Student extends _DBPDO
{
    private $DB = 'student';
    private $FKDB = 'user';

    function insertStudent($input){
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

    function insertStudentList($student_list_id,$class,$year){
        $this_db = $this->DB;
        $this_fk = $this->FKDB;
        //set parameter
        $count = 0;

        //connect DB
        $this->connect();

        $sql = "SELECT * FROM $this_fk WHERE id IN ($student_list_id)";
        $result = $this->queryNoParams($sql);
        foreach ($result as $item){
            $sql = "INSERT INTO $this_db (user_id,class,year,parent)
             VALUES (:user_id,:class,:year,:parent)";
            $params = [
                ':user_id'=>$item['id'],
                ':class'=>$class,
                ':year'=>$year,
                ':parent'=>""
            ];
            $lastId = $this->insert($sql,$params);
            if($lastId>0){
                $count++;
            }
        }

        //close DB
        $this->close();


        return $count;
    }

    function editStudent($input , $condition){
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

    function deleteStudent($id){
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

    function selectThisAll($condition){
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

    function selectQuery($sql){

        //connect DB
        $this->connect();
        $result = $this->queryAll($sql,[]);
        //close DB
        $this->close();


        return $result;
    }

    function selectStudentLast($user_id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();

        $sql = "SELECT * FROM $this_db WHERE user_id=:user_id  ORDER BY year DESC , class DESC limit 1";
        $params = ['user_id'=>$user_id];
        $result = $this->query($sql,$params);

        //close DB
        $this->close();


        return $result;
    }

    function selectStudentByClassAndYear($class , $year){
        //set parameter
        $this_db = $this->DB;
        $this_user = $this->FKDB;

        //connect DB
        $this->connect();
        $sql = "SELECT $this_db.id as student_id, $this_db.`status` as student_status, $this_db.parent ,  $this_user.* FROM $this_db
LEFT JOIN $this_user ON $this_db.user_id = $this_user.id
WHERE $this_db.class = :class AND $this_db.year = :year";
        $params= array(':class'=> $class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }

    function aboutStudent($class , $year){
        //set parameter
        $this_db = $this->DB;
        $this_user = $this->FKDB;

        //connect DB
        $this->connect();
        $sql = "select sum(if(u.gender='m',1,0)) as sum_m  , sum(if(u.gender='f',1,0)) as sum_f from $this_db s 
        left join $this_user u on s.user_id = u.id
        where s.class=:class and s.year=:year
        group by s.class";
        $params= array(':class'=> $class , ':year'=>$year);
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        if(intval($class)==10){
            $strClass='อนุบาล1';
        }elseif (intval($class)==20){
            $strClass='อนุบาล2';
        }elseif (intval($class)==30){
            $strClass='อนุบาล3';
         }else{
            $strClass='ชั้นประถมศึกษาปีที่ '.$class;
        }

        $sumM =0;
        $sumF =0;
        if(isset($result['sum_m'])){
            $sumM = $result['sum_m'];
            $sumF = $result['sum_f'];
        }

        return ['class'=>$strClass,'sum_f'=>$sumF, 'sum_m'=>$sumM];
    }




}