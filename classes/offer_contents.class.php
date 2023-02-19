<?php 
require_once 'database.php';
class offer_contents
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_user_status(){
        try{
            $sql = 'SELECT * FROM user_status
            ORDER BY user_status_details 
            LIMIT 50;';
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