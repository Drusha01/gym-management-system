<?php 
require_once 'database.php';
class admin_settings
{
    private $db;

    
    function __construct()
    {
        $this->db = new Database();
    }

    function fetch_one(){
        try{
            $sql = 'SELECT * FROM admin_settings
            WHERE setting_id =1;';
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

    function update_setting_attendance_force_timeout($setting_attendance_force_timeout){
        try{
            $sql = 'UPDATE admin_settings
            set setting_attendance_force_timeout = :setting_attendance_force_timeout
            WHERE setting_id = 1;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':setting_attendance_force_timeout', $setting_attendance_force_timeout);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function update_setting_num_of_dates_to_notify($setting_num_of_dates_to_notify){
        try{
            $sql = 'UPDATE admin_settings
            set setting_num_of_dates_to_notify = :setting_num_of_dates_to_notify
            WHERE setting_id = 1;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':setting_num_of_dates_to_notify', $setting_num_of_dates_to_notify);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    function update_setting_percentage_of_payment_per_day($setting_percentage_of_payment_per_day){
        try{
            $sql = 'UPDATE admin_settings
            set setting_percentage_of_payment_per_day = :setting_percentage_of_payment_per_day
            WHERE setting_id = 1;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':setting_percentage_of_payment_per_day', $setting_percentage_of_payment_per_day);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }

    function update_contacts($setting_gym_address,$setting_gym_contact_number,$setting_gym_email_address){
        try{
            $sql = 'UPDATE admin_settings
            set setting_gym_address = :setting_gym_address,
            setting_gym_contact_number = :setting_gym_contact_number,
            setting_gym_email_address = :setting_gym_email_address

            WHERE setting_id = 1;
            ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':setting_gym_address', $setting_gym_address);
            $query->bindParam(':setting_gym_contact_number', $setting_gym_contact_number);
            $query->bindParam(':setting_gym_email_address', $setting_gym_email_address);
            return $query->execute();
        }catch (PDOException $e){
            return false;
        }
    }
    
}


?>