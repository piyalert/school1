<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/2/2018
 * Time: 2:23 PM
 */

require_once __DIR__."/_DBPDO.php";

class Saving extends _DBPDO
{
    private $DB = 'saving';
    private $FKUser = 'user';
    private $FKStudent = 'student';

    function insertSaving($input){
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

    function insertSavingDepositList($active_user , $year , $date , $list){
        $this_db = $this->DB;

        //connect DB
        $this->connect();

        $list_cut = explode(',',$list);
        for($i=0;$i<count($list_cut);$i++){
            $list_box = explode(':',$list_cut[$i]);
            $user_id = $list_box[0];
            $balance = $list_box[1];

            $sql = "SELECT * FROM $this_db WHERE user_id=:user_id AND date_at=:date_at";
            $params = array(':user_id'=>$user_id,'date_at'=>$date);
            $result = $this->query($sql,$params);

            if(isset($result['id'])){
                $sql = "UPDATE $this_db SET balance=:balance WHERE user_id=:user_id AND date_at=:date_at";
                $params = array(':balance'=>$balance,':user_id'=>$user_id,'date_at'=>$date);
                $lastId = $this->update($sql,$params);
            }else{
                $sql = "INSERT INTO $this_db ( user_id, active_user, balance, date_at, year)
                VALUES ( :user_id , :active_user , :balance , :date_at , :year )";
                $params = array(':user_id'=>$user_id , ':active_user'=>$active_user, ':balance'=>$balance , ':date_at'=>$date , ':year'=>$year);
                $lastId = $this->insert($sql,$params);
            }

        }

        //close DB
        $this->close();
        return $lastId;
    }

    function insertUpdateSaving($active_user , $user_id , $year , $ymd , $balance , $type ){
        $this_db = $this->DB;

        //connect DB
        $this->connect();

        $sql = "SELECT * FROM $this_db WHERE user_id=:user_id AND date_at=:date_at";
        $params = array(':user_id'=>$user_id,'date_at'=>$ymd);
        $result = $this->query($sql,$params);

        if(isset($result['id'])){
            $sql = "UPDATE $this_db SET balance=:balance WHERE user_id=:user_id AND date_at=:date_at";
            $params = array(':balance'=>$balance,':user_id'=>$user_id,'date_at'=>$ymd);
            $lastId = $this->update($sql,$params);
        }else{
            $sql = "INSERT INTO $this_db ( user_id, active_user, balance, date_at, year , event)
                VALUES ( :user_id , :active_user , :balance , :date_at , :year , :event )";
            $params = array(':user_id'=>$user_id , ':active_user'=>$active_user, ':balance'=>$balance , ':date_at'=>$ymd , ':year'=>$year , ':event'=>$type);
            $lastId = $this->insert($sql,$params);
        }

        //close DB
        $this->close();
        return $lastId;
    }

    function editSaving($input , $condition){
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

    function deleteSaving($id){
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

    function selectSavingBalance($year,$class){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;

        //connect DB
        $this->connect();
        $sql = "SELECT us.id, st.class , st.year , us.name , us.surname , sa.* FROM $this_db_student st 
        LEFT JOIN $this_db_user us ON st.user_id = us.id
        LEFT JOIN (
        SELECT user_id , SUM(IF(`event`='deposit',balance,0)) as sum_deposit,
        SUM(IF(`event`='withdraw',balance,0)) as sum_withdraw FROM $this_db WHERE year = $year
        GROUP BY user_id
        ) sa ON us.id = sa.user_id
        WHERE st.class = $class AND st.year = $year ";
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }

    function selectSavingBalanceAll($year,$class){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;

        //connect DB
        $this->connect();
        $sql = "SELECT us.id, st.class , st.year , us.name , us.surname , sa.* FROM $this_db_student st 
        LEFT JOIN $this_db_user us ON st.user_id = us.id
        LEFT JOIN (
        SELECT user_id , SUM(IF(`event`='deposit',balance,0)) as sum_deposit,
        SUM(IF(`event`='withdraw',balance,0)) as sum_withdraw FROM $this_db GROUP BY user_id
        ) sa ON us.id = sa.user_id
        WHERE st.class = $class AND st.year = $year ";
        $params= array();
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;

    }

    function selectSavingLastDeposit($year,$class){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;

        //connect DB
        $this->connect();

        $sql = "SELECT us.id, st.class , st.year, us.name , us.surname , sav.balance, sav.date_at FROM $this_db_student st 
        LEFT JOIN $this_db_user us ON st.user_id = us.id
        LEFT JOIN ( SELECT * FROM $this_db s WHERE s.date_at = (SELECT MAX(date_at) FROM $this_db sv WHERE sv.`event`='deposit' AND sv.user_id = s.user_id ) ) AS sav ON sav.user_id = us.id
        WHERE st.class =:class AND st.year =:year";
        $params= array(':class'=>$class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);

        //close DB
        $this->close();


        return $result;

    }

    function selectSavingYMDDeposit($year,$class,$ymd){
        //set parameter
        $this_db = $this->DB;
        $this_db_user = $this->FKUser;
        $this_db_student = $this->FKStudent;

        //connect DB
        $this->connect();

        $sql = "SELECT us.id, st.class , st.year, us.name , us.surname , sav.balance, sav.date_at FROM $this_db_student st 
        LEFT JOIN $this_db_user us ON st.user_id = us.id
        LEFT JOIN ( SELECT * FROM $this_db s WHERE s.event='deposit' AND s.date_at =:ymd ) AS sav ON sav.user_id = us.id
        WHERE st.class =:class AND st.year =:year";
        $params= array(':ymd'=>$ymd, ':class'=>$class , ':year'=>$year);
        $result = $this->queryAll($sql,$params);

        //close DB
        $this->close();


        return $result;

    }

    function selectSavingYMDUserId($user_id , $ymd , $event='deposit'){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();

        $sql = "SELECT * FROM $this_db WHERE user_id =:user_id AND date_at =:ymd AND event =:event";
        $params= array('user_id'=>$user_id ,':ymd'=>$ymd , ':event'=>$event);
        $result = $this->query($sql,$params);

        //close DB
        $this->close();


        return $result;

    }

    function selectSavingByUserId($user_id=''){
        $this_db = $this->DB;
        //set parameter

        //connect DB
        $this->connect();
        $sql = "SELECT * FROM $this_db WHERE user_id=:user_id ORDER BY date_at DESC";
        $params= array(':user_id'=> $user_id);
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function selectTotalSavingByUserId($user_id=''){
        $this_db = $this->DB;
        //set parameter

        //connect DB
        $this->connect();
        $sql = "SELECT user_id , SUM(IF(`event`='deposit',balance,0)) as sum_deposit,
        SUM(IF(`event`='withdraw',balance,0)) as sum_withdraw FROM $this_db WHERE user_id = :user_id
        GROUP BY user_id";
        $params= array(':user_id'=> $user_id);
        $result = $this->query($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

    function selectGroupYear($user_id){
        //set parameter
        $this_db = $this->DB;

        //connect DB
        $this->connect();
        $sql = "select s.year ,
sum(if(STRCMP(s.event,\"deposit\") = 0 ,s.balance,0)) as sum_deposit,
sum(if(STRCMP(s.event,\"withdraw\") = 0 ,s.balance,0)) as sum_withdraw
 from $this_db s 
 where s.user_id = :id
 group by s.year";
        $params = [':id'=>$user_id];
        $result = $this->queryAll($sql,$params);
        //close DB
        $this->close();


        return $result;
    }

}