<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/18/2018
 * Time: 12:15 PM
 */
require_once __DIR__."/_DBPDO.php";

class News extends _DBPDO
{

    public $DB = "news";

    function insertNews($input){
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

    function updateNews($input , $condition){
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

    function deleteNews($id){
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

    function selectAll(){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db ";
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function selectNewsId($id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db WHERE id=$id";
        $params= array();
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;
    }


}