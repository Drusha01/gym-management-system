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
            $sql = 'SELECT equipment_condition_details,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_id=users.user_id
            WHERE remark_equipment_id = :remark_equipment_id
            ORDER BY remark_time ASC
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
            $sql = 'SELECT equipment_condition_details,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
            LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
            LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
            LEFT OUTER JOIN users ON admins.admin_id=users.user_id
            WHERE remark_equipment_id = :remark_equipment_id
            ORDER BY remark_time ASC
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