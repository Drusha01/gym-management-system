<?php 
require_once 'database.php';
Class users{

    // attributes
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
    private $user_birthdate;
    private $user_valid_id_photo;
    private $user_profile_picture;
    private $user_date_created;
    private $user_date_updated;

    // constructor
    function __construct()
    {
        $this->db = new Database();
    }

    // setter and getter

    // functions
    
    // login  / select sql      (note that only get user_id,user_status_id)
    function login(){

    }


    // login with google
    // login with facebook

    // get user details  / select sql
    // save new password / update sql
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
                (CURDATE()),
                :user_valid_id_photo,
                :user_profile_picture,
                now(),
                now()
                
            );' ;

            $query=$this->db->connect()->prepare($sql);
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

   