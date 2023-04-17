<?php 
require_once 'database.php';
class forgot_password
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function insert($forgot_password_user_id,$forgot_password_hashed){
        try{
            $sql = 'INSERT INTO forgot_password(forgot_password_user_id,forgot_password_hashed) VALUES
            (
                :forgot_password_user_id,
                :forgot_password_hashed
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':forgot_password_user_id', $forgot_password_user_id);
            $query->bindParam(':forgot_password_hashed', $forgot_password_hashed);
            return $query->execute();

        }catch (PDOException $e){
            return false;
        }
    }

    function get_last_sent_email($user_id){
        try{
            $sql = 'SELECT  forgot_password_id,forgot_password_user_id,UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(forgot_password_date_time) as seconds,forgot_password_hashed FROM forgot_password
            WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(forgot_password_date_time) ) <=60*15 AND forgot_password_user_id= :user_id 
            ORDER BY forgot_password_date_time DESC
            LIMIT 1;';
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