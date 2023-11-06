<?php 
require_once 'database.php';
class landing_page
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($landing_page_title,$landing_page_file,$landing_page_type_details){
        try{
            $sql = 'INSERT INTO landing_page  (landing_page_id,landing_page_title,landing_page_file,landing_page_type_id) VALUES
            (
                null,
                :landing_page_title,
                :landing_page_file,
                (SELECT landing_page_type_id FROM landing_page_types WHERE landing_page_type_details = :landing_page_type_details )
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_title', $landing_page_title);
            $query->bindParam(':landing_page_file', $landing_page_file);
            $query->bindParam(':landing_page_type_details', $landing_page_type_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_all_by_type($landing_page_type_details){
        try{
            $sql = 'SELECT * FROM landing_page
            LEFT OUTER JOIN landing_page_types ON landing_page.landing_page_type_id=landing_page_types.landing_page_type_id
            WHERE landing_page_type_details = :landing_page_type_details
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_type_details', $landing_page_type_details);
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

    function fetch_id($landing_page_file){
        try{
            $sql = 'SELECT * FROM landing_page
            LEFT OUTER JOIN landing_page_types ON landing_page.landing_page_type_id=landing_page_types.landing_page_type_id
            WHERE landing_page_file = :landing_page_file
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_file', $landing_page_file);
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
    function fetch_details($landing_page_id){
        try{
            $sql = 'SELECT * FROM landing_page
            LEFT OUTER JOIN landing_page_types ON landing_page.landing_page_type_id=landing_page_types.landing_page_type_id
            WHERE landing_page_id = :landing_page_id
            ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_id', $landing_page_id);
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
    function delete($landing_page_id){
        try{
            $sql = 'DELETE FROM landing_page WHERE landing_page_id = :landing_page_id ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_id', $landing_page_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update($landing_page_title,$landing_page_file,$landing_page_id){
        try{
            $sql = 'UPDATE landing_page
            SET landing_page_title = :landing_page_title ,
            landing_page_file = :landing_page_file
            WHERE landing_page_id = :landing_page_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':landing_page_title', $landing_page_title);
            $query->bindParam(':landing_page_file', $landing_page_file);
            $query->bindParam(':landing_page_id', $landing_page_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

}


?>