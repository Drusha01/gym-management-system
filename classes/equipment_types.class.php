<?php 
require_once 'database.php';
class equipment_types
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_all(){
        try{
            $sql = 'SELECT * FROM equipment_types;';
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
    function insert($equipment_type_details){
        try{
            $sql = 'INSERT INTO equipment_types VALUES
            (
                null,
                :equipment_type_details
            )';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_type_details', $equipment_type_details);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
}


?>