<?php 
require_once 'database.php';
class team_positions
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($team_position_details){
        try{
            $sql = 'INSERT INTO team_positions(team_position_details) VALUES
            (
                :team_position_details
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':team_position_details', $team_position_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
}


?>