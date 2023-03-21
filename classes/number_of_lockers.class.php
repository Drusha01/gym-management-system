<?php 
require_once 'database.php';
class number_of_lockers
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_number_of_lockers(){
        try{
            $sql = 'SELECT locker_id,locker_number FROM number_of_lockers
            WHERE locker_id =1;';
            $query=$this->db->connect()->prepare($sql);
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

    function update_number_of_lockers($locker_number){
        try{
            $sql = 'UPDATE number_of_lockers
            SET locker_number = :locker_number
            WHERE locker_id =1;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':locker_number', $locker_number);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
   
}


?>