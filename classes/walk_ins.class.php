<?php 
require_once 'database.php';
class walk_ins
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_walk_in_price($walk_in_service_details){
        try{
            $sql = 'SELECT walk_in_price_id, walk_in_service_details, walk_in_service_price FROM walk_in_prices 
            LEFT OUTER JOIN walk_in_services ON walk_in_prices.walk_in_service_id=walk_in_services.walk_in_service_id
            WHERE walk_in_service_details = :walk_in_service_details;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_service_details', $walk_in_service_details);
            if($query->execute()){
                $data =  $query->fetch();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function insert_gym_and_trainer_walk_in($walk_in_user_id,$walk_in_trainer_id){
        try{
    
            $sql = 'INSERT INTO walk_ins (walk_in_id, walk_in_user_id, walk_in_trainer_id, walk_in_service_id, walk_in_price)VALUES
            (
                null,
                :walk_in_user_id,
                :walk_in_trainer_id,
                (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = "Gym-Use and Trainer"),
                (SELECT walk_in_service_price FROM walk_in_prices WHERE walk_in_service_id =(SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = "Gym-Use"))+
                (SELECT walk_in_service_price FROM walk_in_prices WHERE walk_in_service_id =(SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = "Walk-In Trainer"))
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_user_id', $walk_in_user_id);
            $query->bindParam(':walk_in_trainer_id', $walk_in_trainer_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
    function insert_gym_walk_in($walk_in_user_id){
        try{
    
            $sql = 'INSERT INTO walk_ins (walk_in_id, walk_in_user_id, walk_in_trainer_id, walk_in_service_id, walk_in_price)VALUES
            (
                null,
                :walk_in_user_id,
                null,
                (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = "Gym-Use"),
                (SELECT walk_in_service_price FROM walk_in_prices WHERE walk_in_service_id =(SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = "Gym-Use"))
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_user_id', $walk_in_user_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function get_all_walkins(){
        try{
        $sql = 'SELECT walk_in_id,CONCAT(u.user_lastname,", ",u.user_firstname," ",u.user_middlename) AS user_fullname, walk_in_service_details, walk_in_date,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS trainer_fullname FROM walk_ins
        LEFT OUTER JOIN users as u ON walk_ins.walk_in_user_id=u.user_id
        LEFT OUTER JOIN walk_in_services ON walk_ins.walk_in_service_id=walk_in_services.walk_in_service_id
        LEFT OUTER JOIN trainers ON walk_ins.walk_in_trainer_id=trainers.trainer_id
        LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
        ORDER BY walk_in_date DESC
        ;';
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            return $query->fetchAll();
        }else{
            return false;
        }
        }catch (PDOException $e){
            return false;
        }
    }

    function get_all_walkins_limit(){
        try{
        $sql = 'SELECT walk_in_id,CONCAT(u.user_lastname,", ",u.user_firstname," ",u.user_middlename) AS user_fullname, walk_in_service_details, walk_in_date,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS trainer_fullname FROM walk_ins
        LEFT OUTER JOIN users as u ON walk_ins.walk_in_user_id=u.user_id
        LEFT OUTER JOIN walk_in_services ON walk_ins.walk_in_service_id=walk_in_services.walk_in_service_id
        LEFT OUTER JOIN trainers ON walk_ins.walk_in_trainer_id=trainers.trainer_id
        LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
        ORDER BY walk_in_date DESC
        LIMIT 5
        ;';
        $query=$this->db->connect()->prepare($sql);
        if($query->execute()){
            return $query->fetchAll();
        }else{
            return false;
        }
        }catch (PDOException $e){
            return false;
        }
    }

    function delete_walk_in($walk_in_id){
        try{
            $sql = 'DELETE FROM walk_ins
            WHERE walk_in_id = :walk_in_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_id', $walk_in_id);
            return $query->execute();
            }catch (PDOException $e){
                return false;
            }
    }
    
}


?>