<?php 
require_once 'database.php';
class equipments
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetchAll(){
        try{
            $sql = 'SELECT equipment_id,equipment_name,equipment_quantity,equipment_condition_details FROM equipments
            LEFT OUTER JOIN equipments_conditions ON equipments.equipment_condition_id=equipments_conditions.equipment_condition_id
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
            $sql = 'SELECT equipment_id,equipment_name,equipment_quantity,equipment_condition_details FROM equipments
            LEFT OUTER JOIN equipments_conditions ON equipments.equipment_condition_id=equipments_conditions.equipment_condition_id
            WHERE equipment_id = :equipment_id
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
    
    function update($equipment_name,$equipment_quantity,$equipment_condition_details,$equipment_id){
        try{
            $sql = 'UPDATE equipments 
            SET equipment_name= :equipment_name,
            equipment_quantity = :equipment_quantity,
            equipment_condition_id = (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = :equipment_condition_details)
            WHERE equipment_id = :equipment_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_name', $equipment_name);
            $query->bindParam(':equipment_quantity', $equipment_quantity);
            $query->bindParam(':equipment_condition_details', $equipment_condition_details);
            $query->bindParam(':equipment_id', $equipment_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function add($equipment_name,$equipment_quantity,$equipment_condition_details){
        try{
            $sql = 'INSERT INTO equipments (equipment_id,equipment_name,equipment_quantity,equipment_condition_id) VALUES
            (
                null,
                :equipment_name,
                :equipment_quantity,
                (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = :equipment_condition_details)
            )';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_name', $equipment_name);
            $query->bindParam(':equipment_quantity', $equipment_quantity);
            $query->bindParam(':equipment_condition_details', $equipment_condition_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete($equipment_id){
        try{
            $sql = 'DELETE FROM equipments 
            WHERE equipment_id = :equipment_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':equipment_id', $equipment_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
}


?>