<?php 
require_once 'database.php';
class lockers
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_all_unavalable_lockers(){
        try{
            $sql = 'SELECT locker_id,locker_subscription_id,locker_UID FROM lockers
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=lockers.locker_subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE  subscription_status_details = "Active"
            ORDER BY locker_UID;';
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

    function insert($locker_subscription_id,$locker_UID){
        try{
            $sql = '    INSERT INTO lockers (locker_subscription_id,locker_UID) VALUES
            (
                :locker_subscription_id,
                :locker_UID
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_subscription_id', $locker_subscription_id);
            $query->bindParam(':locker_UID', $locker_UID);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_lockers_id($locker_subscription_id){
        try{
            $sql = 'SELECT locker_id,locker_UID FROM lockers
            WHERE locker_subscription_id =:locker_subscription_id
            ORDER BY locker_UID;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_subscription_id', $locker_subscription_id);
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
    function fetch_all_lockers(){
        try{
            $sql = 'SELECT locker_id,locker_UID FROM lockers;';
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
    
    function fetch_invalid_lockers(){
        try{
            $sql = 'SELECT locker_id,locker_UID FROM lockers
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=lockers.locker_subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE  subscription_status_details != "Active" 
            ORDER BY locker_UID;';
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

    function fetch_user_locker($user_id){
        try{
            $sql = 'SELECT locker_id,locker_UID,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date FROM lockers
            LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=lockers.locker_subscription_id
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE  subscription_status_details = "Active" AND user_id =:user_id
            ORDER BY locker_UID;';
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

    

    function fetch_locker_details($locker_id){
        try{
            $sql = 'SELECT locker_id,locker_subscription_id,locker_UID FROM lockers
            WHERE locker_id=:locker_id ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_id', $locker_id);
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
    function fetch_locker_details_with_locker_UID($locker_UID){
        try{
            $sql = 'SELECT locker_id,locker_subscription_id,locker_UID FROM lockers
            WHERE locker_UID=:locker_UID ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_UID', $locker_UID);
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
    function delete($locker_id){
        try{
            $sql = 'DELETE FROM lockers
            WHERE locker_id = :locker_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_id', $locker_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    // function update($locker_id,$locker_UID){
    //     try{
    //         $sql = '    INSERT INTO lockers (locker_subscription_id,locker_UID) VALUES
    //         (
    //             :locker_subscription_id,
    //             :locker_UID
    //         );';
    //         $query=$this->db->connect()->prepare($sql);
    //         $query->bindParam(':locker_subscription_id', $locker_subscription_id);
    //         $query->bindParam(':locker_UID', $locker_UID);
    //         return $query->execute();
    //     }catch (PDOException $e){
    //         return false;
    //     }
    // }




}


?>