<?php 
require_once 'database.php';
class walk_in_prices
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_walk_in_price($walk_in_service_details){
        try{
            $sql = 'SELECT walk_in_price_id, walk_in_service_details, walk_in_service_price FROM walk_in_prices 
            LEFT OUTER JOIN walk_in_services ON walk_in_prices.walk_in_service_id=walk_in_services.walk_in_service_id
            WHERE walk_in_service_details = :walk_in_service_details;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_service_details', $walk_in_service_details);
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

    function update($walk_in_service_details,$walk_in_service_price){
        try{
            $sql = 'UPDATE walk_in_prices
            SET walk_in_service_price = :walk_in_service_price
            WHERE walk_in_service_id = (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = :walk_in_service_details);';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':walk_in_service_details', $walk_in_service_details);
            $query->bindParam(':walk_in_service_price', $walk_in_service_price);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
}


?>