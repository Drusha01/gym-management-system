<?php 
require_once 'database.php';
class teams
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($team_position_details,$team_name,$team_file){
        try{
            $sql = 'INSERT INTO teams  (team_position_id,team_name,team_file) VALUES
            (
                (SELECT team_position_id FROM team_positions WHERE team_position_details = :team_position_details),
                :team_name,
                :team_file
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':team_position_details', $team_position_details);
            $query->bindParam(':team_name', $team_name);
            $query->bindParam(':team_file', $team_file);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_with_file($team_file){
        try{
            $sql = 'SELECT * FROM teams 
            LEFT OUTER JOIN team_positions ON teams.team_position_id=team_positions.team_position_id
            WHERE team_file =:team_file ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':team_file', $team_file);
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
    function fetch_all(){
        try{
            $sql = 'SELECT * FROM teams
            LEFT OUTER JOIN team_positions ON teams.team_position_id=team_positions.team_position_id;';
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
}


?>