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

    function update_note($subscriber_trainers_id,$subscriber_trainers_subscription_note){
        try{
            $sql = 'UPDATE subscriber_trainers
            SET subscriber_trainers_subscription_note = :subscriber_trainers_subscription_note
            WHERE subscriber_trainers_id = :subscriber_trainers_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscriber_trainers_id', $subscriber_trainers_id);
            $query->bindParam(':subscriber_trainers_subscription_note', $subscriber_trainers_subscription_note);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }


    

    function fetch_trainers($subscriber_trainers_subscriber_id){
        try{
            $sql = 'SELECT subscriber_trainers_id,trainer_id,trainer_user_id,user_firstname,user_middlename,user_lastname,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_profile_picture,user_birthdate,user_gender_details,trainer_availability_details, 
            DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscriber_trainers_subscription_note
             FROM subscriber_trainers
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

    

    
    function report_most_availed_trainer(){
        try{
            $sql = 'SELECT count(subscriber_trainers_id)as subscriber_trainers_id,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS user_fullname,count(subscriber_trainers_trainer_id)as subscriber_trainers_trainer_count 
            FROM subscriber_trainers
            LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
            LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
            LEFT OUTER JOIN subscriptions  ON subscriber_trainers.subscriber_trainers_subscription_id=subscriptions.subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            WHERE (subscription_status_details = "Active" AND (DATE(subscription_start_date) >= current_date - interval "15" day)) OR (subscription_status_details = "Completed" AND (DATE(subscription_start_date) >= current_date - interval "15" day))
            GROUP BY subscriber_trainers_trainer_id
            ORDER BY DATE(subscription_start_date) ASC
            ;';
            $query=$this->db->connect()->prepare($sql);
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

    function fetch_to_train_list($user_id){
        try{
            $sql = 'SELECT subscriber_trainers_id,trainer_user_id,CONCAT(s_users.user_lastname,", ",s_users.user_firstname," ",s_users.user_middlename) as user_fullname,subscriber_trainers_subscriber_id,s_users.user_birthdate,user_gender_details,s_users.user_profile_picture, 
            DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscriber_trainers_subscription_note
            FROM subscriber_trainers 
            LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
            LEFT OUTER JOIN users ON users.user_id=trainers.trainer_user_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users as s_users ON s_users.user_id=subscriptions.subscription_subscriber_user_id
            LEFT OUTER JOIN user_genders ON s_users.user_gender_id=user_genders.user_gender_id
            WHERE users.user_id = :user_id AND  subscription_status_details = "Active";
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
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

    function fetch_subscriber_trainers_subscriber_ids($subscriber_trainers_trainer_id){
        try{
            $sql = 'SELECT CONCAT(user_lastname,", ",user_firstname," ",user_middlename) as user_fullname,subscriber_trainers_subscriber_id FROM subscriber_trainers 
            LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
            LEFT OUTER JOIN users ON users.user_id=trainers.trainer_user_id
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            WHERE subscriber_trainers_trainer_id = :subscriber_trainers_trainer_id AND  subscription_status_details = "Active";           
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