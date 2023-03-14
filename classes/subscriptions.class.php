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
            $sql = 'SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
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

    function insert_subscription($subscription_quantity,$subscription_subscriber_user_id,$subscription_offer_name,$type_of_subscription_id,$subscription_duration,$subscription_price,$subscription_total_duration){
        try{
            $sql = 'INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_status_id, subscription_start_date)VALUES (
                null,
                :subscription_quantity,
                :subscription_subscriber_user_id,
                :subscription_offer_name,
                :type_of_subscription_id,
                :subscription_duration,
                :subscription_price,
                :subscription_total_duration,
                (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"),
                NOW()
            ); ';
            $query=$this->db->connect()->prepare($sql);
            
            $query->bindParam(':subscription_quantity', $subscription_quantity);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
            $query->bindParam(':subscription_offer_name', $subscription_offer_name);
            $query->bindParam(':type_of_subscription_id', $type_of_subscription_id);
            $query->bindParam(':subscription_duration', $subscription_duration);
            $query->bindParam(':subscription_price', $subscription_price);
            $query->bindParam(':subscription_total_duration', $subscription_total_duration);
             return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
}

?>
