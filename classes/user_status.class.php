<?php 
require_once 'database.php';
class user_status
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
    // function insert_new_gender($new_gender){
    //     try{
    //         $sql = 'INSERT INTO user_genders VALUES(
    //             null,
    //             :new_gender
    //         );';
    //         $query=$this->db->connect()->prepare($sql);
    //         $query->bindParam(':new_gender', $new_gender);
    //         return $query->execute();
               
           
    //     }catch (PDOException $e){
    //         return false;
    //     }
    // }
}


?>