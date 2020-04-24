<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/29/2018
 * Time: 4:14 PM
 */

require_once __DIR__."/_DBPDO.php";

class Subject extends _DBPDO
{

    private $DB = 'subject';

    function insertSubject($input){
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

    function editSubject($input , $condition){
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

    function removeSubject($id){
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "UPDATE $this_db SET remove_at='Y' WHERE id=:id";
        $params = array(':id'=>$id);
        $lastId = $this->update($sql,$params);

        //close DB
        $this->close();
        return $lastId;
    }

    function deleteSubject($id){
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

    function selectSubAll(){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db";
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }

    function selectSubRemove($status='N'){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db WHERE remove_at=:status";
        $params= array(':status'=>$status);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }


}