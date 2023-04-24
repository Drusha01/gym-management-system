<?php 
require_once 'database.php';
class payments
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($payment_amount,$payment_subscription_id,$payment_type_details){
        try{
            $sql = 'INSERT INTO payments (payment_id, payment_amount, payment_subscription_id, payment_type_id, payment_date) VALUES
            (
                null,
                :payment_amount,
                :payment_subscription_id,
                (SELECT payment_type_id FROM payment_types WHERE payment_type_details = :payment_type_details),
                NOW()
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':payment_amount', $payment_amount);
            $query->bindParam(':payment_subscription_id', $payment_subscription_id);
            $query->bindParam(':payment_type_details', $payment_type_details);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_all_paid(){
        try{
            $sql = 'SELECT distinct (user_id),CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name FROM payments
            LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
            LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
            LEFT OUTER JOIN users  ON users.user_id=subscriptions.subscription_subscriber_user_id
            ORDER BY payment_date DESC
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

    function fetch_all_paid_by_user($user_id){
        try{
            $sql = 'SELECT payment_id,type_of_subscription_details,payment_amount,payment_type_details,payment_date FROM payments
            LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
            LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE subscription_subscriber_user_id = :user_id
            ORDER BY payment_date DESC
            ;';
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



