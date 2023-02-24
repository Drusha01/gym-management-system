<?php 
require_once 'database.php';
class type_of_subscriptions
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function fetch(){
        try{
            $sql = 'SELECT * from type_of_subscriptions';
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

    function fetch_id($type_of_subscription_details){
        try{
            $sql = ' SELECT * FROM type_of_subscriptions
            WHERE type_of_subscription_details = :type_of_subscription_details;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':type_of_subscription_details', $type_of_subscription_details);
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

   
}

?>
