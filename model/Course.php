<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/29/2018
 * Time: 4:14 PM
 */

require_once __DIR__."/_DBPDO.php";

class Course extends _DBPDO
{

    private $DB = 'course';
    private $FK = 'subject';

    function insertCourse($input){
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

    function insertCourseList($list_id,$class,$year){
        $this_db = $this->DB;
        $this_fk = $this->FK;
        //set parameter
        $count = 0;

        //connect DB
        $this->connect();

        $sql = "SELECT * FROM $this_fk WHERE id IN ($list_id)";
        $result = $this->queryNoParams($sql);
        foreach ($result as $item){
            $sql = "INSERT INTO $this_db (subject_id,classroom,year)
             VALUES (:subject_id,:class,:year)";
            $params = [
                ':subject_id'=>$item['id'],
                ':class'=>$class,
                ':year'=>$year
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

    function editCourse($input , $condition){
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

    function deleteCourse($id){
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

    function selectCourseByRoomAndYear($class,$year){
        //set parameter
        $this_db = $this->DB;
        $this_fk = $this->FK;

        $year = $year>2500?$year-543:$year;

        //connect DB
        $this->connect();
        $sql = "SELECT c.`*` , s.name , s.detail FROM $this_db AS c
        LEFT JOIN $this_fk AS s ON c.subject_id = s.id
        WHERE c.classroom =:class AND c.year =:year ";
        $params= array(':class'=>$class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }



}