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
    private $user_email_verified;
    private $user_phone_verified;
    private $user_email;
    private $user_name;
    private $user_password_hashed;
    private $user_firstname;
    private $user_middlename;
    private $user_lastname;
    private $user_address;
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
    function setuser_email_verified($user_email_verified){$this->user_email_verified = $user_email_verified;}
    function setuser_phone_verified($user_phone_verified){$this->user_phone_verified = $user_phone_verified;}
    function setuser_email($user_email){$this->user_email = $user_email;}
    function setuser_name($user_name){$this->user_name = $user_name;}
    function setuser_password_hashed($user_password_hashed){$this->user_password_hashed = $user_password_hashed;}
    function setuser_firstname($user_firstname){$this->user_firstname = $user_firstname;}
    function setuser_lastname($user_lastname){$this->user_lastname = $user_lastname;}
    function setuser_middlename($user_middlename){$this->user_middlename = $user_middlename;}
    function setuser_address($user_address){$this->user_address = $user_address;}
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
    function getuser_email_verified(){return $this->user_email_verified;}
    function getuser_phone_verified(){return $this->user_phone_verified;}
    function getuser_email(){return $this->user_email;}
    function getuser_name(){return $this->user_name;}
    function getuser_password_hashed(){return $this->user_password_hashed;}
    function getuser_firstname(){return $this->user_firstname;}
    function getuser_middlename(){return $this->user_middlename;}
    function getuser_lastname(){return $this->user_lastname;}
    function getuser_address(){return $this->user_address;}
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
            WHERE (user_name = BINARY :user_name AND user_name_verified = 1) OR (user_email =  :user_email AND user_email_verified = 1) ; ';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_email', $this->user_email);
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
    // login with google
    // login with facebook

    // get user details  / select sql
    function get_user_details(){
        try{
            $sql = 'SELECT user_id,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
            user_name,user_phone_verified,user_email_verified,user_name_verified,user_firstname,user_address,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
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
    
    function get_user_password_hashed_with_id(){
        try{
            $sql = 'SELECT user_password_hashed FROM users 
            WHERE user_id=:user_id;';
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
    function change_user_password(){
        try{
            $sql = 'UPDATE users
            SET user_password_hashed =:user_password_hashed
            WHERE user_id =:user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_password_hashed', $this->user_password_hashed);
            $query->bindParam(':user_id', $this->user_id);
            if($data = $query->execute()){
                return $data;
            }else{
                return false;
            }
        }catch (PDOException $e){
            return false;
        }
    }

    // check for duplicate
    function user_duplicateAll(){
        try{
            $sql = 'SELECT user_id FROM users
            WHERE (user_name = BINARY :user_name AND user_name_verified =true) OR (user_email =  :user_email AND user_email_verified = true) OR (user_phone_number = :user_phone_number AND user_phone_verified =true)';
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
            WHERE user_email =  :user_email AND user_email_verified = true;';
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
            WHERE user_phone_number = :user_phone_number AND user_phone_verified =true;';
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
            WHERE user_name = BINARY :user_name AND user_name_verified =true;';
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
            $sql = 'INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
            user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
                null,
                (SELECT user_status_id FROM user_status WHERE user_status_details = :user_status_details),
                (SELECT user_type_id FROM user_types WHERE user_type_details = :user_type_details),
                (SELECT user_gender_id FROM user_genders WHERE user_gender_details = :user_gender_details),
                (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details = :user_phone_contry_code_details),
                :user_phone_number,
                :user_email,
                :user_name,
                true,
                :user_password_hashed,
                :user_firstname,
                :user_middlename,
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

            $query->bindParam(':user_middlename', $this->user_middlename);
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
    function profile_update(){
        try{
            $sql = 'UPDATE  users
            SET 
            user_firstname = :user_firstname,
            user_middlename = :user_middlename,
            user_lastname = :user_lastname,
            user_gender_id = (SELECT user_gender_id FROM user_genders WHERE user_gender_details = :user_gender_details),
            user_phone_number = :user_phone_number,
            user_address = :user_address,
            user_birthdate = :user_birthdate
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);

            $query->bindParam(':user_firstname', $this->user_firstname);
            $query->bindParam(':user_middlename', $this->user_middlename);
            $query->bindParam(':user_lastname', $this->user_lastname);
            $query->bindParam(':user_gender_details', $this->user_gender_details);

            $query->bindParam(':user_phone_number', $this->user_phone_number);
            $query->bindParam(':user_address', $this->user_address);
            $query->bindParam(':user_birthdate', $this->user_birthdate);
            $query->bindParam(':user_id', $this->user_id);

            return $query->execute();
            
           
        }catch (PDOException $e){
            return false;
        }
    }

    function update_valid_id(){
        try{
            $sql = 'UPDATE users
            SET user_valid_id_photo = :user_valid_id_photo
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_valid_id_photo', $this->user_valid_id_photo);
            $query->bindParam(':user_id', $this->user_id);
            return $query->execute();
            
        }catch (PDOException $e){
            return false;
        }
    }
    function update_profile_pic(){
        try{
            $sql = 'UPDATE users
            SET user_profile_picture = :user_profile_picture
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_profile_picture', $this->user_profile_picture);
            $query->bindParam(':user_id', $this->user_id);
            return $query->execute();
            
        }catch (PDOException $e){
            return false;
        }
    }

    function fetch_all_users($limit_offset, $limit_result=10){
        $limit_offset = $limit_result*$limit_offset;
        if($limit_offset<0){
            $limit_offset=0;
        }
        try{
            $sql = 'SELECT user_id,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,user_email_verified,
            user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
            LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
            LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
            LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
            LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
            LEFT JOIN admins ON users.user_id=admins.admin_user_id
            where admins.admin_user_id is null
            ORDER BY user_status_details,user_name
            LIMIT :limit_offset , :limit_result
            ;';
            $query=$this->db->connect()->prepare($sql);
            //$query->bindParam(':limit_result', (int)$limit_result);
            $query->bindValue(':limit_result', (int) $limit_result, PDO::PARAM_INT);
            $query->bindValue(':limit_offset', (int) $limit_offset, PDO::PARAM_INT);
            //$query->bindParam(':limit_offset', $limit_offset);
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
    function count_users(){
        try{
            $sql = 'select COUNT(*) as number_of_users FROM users;';
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

    function update_user_status($user_id,$user_status_details){
        
        try{
            $sql = 'UPDATE users
            SET user_status_id =(SELECT user_status_id FROM user_status WHERE user_status_details = :user_status_details)
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_status_details', $user_status_details);
            $data =  $query->execute();
            return $data;
            
            
        }catch (PDOException $e){
            return false;
        }
    }

    function delete_user($user_id){
        
        try{
            $sql = 'DELETE FROM users WHERE  user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $data =  $query->execute();
            return $data;
            
            
        }catch (PDOException $e){
            return false;
        }
    }

    function update_email($user_id,$user_email){
        try{
            $sql = 'UPDATE users
            SET user_email = :user_email ,
            user_email_verified = 1
            WHERE user_id = :user_id;';
            $query=$this->db->connect()->prepare($sql);
            $query->bindParam(':user_id', $user_id);
            $query->bindParam(':user_email', $user_email);
            $data =  $query->execute();
            
            return $data;
            
            
        }catch (PDOException $e){
            return false;
        }
    }
    
    function accounts_stats(){
        try{
            $sql = 'SELECT count(*) - count(user_email_verified) as not_verified,count(user_email_verified) as verified FROM users;';
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

   