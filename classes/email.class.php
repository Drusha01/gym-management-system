<?php 
require_once 'database.php';
class email
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($user_id,$user_email,$code){
        try{
            $sql = 'INSERT INTO email_verify (email_verify_user_id,email_verify_email,email_verify_code) VALUES
            (
                :user_id,
                :user_email,
                :code
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_email', $user_email);
            $query->bindParam(':code', $code);
            $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function get_user_id($code){
        try{
            $sql = 'INSERT INTO email_verify (email_verify_user_id,email_verify_email,email_verify_code) VALUES
            (
                :user_id,
                :email,
                :code
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':email', $email);
            $query->bindParam(':code', $code);
            $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
 
}


?>