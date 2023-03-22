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
            WHERE (user_name = BINARY :user_name AND user_name_verified = 1) OR (user_email =  :user_email AND user_email_verified = 1) ; ';
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
            $sql = 'SELECT admin_id, user_id, user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
            user_phone_number, user_email, user_name, user_phone_verified,user_email_verified,user_name_verified,user_firstname, user_middlename, user_lastname, user_address,
            user_birthdate, user_valid_id_photo, user_profile_picture, user_date_created,  user_date_updated,
            offer_controls.control_details AS admin_offer_restriction_details,
            avail_controls.control_details AS admin_avail_restriction_details,
            account_controls.control_details AS admin_account_restriction_details,
            payment_controls.control_details AS admin_payment_restriction_details,
            maintenance_controls.control_details AS admin_maintenance_restriction_details,
            report_controls.control_details AS admin_report_restriction_details
            FROM admins
           LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
           LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
           LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
           LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
           LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
           LEFT OUTER JOIN offer_controls ON admins.admin_offer_restriction=offer_controls.control_id
           LEFT OUTER JOIN avail_controls ON admins.admin_avail_restriction=avail_controls.control_id
           LEFT OUTER JOIN account_controls ON admins.admin_account_restriction=account_controls.control_id
           LEFT OUTER JOIN payment_controls ON admins.admin_payment_restriction=payment_controls.control_id
           LEFT OUTER JOIN maintenance_controls ON admins.admin_maintenance_restriction=maintenance_controls.control_id
           LEFT OUTER JOIN report_controls ON admins.admin_report_restriction=report_controls.control_id
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

    function fetchAll_exceptMe($admin_user_id){
        try{
            $sql = 'SELECT admin_id, user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
            user_phone_number, user_email, user_name, user_firstname, user_middlename, user_lastname, user_address,
            user_birthdate, user_valid_id_photo, user_profile_picture, user_date_created,  user_date_updated,CAST(admin_date_created AS DATE) admin_date_created,
            offer_controls.control_details AS admin_offer_restriction_details,
            avail_controls.control_details AS admin_avail_restriction_details,
            account_controls.control_details AS admin_account_restriction_details,
            payment_controls.control_details AS admin_payment_restriction_details,
            maintenance_controls.control_details AS admin_maintenance_restriction_details,
            report_controls.control_details AS admin_report_restriction_details
            FROM admins
           LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
           LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
           LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
           LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
           LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
           LEFT OUTER JOIN offer_controls ON admins.admin_offer_restriction=offer_controls.control_id
           LEFT OUTER JOIN avail_controls ON admins.admin_avail_restriction=avail_controls.control_id
           LEFT OUTER JOIN account_controls ON admins.admin_account_restriction=account_controls.control_id
           LEFT OUTER JOIN payment_controls ON admins.admin_payment_restriction=payment_controls.control_id
           LEFT OUTER JOIN maintenance_controls ON admins.admin_maintenance_restriction=maintenance_controls.control_id
           LEFT OUTER JOIN report_controls ON admins.admin_report_restriction=report_controls.control_id
           WHERE admin_id != :admin_user_id
           ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':admin_user_id', $admin_user_id);
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

    function update($admin_id,$admin_offer_restriction_details,$admin_avail_restriction_details,$admin_account_restriction_details,$admin_payment_restriction_details,$admin_maintenance_restriction_details,$admin_report_restriction_details){
        try{
            $sql = 'UPDATE admins 
            SET
            admin_offer_restriction = (SELECT control_id FROM offer_controls WHERE control_details = :admin_offer_restriction_details),
            admin_avail_restriction= (SELECT control_id FROM avail_controls WHERE control_details = :admin_avail_restriction_details),
            admin_account_restriction= (SELECT control_id FROM account_controls WHERE control_details = :admin_account_restriction_details),
            admin_payment_restriction= (SELECT control_id FROM payment_controls WHERE control_details = :admin_payment_restriction_details),
            admin_maintenance_restriction = (SELECT control_id FROM maintenance_controls WHERE control_details = :admin_maintenance_restriction_details),
            admin_report_restriction= (SELECT control_id FROM report_controls WHERE control_details = :admin_report_restriction_details)
            WHERE admin_id = :admin_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':admin_id', $admin_id);
            $query->bindParam(':admin_offer_restriction_details', $admin_offer_restriction_details);
            $query->bindParam(':admin_avail_restriction_details', $admin_avail_restriction_details);
            $query->bindParam(':admin_account_restriction_details', $admin_account_restriction_details);
            $query->bindParam(':admin_payment_restriction_details', $admin_payment_restriction_details);
            $query->bindParam(':admin_maintenance_restriction_details', $admin_maintenance_restriction_details);
            $query->bindParam(':admin_report_restriction_details', $admin_report_restriction_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function add($user_id,$admin_offer_restriction_details,$admin_avail_restriction_details,$admin_account_restriction_details,$admin_payment_restriction_details,$admin_maintenance_restriction_details,$admin_report_restriction_details){
        try{
            $sql = 'INSERT INTO admins VALUES(
                null,
                (SELECT user_type_id FROM user_types WHERE user_type_details = "sub-admin"),
                :user_id ,
                (SELECT control_id FROM offer_controls WHERE control_details = :admin_offer_restriction_details),
                (SELECT control_id FROM avail_controls WHERE control_details = :admin_avail_restriction_details),
                (SELECT control_id FROM account_controls WHERE control_details = :admin_account_restriction_details),
                (SELECT control_id FROM payment_controls WHERE control_details = :admin_payment_restriction_details),
                (SELECT control_id FROM maintenance_controls WHERE control_details = :admin_maintenance_restriction_details),
                (SELECT control_id FROM report_controls WHERE control_details = :admin_report_restriction_details),
                now(),
                now()
            );';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':admin_offer_restriction_details', $admin_offer_restriction_details);
            $query->bindParam(':admin_avail_restriction_details', $admin_avail_restriction_details);
            $query->bindParam(':admin_account_restriction_details', $admin_account_restriction_details);
            $query->bindParam(':admin_payment_restriction_details', $admin_payment_restriction_details);
            $query->bindParam(':admin_maintenance_restriction_details', $admin_maintenance_restriction_details);
            $query->bindParam(':admin_report_restriction_details', $admin_report_restriction_details);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function delete($admin_id){
        try{
            $sql = 'DELETE FROM admins
            WHERE admin_id =:admin_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':admin_id', $admin_id);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
    function get_admin_password($admin_user_id){
        try{
            $sql = 'SELECT admin_id, user_password_hashed
            FROM admins
            LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
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


}

?>