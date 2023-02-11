<?php 
require_once 'database.php';
class offers
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function fetch(){
        try{
            $sql = 'SELECT offer_id,offer_name,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price FROM offers
            LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
            LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
            ; ';
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

