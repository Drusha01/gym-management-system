<?php 
require_once 'database.php';
class admins
{
    private $db;

    private $admin_id;
    private $admin_type_id;
    private $admin_user_id;
    private $admin_date_created;
    private $admin_date_updated;

    // constructor
    function __construct()
    {
        $this->db = new Database();
    }

    // login
    function login_admin($user_name,$user_email){
        try{
            $sql = 'SELECT admin_id,admin_user_id,user_password_hashed FROM admins
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            WHERE user_name = BINARY :user_name OR (user_email =  :user_email AND user_email_verified = 1) ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $user_email);
            $query->bindParam(':user_name', $user_name);
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

    function get_admin_details($admin_user_id){
        try{
            $sql = '
            SELECT * FROM admins
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
            WHERE admin_id = :admin_user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':admin_user_id', $admin_user_id);
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
    function check_admin($admin_user_id){
        try{
            $sql = '
            SELECT * FROM admins
            WHERE admin_type_id =(SELECT user_type_id FROM user_types WHERE user_type_details = "admin") AND admin_user_id = :admin_user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':admin_user_id', $admin_user_id);
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