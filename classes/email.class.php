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
                :user_id ,
                :user_email ,
                :code
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_email', $user_email);
            $query->bindParam(':code', $code);
            return $query->execute();

        }catch (PDOException $e){
            return false;
        }
    }

    function get_last_sent_email($user_id){
        try{
            $sql = 'SELECT  email_verify_user_id,email_verify_email,UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) as seconds,email_verify_code FROM email_verify
            WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) ) <=60 AND email_verify_user_id =:user_id ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':email', $email);
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

    function verify($user_id){
        try{
            $sql = 'SELECT  email_verify_user_id,email_verify_email,UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) as seconds,email_verify_code FROM email_verify
            WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) ) <=60 AND email_verify_user_id = :user_id ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
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