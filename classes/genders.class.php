<?php 
require_once 'database.php';
class genders
{
    private $db;
    private $user_gender_id;
    private $user_gender_details;

    function setuser_gender_id($user_gender_id){$this->user_gender_id = $user_gender_id;}
    function setuser_gender_details($user_gender_details){$this->user_gender_details = $user_gender_details;}
    function getuser_gender_id(){return $this->user_gender_id;}
    function getuser_gender_details(){return $this->user_gender_details;}
    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_gender_list(){
        try{
            $sql = 'SELECT * FROM user_genders
            LIMIT 20;';
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
    function insert_new_gender($new_gender){
        try{
            $sql = 'INSERT INTO user_genders VALUES(
                null,
                :new_gender
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':new_gender', $new_gender);
            return $query->execute();
               
           
        }catch (PDOException $e){
            return false;
        }
    }
}


?>