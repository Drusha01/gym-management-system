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
            $sql = 'SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price FROM offers
            LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
            LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
            LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
            WHERE status_details ="active"
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

    function fetch_offer($offer_id){
        try{
            $sql = 'SELECT offer_id,offer_name,status_details,type_of_subscription_id,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price,offer_description,offer_file FROM offers
            LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
            LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
            LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
            WHERE offer_id = :offer_id AND status_details = "active"
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':offer_id', $offer_id);
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

    function delete_offer($offer_id){
        try{
            $sql = 'UPDATE offers
            SET offer_status_id = (SELECT status_id FROM statuses WHERE status_details= "deleted")
            WHERE offer_id = :offer_id
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':offer_id', $offer_id);
            if($data = $query->execute()){
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function add($offer_name,$status_details,$type_of_subscription_details,$age_qualification_details,$offer_duration,$offer_slots,$offer_price,$offer_description,$offer_file){
        try{
            $sql = '
            INSERT INTO offers  (offer_id, offer_name, offer_status_id, offer_type_of_subscription_id, offer_age_qualification_id, offer_duration, offer_slots, offer_price,offer_description,offer_file) VALUES
            (
                null,
                :offer_name,
                (SELECT status_id FROM statuses WHERE status_details= :status_details),
                (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= :type_of_subscription_details),
                (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= :age_qualification_details),
                :offer_duration,
                :offer_slots,
                :offer_price,
                :offer_description,
                :offer_file
            ); ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':offer_name', $offer_name);
            $query->bindParam(':status_details', $status_details);
            $query->bindParam(':type_of_subscription_details', $type_of_subscription_details);
            $query->bindParam(':age_qualification_details', $age_qualification_details);
            $query->bindParam(':offer_duration', $offer_duration);

            $query->bindParam(':offer_slots', $offer_slots);
            $query->bindParam(':offer_price', $offer_price);
            $query->bindParam(':offer_description', $offer_description);
            $query->bindParam(':offer_file', $offer_file);

            if($data = $query->execute()){
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function update($offer_name,$status_details,$type_of_subscription_details,$age_qualification_details,$offer_duration,$offer_slots,$offer_price,$offer_description,$offer_file,$offer_id){
        try{
            $sql = '
            UPDATE offers
            SET 
            offer_name = :offer_name ,
            offer_type_of_subscription_id = (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= :type_of_subscription_details),
            offer_age_qualification_id  = (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= :age_qualification_details),
            offer_duration = :offer_duration,
            offer_slots = :offer_slots,
            offer_price = :offer_price,
            offer_description = :offer_description,
            offer_file = :offer_file,
            WHERE offer_id = :offer_id
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':offer_name', $offer_name);
            $query->bindParam(':type_of_subscription_details', $type_of_subscription_details);
            $query->bindParam(':age_qualification_details', $age_qualification_details);
            $query->bindParam(':offer_duration', $offer_duration);
            $query->bindParam(':offer_slots', $offer_slots);

            $query->bindParam(':offer_price', $offer_price);
            $query->bindParam(':offer_description', $offer_description);
            $query->bindParam(':offer_file', $offer_file);
            $query->bindParam(':offer_id', $offer_id);

            if($data = $query->execute()){
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }
    function select_offers_per_sub_type($type_of_subscription_details){
        try{
            $sql = '
            SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price,offer_description FROM offers
            LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
            LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
            LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
            WHERE offer_type_of_subscription_id = (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= :type_of_subscription_details)
            ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':type_of_subscription_details', $type_of_subscription_details);

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

