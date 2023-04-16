<?php 
require_once 'database.php';
class attendances
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_current_attendance($attendance_user_id){
        try{
            $sql = 'SELECT attendance_id,TIME_FORMAT(attendance_time_in, "%h:%i %p") as attendance_time_in,CAST(attendance_time_in AS DATE) AS date_time_in,attendance_time_out  
            FROM attendances
            WHERE CAST(attendance_time_in AS DATE) = CURDATE() AND attendance_time_out is null AND attendance_user_id =:attendance_user_id
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_user_id', $attendance_user_id);
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

    function insert($attendance_user_id){
        try{
            $sql = 'INSERT attendances (attendance_user_id)VALUES (
                :attendance_user_id
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_user_id', $attendance_user_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function fetch_all_attendances(){
        try{
            $sql = 'SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, "%h:%i %p") as time_in, TIME_FORMAT(attendance_time_out, "%h:%i %p") as time_out,attendance_time_in ,attendance_time_out,  NOW() as date_now 
            FROM attendances
            LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
            ORDER BY attendance_time_in DESC
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

    function fetch_5_user_attendances($attendance_user_id){
        try{
            $sql = 'SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, "%h:%i %p") as time_in, TIME_FORMAT(attendance_time_out, "%h:%i %p") as time_out,attendance_time_in ,attendance_time_out, NOW() as date_now 
            FROM attendances
            LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
            WHERE attendance_user_id = :attendance_user_id 
            ORDER BY attendance_time_in DESC
            LIMIT 5
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_user_id', $attendance_user_id);
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

    function fetch_all_user_attendances($attendance_user_id){
        try{
            $sql = 'SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, "%h:%i %p") as time_in, TIME_FORMAT(attendance_time_out, "%h:%i %p") as time_out,attendance_time_in ,attendance_time_out, NOW() as date_now 
            FROM attendances
            LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
            WHERE attendance_user_id = :attendance_user_id 
            ORDER BY attendance_time_in DESC
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_user_id', $attendance_user_id);
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

    

    function update($attendance_id){
        try{
            $sql = ' UPDATE attendances
            SET attendance_time_out = NOW()
            WHERE attendance_id = :attendance_id;
            SELECT * FROM attendances;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_id', $attendance_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function force_time_out($attendance_id,$time_out_time){
        try{
            $sql = '  UPDATE attendances
            SET attendance_time_out = CONCAT(CAST(attendance_time_in AS DATE)," ",:time_out_time)
            WHERE attendance_id =:attendance_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_id', $attendance_id);
            $query->bindParam(':time_out_time', $time_out_time);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete($attendance_id){
        try{
            $sql = 'DELETE FROM attendances 
            WHERE attendance_id =:attendance_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':attendance_id', $attendance_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
}


?>