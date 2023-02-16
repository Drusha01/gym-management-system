<?php 
require_once 'database.php';
class trainers
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_tainers(){
        try{
            $sql = 'SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,",",user_firstname," ",user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details FROM trainers
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            ORDER BY user_fullname
            ;';
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

    function fetch_trainer_with_id($trainer_id){
        try{
            $sql = 'SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,",",user_firstname," ",user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details,user_address,
            user_phone_number,user_email,user_date_created FROM trainers
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            WHERE trainer_id = :trainer_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':trainer_id', $trainer_id);
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