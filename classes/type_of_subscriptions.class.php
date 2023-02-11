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
}

?>
