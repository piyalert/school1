<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 5/24/2018
 * Time: 11:38 AM
 */
require_once __DIR__."/_DBPDO.php";

class User extends _DBPDO
{
    private $DB = 'user';

    function login($username , $password){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db WHERE username=:username AND password=:password";
        $params= array(':username'=> $username , ':password'=> $password);
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function insertUser($input){
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

    function updateUser($input , $condition){
        //set parameter

        //close DB
        $this->close();

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

    function deleteUser($id){
        //set parameter

        //connect DB
        $this->connect();
        $sql = "DELETE FROM user WHERE id=:id";
        $params= array(':id'=> $id);
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
    }

    function selectByStatus($status=''){
        //set parameter

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM user WHERE status=:status";
        $params= array(':status'=> $status);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function selectById($id=''){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db WHERE id=:id";
        $params= array(':id'=> $id);
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function searchAttr($attr,$value){
        $this_db = $this->DB;
        //set parameter

        //connect DB
        $this->connect();
        if($attr==''){
            return [];
        }
        elseif ($attr=='id'){
            $sql = "SELECT * FROM $this_db WHERE id=:id";
            $params= array(':id'=> $value);
        }else{
            $con = " $attr LIKE '%$value%'";
            $sql = "SELECT * FROM $this_db WHERE $con";
            $params= array();
        }

        $result = $this->queryAll($sql,$params);

        //close DB
        $this->close();


        return $result;
    }

}