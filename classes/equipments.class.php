<?php 
require_once 'database.php';
class equipments
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }
    function insert($equipment_name,$equipment_type_details){
        try{
            $sql = 'INSERT INTO equipments (equipment_id, equipment_name, equipment_type_id,equipment_status_id) VALUES
            (
                null,
                :equipment_name,
                (SELECT equipment_type_id FROM equipment_types WHERE equipment_type_details = :equipment_type_details),
                (SELECT status_id FROM statuses WHERE status_details = "Active")
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_name', $equipment_name);
            $query->bindParam(':equipment_type_details', $equipment_type_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete($equipment_id){
        try{
            $sql = 'UPDATE equipments
            SET equipment_status_id = (SELECT status_id FROM statuses WHERE status_details = "deleted")
            WHERE equipment_id =:equipment_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_id', $equipment_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function fetch_all(){
        try{
            $sql = 'SELECT equipment_id,equipment_name,equipment_type_details,status_details FROM equipments
            LEFT OUTER JOIN equipment_types ON equipments.equipment_type_id=equipment_types.equipment_type_id
            LEFT OUTER JOIN statuses ON equipments.equipment_status_id=statuses.status_id
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
    function fetch_with_id($equipment_id){
        try{
            $sql = 'SELECT equipment_id,equipment_name,equipment_type_details,status_details FROM equipments
            LEFT OUTER JOIN equipment_types ON equipments.equipment_type_id=equipment_types.equipment_type_id
            LEFT OUTER JOIN statuses ON equipments.equipment_status_id=statuses.status_id
            WHERE equipment_id =:equipment_id
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

    function update($equipment_id,$equipment_name,$equipment_type_details){
        try{
            $sql = 'UPDATE equipments
            SET equipment_name =:equipment_name ,
            equipment_type_id = (SELECT equipment_type_id FROM equipment_types WHERE equipment_type_details =:equipment_type_details)
            WHERE equipment_id =:equipment_id ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_id', $equipment_id);
            $query->bindParam(':equipment_name', $equipment_name);
            $query->bindParam(':equipment_type_details', $equipment_type_details);
            return$query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
}


?>