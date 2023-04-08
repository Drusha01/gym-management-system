<?php 
require_once 'database.php';
class annoucements
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function get_number_of_annoucements(){
        try{
            $sql = 'SELECT count(*)AS number_of_announcements FROM announcements;';
            $query=$this->db->connect()->prepare($sql);
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

    function insert($announcement_status_details, $announcement_type_details,$annoucement_title,$annoucement_content,$announcement_file_image,$announcement_order,$announcement_start_date,$announcement_end_date){
        try{
            $sql = 'INSERT into announcements (announcement_id, announcement_status_id, announcement_type_id, announcement_title, announcement_content, announcement_file_image, announcement_order, announcement_start_date, announcement_end_date) VALUES
            (
                null,
                (SELECT announcement_status_id FROM announcement_statuses WHERE announcement_status_details = :announcement_status_details ),
                (SELECT announcement_type_id FROM announcement_types WHERE announcement_type_details = :announcement_type_details ),
                :annoucement_title,
                :annoucement_content,
                :announcement_file_image,
                :announcement_order,
                :announcement_start_date,
                :announcement_end_date
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_status_details', $announcement_status_details);
            $query->bindParam(':announcement_type_details', $announcement_type_details);
            $query->bindParam(':annoucement_title', $annoucement_title);
            $query->bindParam(':annoucement_content', $annoucement_content);
            $query->bindParam(':announcement_file_image', $announcement_file_image);
            $query->bindParam(':announcement_order', $announcement_order);
            $query->bindParam(':announcement_start_date', $announcement_start_date);
            $query->bindParam(':announcement_end_date', $announcement_end_date);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_all(){
        try{
            $sql = 'SELECT announcement_id, announcement_status_details, announcement_type_details, announcement_title, announcement_content, announcement_file_image, announcement_order, announcement_start_date, announcement_end_date,
            announcement_date_created, announcement_date_updated
            FROM announcements
            LEFT OUTER JOIN announcement_statuses ON announcements.announcement_status_id=announcement_statuses.announcement_status_id
            LEFT OUTER JOIN announcement_types ON announcements.announcement_type_id=announcement_types.announcement_type_id
            ORDER BY announcement_order DESC;';
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
    function fetch_details($announcement_id){
        try{
            $sql = 'SELECT announcement_id, announcement_status_details, announcement_type_details, announcement_title, announcement_content, announcement_file_image, announcement_order, DATE(announcement_start_date) as announcement_start_date, DATE(announcement_end_date) as announcement_end_date,
            announcement_date_created, announcement_date_updated
            FROM announcements
            LEFT OUTER JOIN announcement_statuses ON announcements.announcement_status_id=announcement_statuses.announcement_status_id
            LEFT OUTER JOIN announcement_types ON announcements.announcement_type_id=announcement_types.announcement_type_id
            WHERE announcement_id = :announcement_id ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_id', $announcement_id);
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

    function delete_with_id($announcement_id){
        try{
            $sql = 'DELETE FROM announcements
            WHERE announcement_id = :announcement_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_id', $announcement_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function update_announcement_order($announcement_id,$announcement_order){
        try{
            $sql = 'UPDATE announcements
            SET announcement_order = :announcement_order
            WHERE announcement_id = :announcement_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_id', $announcement_id);
            $query->bindParam(':announcement_order', $announcement_order);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update($announcement_id,$announcement_status_details,$announcement_type_details,$announcement_title,$announcement_content,$announcement_file_image,$announcement_start_date,$announcement_end_date){
        try{
            $sql = 'UPDATE announcements
            SET announcement_status_id = (SELECT announcement_status_id FROM announcement_statuses WHERE announcement_status_details = :announcement_status_details),
            announcement_type_id = (SELECT announcement_type_id FROM announcement_types WHERE announcement_type_details = :announcement_type_details),
            announcement_title = :announcement_title,
            announcement_content=:announcement_content,
            announcement_file_image=:announcement_file_image,
            announcement_start_date =:announcement_start_date,
            announcement_end_date=:announcement_end_date
            WHERE announcement_id =:announcement_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_status_details', $announcement_status_details);
            $query->bindParam(':announcement_type_details', $announcement_type_details);
            $query->bindParam(':announcement_title', $announcement_title);
            $query->bindParam(':announcement_content', $announcement_content);
            $query->bindParam(':announcement_file_image', $announcement_file_image);
            $query->bindParam(':announcement_start_date', $announcement_start_date);
            $query->bindParam(':announcement_end_date', $announcement_end_date);
            $query->bindParam(':announcement_id', $announcement_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_down($announcement_order){
        try{
            $sql = 'SELECT announcement_id, announcement_order 
            FROM announcements
            WHERE announcement_order <= :announcement_order
            ORDER BY announcement_order DESC
            LIMIT 2;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_order', $announcement_order);
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
    function fetch_up($announcement_order){
        try{
            $sql = 'SELECT announcement_id, announcement_order 
            FROM announcements
            WHERE announcement_order >= :announcement_order
            ORDER BY announcement_order ASC
            LIMIT 2;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':announcement_order', $announcement_order);
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