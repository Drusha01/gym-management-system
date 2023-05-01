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
            $sql = 'SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details FROM trainers
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
    function fetch_available_trainers(){
        try{
            $sql = 'SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details FROM trainers
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            WHERE trainer_availability_details = "Available"
            ORDER BY user_fullname';
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
            $sql = 'SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details,user_address,
            user_phone_number,user_email,user_profile_picture,user_valid_id_photo,user_date_created FROM trainers
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            WHERE trainer_id = :trainer_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':trainer_id', $trainer_id);
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

    function fetch_non_trainers(){
        try{
            $sql = 'SELECT user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_birthdate,user_gender_details  from users
            LEFT JOIN trainers ON users.user_id=trainers.trainer_user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            where trainers.trainer_user_id is null
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

    function add_trainer_with_id($trainer_user_id){
        try{
            $sql = 'INSERT INTO trainers (trainer_id,trainer_user_id,trainer_availability_id,trainer_status_id,trainer_date_created,trainer_date_updated) VALUES
            (
                null,
                :trainer_user_id,
                (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = "Available"),
                (SELECT status_id FROM statuses WHERE status_details= "active"),
                now(),
                now()
                
            )';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':trainer_user_id', $trainer_user_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update_trainer_availability($trainer_id,$trainer_availability_details){
        try{
            $sql = 'UPDATE trainers 
            SET trainer_availability_id = (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = :trainer_availability_details)
            WHERE trainer_id = :trainer_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':trainer_id', $trainer_id);
            $query->bindParam(':trainer_availability_details', $trainer_availability_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_my_details($user_id){
        try{
            $sql = 'SELECT * FROM trainers
            LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
            WHERE user_id=:user_id
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
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