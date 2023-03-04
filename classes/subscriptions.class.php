<?php 
require_once 'database.php';
class subscriptions
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function fetchAllActiveOrPendingSubscriptions($active, $pending, $completed, $deleted, $terminated){
        try{
            $sql = 'SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_subscriber_user_id FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
            WHERE subscription_status_details = :active OR  subscription_status_details = :pending OR  subscription_status_details = :completed OR  subscription_status_details = :deleted OR  subscription_status_details = :terminated
            ORDER BY user_fullname
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':active', $active);
            $query->bindParam(':pending', $pending);
            $query->bindParam(':completed', $completed);
            $query->bindParam(':deleted', $deleted);
            $query->bindParam(':terminated', $terminated);
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


    function fetchAllSubscriptionPerUser_id($active, $pending, $completed, $deleted, $terminated,$user_id){
        try{
            $sql = 'SELECT * FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_subscriber_user_id = :user_id AND ( subscription_status_details = :active OR  subscription_status_details = :pending OR  subscription_status_details = :completed OR  subscription_status_details = :deleted OR  subscription_status_details = :terminated);
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':active', $active);
            $query->bindParam(':pending', $pending);
            $query->bindParam(':completed', $completed);
            $query->bindParam(':deleted', $deleted);
            $query->bindParam(':terminated', $terminated);
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

    function fetchUserActiveAndPendingSubscription($user_id){
        try{
            $sql = 'SELECT * FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Pending") OR (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Active")
            ; ';
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
    
}

?>
