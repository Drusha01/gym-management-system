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
            $sql = 'SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_subscriber_user_id,subscription_start_date FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
            WHERE subscription_status_details = :active OR  subscription_status_details = :pending OR  subscription_status_details = :completed OR  subscription_status_details = :deleted OR  subscription_status_details = :terminated
            ORDER BY subscription_start_date DESC
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
            $sql = 'SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end,
            ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due)as balance,subscription_paid_amount
            FROM subscriptions
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
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end,
            ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due)as balance,subscription_paid_amount
             FROM subscriptions
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

    function fetchUserLockerPendingSubscription($user_id){
        try{
            $sql = 'SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Pending" AND type_of_subscription_details = "Locker Subscription")
            ; ';
            $query=$this->db->connect()->prepare($sql);
            
            $query->bindParam(':user_id', $user_id);
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

    function fetchAllUserLockerActiveSubscription(){
        try{
            $sql = 'SELECT subscription_id,user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE (subscription_status_details = "Active" AND type_of_subscription_details = "Locker Subscription")
            ORDER by subscription_start_date DESC
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

    function get_sub_id($subscription_subscriber_user_id){
        try{
            $sql = 'SELECT * FROM subscriptions 
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE (subscription_subscriber_user_id = :subscription_subscriber_user_id AND  subscription_status_details = "Pending" AND type_of_subscription_details = "Trainer Subscription") ; ';
            $query=$this->db->connect()->prepare($sql);
            
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
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

    function fetch_distinct_years(){
        try{
            $sql = 'SELECT DISTINCT YEAR(subscription_start_date )AS YEAR FROM subscriptions
            ORDER BY YEAR ASC
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

    function fetch_sales_at_year($YEAR){
        try{
            $sql = 'SELECT SUM(subscription_paid_amount)as Sales_Revenue FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            WHERE YEAR(subscription_start_date ) = :YEAR AND (subscription_status_details = "Active"  OR subscription_status_details = "Completed") ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':YEAR', $YEAR);
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

    

    function fetch_history($subscription_subscriber_user_id){
        try{
            $sql = 'SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Completed" AND subscription_subscriber_user_id = :subscription_subscriber_user_id
            ;';
            $query=$this->db->connect()->prepare($sql);
            
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
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

    function activate_pending_subscription($subscription_subscriber_user_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active")
            WHERE  (subscription_subscriber_user_id = :subscription_subscriber_user_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"))
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function activate_pending_subscription_at($subscription_subscriber_user_id,$start_date){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_start_date =:start_date , 
            subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active")
            WHERE  (subscription_subscriber_user_id = :subscription_subscriber_user_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"))
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
            $query->bindParam(':start_date', $start_date);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function complete_active_subscriptions($subscription_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Completed")
            WHERE  subscription_id = :subscription_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active");';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete_pending_subscription($subscription_subscriber_user_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Deleted")
            WHERE  (subscription_subscriber_user_id = :subscription_subscriber_user_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"))
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete_active_subscription($subscription_subscriber_user_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Deleted")
            WHERE  (subscription_subscriber_user_id = :subscription_subscriber_user_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active"))
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_active_subs_payment($subscription_subscriber_user_id){
        try{
            $sql = 'SELECT subscription_id,subscription_status_details,type_of_subscription_details ,subscription_quantity, subscription_offer_name, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_date_created,subscription_date_updated,subscription_discount,subscription_penalty_due,subscription_paid_amount,
            ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount - subscription_paid_amount + subscription_penalty_due) as total FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE  (subscription_subscriber_user_id = :subscription_subscriber_user_id AND  subscription_status_details = "Active")
            ; ';
            $query=$this->db->connect()->prepare($sql);
            
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
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
    
    function get_number_of_gym_use(){
        try{
            $sql = 'SELECT SUM(subscription_quantity) as number_of_gym_use FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active"  AND type_of_subscription_details = "Gym Subscription"
            ; ';
            $query=$this->db->connect()->prepare($sql);
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
    function get_number_of_trainer_use(){
        try{
            $sql = 'SELECT SUM(subscription_quantity) as number_of_trainer_use FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active"  AND type_of_subscription_details = "Trainer Subscription"
            ; ';
            $query=$this->db->connect()->prepare($sql);
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
    function get_number_of_locker_use(){
        try{
            $sql = 'SELECT SUM(subscription_quantity) as number_of_locker_use FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active"  AND type_of_subscription_details = "Locker Subscription"
            ; ';
            $query=$this->db->connect()->prepare($sql);
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
    function get_number_of_program_use(){
        try{
            $sql = 'SELECT  SUM(subscription_quantity) as number_of_program_use FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active"  AND type_of_subscription_details ="Program Subscription"
            ; ';
            $query=$this->db->connect()->prepare($sql);
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

    function update_percentage_discount($subscription_id,$subscription_discount_percentage){
        try{
            $sql = 'UPDATE subscriptions
            SET  subscription_discount= (subscription_quantity* subscription_price * (subscription_total_duration / subscription_duration )) *  :subscription_discount_percentage
            WHERE subscription_id = :subscription_id ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_discount_percentage', $subscription_discount_percentage);
            $query->bindParam(':subscription_id', $subscription_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function update_fixed_discount($subscription_id,$subscription_fixed_discount){
        try{
            $sql = 'UPDATE subscriptions
            SET  subscription_discount= :subscription_fixed_discount
            WHERE subscription_id = :subscription_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_fixed_discount', $subscription_fixed_discount);
            $query->bindParam(':subscription_id', $subscription_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function get_subscription_details_with_subscription_id($subscription_id){
        try{
            $sql = 'SELECT * FROM subscriptions
            WHERE subscription_id = :subscription_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
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

    function full_payment($subscription_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_paid_amount =  ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due)
            WHERE subscription_id = :subscription_id; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function partial_payment($subscription_id,$subscription_paid_amount){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_paid_amount = :subscription_paid_amount +subscription_paid_amount
            WHERE subscription_id = :subscription_id; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
            $query->bindParam(':subscription_paid_amount', $subscription_paid_amount);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function void_payment($subscription_id,$subscription_void_amount){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_paid_amount =  subscription_paid_amount  - :subscription_void_amount
            WHERE subscription_id = :subscription_id; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
            $query->bindParam(':subscription_void_amount', $subscription_void_amount);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function recent_customers_subscribed(){
        try{
            $sql = 'SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_subscriber_user_id, subscription_start_date FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
            WHERE subscription_status_details = "Active" 
            ORDER BY subscription_start_date DESC 
            LIMIT 5; ';
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

    function total_number_of_availed_offers($subscription_subscriber_user_id){
        try{
            $sql = 'SELECT count(*) as total FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            WHERE subscription_status_details = "Active" AND subscription_subscriber_user_id = :subscription_subscriber_user_id; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_subscriber_user_id', $subscription_subscriber_user_id);
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

    function active_subscribed_users(){
        try{
            $sql = 'SELECT distinct user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE  subscription_status_details = "Active"
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

    function one_active_subscribed_user($user_id){
        try{
            $sql = 'SELECT distinct user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_password_hashed FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE  subscription_status_details = "Active" AND user_id =:user_id
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
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

    function delete_pending_sub($subscription_id){
        try{
            $sql = 'UPDATE subscriptions 
            SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Deleted")
            WHERE  (subscription_id =:subscription_id AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"));';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function get_user_details_with_subscription_id($subscription_id){
        try{
            $sql = 'SELECT user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriptions
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE subscription_id = :subscription_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':subscription_id', $subscription_id);
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

    function get_user_details_with_user_id($user_id){
        try{
            $sql = 'SELECT user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriptions
            LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
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

    
    function status_of_subscriptions(){
        try{
            $sql = 'SELECT count(case subscription_status_details when "Active" then 1 else null end)as active_subscriptions,count(case subscription_status_details when "Deleted" then 1 else null end)as deleted_subscriptions,
            count(case subscription_status_details when "Pending" then 1 else null end)as pending_subscriptions,count(case subscription_status_details when "Terminated" then 1 else null end)as terminated_subscriptions,
            count(case subscription_status_details when "Completed" then 1 else null end)as completed_subscriptions
            FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id;';
            $query=$this->db->connect()->prepare($sql);
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

    function report_subscriptions(){
        try{
            $sql = 'SELECT DATE(subscription_start_date) as subscription_start_date,sum(1*subscription_quantity) as subscription_count_per_day,
            sum(case type_of_subscription_details when "Program Subscription" then 1*subscription_quantity else null end)as program_subscriptions_count,
            sum(case type_of_subscription_details when "Gym Subscription" then 1*subscription_quantity else null end)as gym_subscriptions_count,
            sum(case type_of_subscription_details when "Locker Subscription" then 1*subscription_quantity else null end)as locker_subscriptions_count,
            sum(case type_of_subscription_details when "Trainer Subscription" then 1*subscription_quantity else null end) as trainer_subscriptions_count
            from subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active" OR subscription_status_details = "Completed" 
            GROUP BY DATE(subscription_start_date)
            ORDER BY subscription_start_date ASC;';
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

    function report_most_availed_offer(){
        try{
            $sql = 'SELECT subscription_offer_name,sum(subscription_quantity) as subscription_quantity FROM subscriptions 
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_status_details = "Active" OR subscription_status_details = "Completed" 
            GROUP BY subscription_offer_name;';
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

    

    
    
}

?>
