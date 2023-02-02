<?php 
require_once 'database.php';
Class users{

    // attributes
    private $db;
    private $user_id;
    private $user_status_id;
    private $user_type_id;
    private $user_gender_id;
    private $user_phone_country_code_id;
    private $user_phone_number;
    private $user_email;
    private $user_name;
    private $user_password_hashed;
    private $user_firstname;
    private $user_lastname;
    private $user_user_address;
    private $user_birthdate;
    private $user_valid_id_photo;
    private $user_profile_picture;
    private $user_date_created;
    private $user_date_updated;


    // FK 
    private $user_status_details;
    private $user_type_details;
    private $user_gender_details;
    private $user_phone_contry_code_details;


    // constructor
    function __construct()
    {
        $this->db = new Database();
    }

    // setter and getter
    function setuser_id($user_id){$this->user_id = $user_id;}
    function setuser_status_id($user_status_id){$this->user_status_id = $user_status_id;}
    function setuser_type_id($user_type_id){$this->user_type_id = $user_type_id;}
    function setuser_gender_id($user_gender_id){$this->user_gender_id = $user_gender_id;}
    function setuser_phone_country_code_id($user_phone_country_code_id){$this->user_phone_country_code_id = $user_phone_country_code_id;}
    function setuser_phone_number($user_phone_number){$this->user_phone_number = $user_phone_number;}
    function setuser_email($user_email){$this->user_email = $user_email;}
    function setuser_name($user_name){$this->user_name = $user_name;}
    function setuser_password_hashed($user_password_hashed){$this->user_password_hashed = $user_password_hashed;}
    function setuser_firstname($user_firstname){$this->user_firstname = $user_firstname;}
    function setuser_lastname($user_lastname){$this->user_lastname = $user_lastname;}
    function setuser_user_address($user_user_address){$this->user_user_address = $user_user_address;}
    function setuser_birthdate($user_birthdate){$this->user_birthdate = $user_birthdate;}
    function setuser_valid_id_photo($user_valid_id_photo){$this->user_valid_id_photo = $user_valid_id_photo;}
    function setuser_profile_picture($user_profile_picture){$this->user_profile_picture = $user_profile_picture;}
    function setuser_date_created($user_date_created){$this->user_date_created = $user_date_created;}
    function setuser_date_updated($user_date_updated){$this->user_date_updated = $user_date_updated;}

    function setuser_status_details($user_status_details){$this->user_status_details = $user_status_details;}
    function setuser_type_details($user_type_details){$this->user_type_details = $user_type_details;}
    function setuser_gender_details($user_gender_details){$this->user_gender_details = $user_gender_details;}
    function setuser_phone_contry_code_details($user_phone_contry_code_details){$this->user_phone_contry_code_details = $user_phone_contry_code_details;}


    function getuser_id(){return $this->user_id;}
    function getuser_status_id(){return $this->user_status_id;}
    function getuser_type_id(){return $this->user_type_id;}
    function getuser_gender_id(){return $this->user_gender_id;}
    function getuser_phone_country_code_id(){return $this->user_phone_country_code_id;}
    function getuser_phone_number(){return $this->user_phone_number;}
    function getuser_email(){return $this->user_email;}
    function getuser_name(){return $this->user_name;}
    function getuser_password_hashed(){return $this->user_password_hashed;}
    function getuser_firstname(){return $this->user_firstname;}
    function getuser_lastname(){return $this->user_lastname;}
    function getuser_user_address(){return $this->user_user_address;}
    function getuser_birthdate(){return $this->user_birthdate;}
    function getuser_valid_id_photo(){return $this->user_valid_id_photo;}
    function getuser_profile_picture(){return $this->user_profile_picture;}
    function getuser_date_created(){return $this->user_date_created;}
    function getuser_date_updated(){return $this->user_date_updated;}

    function getuser_status_details(){return $this->user_status_details;}
    function getuser_type_details(){return $this->user_type_details;}
    function getuser_gender_details(){return $this->user_gender_details;}
    function getuser_phone_contry_code_details(){return $this->user_phone_contry_code_details;}
    // functions
    
    // login  / select sql      (note that only get user_id,user_status_id)
    function login(){
        try{
            $sql = 'SELECT user_id,user_password_hashed FROM users
            WHERE user_name = BINARY :user_name OR user_email =  :user_email OR user_phone_number = :user_phone_number;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $this->user_email);
            $query->bindParam(':user_name', $this->user_name);
            $query->bindParam(':user_phone_number', $this->user_phone_number);
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
    // login with google
    // login with facebook

    // get user details  / select sql
    function get_user_details(){
        try{
            $sql = 'SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
            user_name,user_firstname,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $this->user_id);
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
    // save new password / update sql

    // check for duplicate
    function user_duplicateAll(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE user_name = BINARY :user_name OR user_email =  :user_email OR user_phone_number = :user_phone_number;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $this->user_email);
            $query->bindParam(':user_name', $this->user_name);
            $query->bindParam(':user_phone_number', $this->user_phone_number);
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

    function user_duplicateEmail(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE user_email =  :user_email ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $this->user_email);
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
    function user_duplicatePhone(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE user_phone_number = :user_phone_number ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_phone_number', $this->user_phone_number);
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
    function user_duplicateUsername(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE user_name = BINARY :user_name ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $this->user_name);
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

    // get user id with username
    function user_id_with_username(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE user_name = BINARY :user_name ;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_name', $this->user_name);
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

    // sign Up  / insert sql
    function signup(){
        // note that this assumes that the photos that is uploaded is already in the file system
        
        try {
            $sql = 'INSERT INTO users VALUES(
                null,
                (SELECT user_status_id FROM user_status WHERE user_status_details = :user_status_details),
                (SELECT user_type_id FROM user_types WHERE user_type_details = :user_type_details),
                (SELECT user_gender_id FROM user_genders WHERE user_gender_details = :user_gender_details),
                (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details = :user_phone_contry_code_details),
                :user_phone_number,
                :user_email,
                :user_name,
                :user_password_hashed,
                :user_firstname,
                :user_lastname,
                null,
                :user_birthdate,
                :user_valid_id_photo,
                :user_profile_picture,
                now(),
                now()
                
            );' ;

            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_status_details', $this->user_status_details);
            $query->bindParam(':user_type_details', $this->user_type_details);
            $query->bindParam(':user_gender_details', $this->user_gender_details);
            $query->bindParam(':user_phone_contry_code_details', $this->user_phone_contry_code_details);

            $query->bindParam(':user_phone_number', $this->user_phone_number);
            $query->bindParam(':user_email', $this->user_email);
            $query->bindParam(':user_name', $this->user_name);
            $query->bindParam(':user_password_hashed', $this->user_password_hashed);
            $query->bindParam(':user_firstname', $this->user_firstname);
            $query->bindParam(':user_lastname', $this->user_lastname);
            $query->bindParam(':user_birthdate', $this->user_birthdate);

            $query->bindParam(':user_valid_id_photo', $this->user_valid_id_photo);
            $query->bindParam(':user_profile_picture', $this->user_profile_picture);
            $data = $query->execute();
      
            return $data;
        }catch (PDOException $e){
            return false;
        }
    }
    // user update  / update sql



   
}

    // user_id int primary key auto_increment,
    // user_status_id int,
    // user_type_id int ,
    // user_gender_id tinyint,
    // user_phone_country_code_id int,
    // user_phone_number VARCHAR(15) ,
    // user_email VARCHAR(255),
    // user_name VARCHAR(255),
    // user_password_hashed VARCHAR(255),
    // user_firstname VARCHAR(100),
    // user_lastname VARCHAR(100),
	// user_birthdate DATE,
    // user_valid_id_photo VARCHAR(100),
    // user_profile_picture VARCHAR(100),
    // user_date_created datetime,
    // user_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
?>

   