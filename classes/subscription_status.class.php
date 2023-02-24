<?php 
require_once 'database.php';
class subscription_status
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetchAll(){
        try{
            $sql = 'SELECT * FROM subscription_status;';
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