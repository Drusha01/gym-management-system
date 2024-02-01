<?php 
require_once 'database.php';
class remarks
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_all($remark_equipment_id){
        try{
            $sql = 'SELECT remark_id, equipment_condition_details,remark_remark, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time,remark_file FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            WHERE remark_equipment_id = :remark_equipment_id
            ORDER BY remark_time DESC
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_equipment_id', $remark_equipment_id);
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
    function fetch_one($remark_equipment_id){
        try{
            $sql = 'SELECT remark_id, equipment_condition_details,remark_remark, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time,remark_file FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            WHERE remark_equipment_id = :remark_equipment_id
            ORDER BY remark_time DESC
            LIMIT 1
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_equipment_id', $remark_equipment_id);
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
    function insert($remark_equipment_id, $equipment_condition_details, $remark_admin_id, $remark_remark, $remark_file){
        try{
            $sql = 'INSERT INTO remarks (remark_id, remark_equipment_id, remark_equipment_condition_id, remark_admin_id, remark_time, remark_remark, remark_file) VALUES
            (
                null,
                :remark_equipment_id,
                (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = :equipment_condition_details),
                :remark_admin_id,
                now(),
                :remark_remark,
                :remark_file
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_equipment_id', $remark_equipment_id);
            $query->bindParam(':equipment_condition_details', $equipment_condition_details);
            $query->bindParam(':remark_admin_id', $remark_admin_id);
            $query->bindParam(':remark_remark', $remark_remark);
            $query->bindParam(':remark_file', $remark_file);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_remark_details($remark_id){
        try{
            $sql = 'SELECT remark_id,equipment_name,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time,remark_file FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN equipments ON remarks.remark_equipment_id=equipments.equipment_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            WHERE remark_id =:remark_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_id', $remark_id);
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

    function fetch_remark_details_with_equipment_id($equipment_id){
        try{
            $sql = 'SELECT remark_id,equipment_name,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time ,remark_file FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN equipments ON remarks.remark_equipment_id=equipments.equipment_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            WHERE equipment_id = :equipment_id
            LIMIT 1
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_id', $equipment_id);
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


    

    function delete($remark_id){
        try{
            $sql = 'DELETE FROM remarks WHERE remark_id =:remark_id';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_id', $remark_id);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update($remark_id, $equipment_condition_details, $remark_admin_id, $remark_remark, $remark_file){
        try{
            $sql = 'UPDATE remarks
            SET remark_remark =:remark_remark,
            remark_equipment_condition_id = (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = :equipment_condition_details),
            remark_admin_id =:remark_admin_id,
            remark_remark =:remark_remark,
            remark_file =:remark_file
            WHERE remark_id =:remark_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':remark_id', $remark_id);
            $query->bindParam(':equipment_condition_details', $equipment_condition_details);
            $query->bindParam(':remark_admin_id', $remark_admin_id);
            $query->bindParam(':remark_remark', $remark_remark);
            $query->bindParam(':remark_file', $remark_file);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
}


?>