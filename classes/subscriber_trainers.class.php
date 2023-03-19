<?php 
require_once 'database.php';
class subscriber_trainers
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert_subscriber_trainers($subscriber_trainers_subscriber_id,$subscriber_trainers_trainer_id,$subscriber_trainers_subscription_id){
        try{
            $sql = 'INSERT INTO subscriber_trainers VALUES
            (
                null,
                :subscriber_trainers_subscriber_id,
                :subscriber_trainers_trainer_id,
                :subscriber_trainers_subscription_id
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_subscriber_id', $subscriber_trainers_subscriber_id);
            $query->bindParam(':subscriber_trainers_trainer_id', $subscriber_trainers_trainer_id);
            $query->bindParam(':subscriber_trainers_subscription_id', $subscriber_trainers_subscription_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_trainers($subscriber_trainers_subscriber_id){
        try{
            $sql = 'SELECT trainer_id,user_firstname,user_middlename,user_lastname,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_profile_picture,user_birthdate,user_gender_details,trainer_availability_details FROM subscriber_trainers
            LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            WHERE subscriber_trainers_subscriber_id = :subscriber_trainers_subscriber_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active");
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_subscriber_id', $subscriber_trainers_subscriber_id);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_to_train_today($subscriber_trainers_trainer_id){
        try{
            $sql = 'SELECT  CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriber_trainers 
            LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            WHERE subscriber_trainers_trainer_id = :subscriber_trainers_trainer_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active");
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_trainer_id', $subscriber_trainers_trainer_id);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function fetch_to_train_today_full_details($subscriber_trainers_trainer_id){
        try{
            $sql = 'SELECT  CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, user_gender_details, user_birthdate FROM subscriber_trainers 
            LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            WHERE subscriber_trainers_trainer_id = :subscriber_trainers_trainer_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active");';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_trainer_id', $subscriber_trainers_trainer_id);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_total_person_who_availed($subscriber_trainers_trainer_id){
        try{
            $sql = 'SELECT  user_gender_details FROM subscriber_trainers 
            LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            WHERE subscriber_trainers_trainer_id =:subscriber_trainers_trainer_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active") ;            
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_trainer_id', $subscriber_trainers_trainer_id);
            if($query->execute()){
                $data =  $query->fetchAll();
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
}


?>