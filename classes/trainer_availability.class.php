<?php 
require_once 'database.php';
class trainer_availability
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_trainer_availability(){
        try{
            $sql = 'SELECT * FROM trainer_availability;';
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