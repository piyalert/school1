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

    function insertUser($input){
        //set parameter
        $username = isset($input['username'])?$input['username']:'';
        $password = isset($input['password'])?$input['password']:'';
        $name = isset($input['name'])?$input['name']:'';
        $surname = isset($input['surname'])?$input['surname']:'';
        $id_card = isset($input['id_card'])?$input['id_card']:'';
        $birthday = isset($input['birthday'])?$input['birthday']:'';
        $address = isset($input['address'])?$input['address']:'';
        $phone = isset($input['phone'])?$input['phone']:'';
        $img_path= isset($input['img_path'])?$input['img_path']:'';
        $gender= isset($input['gender'])?$input['gender']:'f';
        $status= isset($input['status'])?$input['status']:'student';


        //connect DB
        $this->connect();
        $sql = "INSERT INTO user (username,password,name,surname,id_card,birthday,address,phone,img_path,gender,status) 
        VALUES (:username,:password,:name,:surname,:id_card,:birthday,:address,:phone,:img_path,:gender,:status)";
        $params= array(
            ':username'=> $username,
            ':password'=> $password,
            ':name'=> $name,
            ':surname'=> $surname,
            ':id_card'=> $id_card,
            ':birthday'=> $birthday,
            ':address'=> $address,
            ':phone'=> $phone,
            ':img_path'=> $img_path,
            ':gender'=> $gender,
            ':status'=> $status
        );
        $lastId = $this->insert($sql,$params);
        //close DB
        $this->close();


        return $lastId;
    }

    function updateUser($input){
        //set parameter
        $username = isset($input['username'])?$input['username']:'';
        $name = isset($input['name'])?$input['name']:'';
        $surname = isset($input['surname'])?$input['surname']:'';
        $id_card = isset($input['id_card'])?$input['id_card']:'';
        $birthday = isset($input['birthday'])?$input['birthday']:'';
        $address = isset($input['address'])?$input['address']:'';
        $phone = isset($input['phone'])?$input['phone']:'';
        $img_path= isset($input['img_path'])?$input['img_path']:'';
        $gender= isset($input['gender'])?$input['gender']:'f';
        $status= isset($input['status'])?$input['status']:'student';
        $id= isset($input['id'])?$input['id']:'';


        //connect DB
        $this->connect();
        $sql = "UPDATE user SET username=:username,name=:name,surname=:surname,id_card=:id_card,
        birthday=:birthday,address=:address,phone=:phone,img_path=:img_path,gender=:gender,status=:status 
        WHERE id=:id";
        $params= array(
            ':username'=> $username,
            ':name'=> $name,
            ':surname'=> $surname,
            ':id_card'=> $id_card,
            ':birthday'=> $birthday,
            ':address'=> $address,
            ':phone'=> $phone,
            ':img_path'=> $img_path,
            ':gender'=> $gender,
            ':status'=> $status,
            ':id'=> $id
        );
        $rowUpdate = $this->update($sql,$params);
        //close DB
        $this->close();


        return $rowUpdate;
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

}