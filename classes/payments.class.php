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
    
}


?>



