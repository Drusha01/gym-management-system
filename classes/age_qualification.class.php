<?php 
require_once 'database.php';
class age_qualifications
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function fetch(){
        try{
            $sql = 'SELECT * FROM age_qualifications;';
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

    function insert($age_qualification_details){
        try{
            $sql = ' INSERT INTO age_qualifications VALUES
            (
                null,
                :age_qualification_details
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':age_qualification_details', $age_qualification_details);
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

   
}

?>
