-- db creation
drop database gms;
CREATE DATABASE gms;

-- using db
USE gms;

-- table for user types
CREATE TABLE user_types(
	user_type_id int primary key auto_increment,
    user_type_details varchar(50) not null unique	
);

-- insert for user types
INSERT into user_types VALUES
(	
	null,
    'normal'
);
-- insert for user types
INSERT into user_types VALUES
(	
	null,
    'admin'
);

-- SELECT user_type_id
SELECT user_type_id FROM user_types 
WHERE user_type_details = 'normal';

-- table for user status
CREATE TABLE user_status(
	user_status_id int primary key auto_increment,
    user_status_details varchar(50) not null unique
);

-- insert for user status
INSERT INTO user_status VALUES
(
	null,
    'active'
),
(
	null,
	'inactive'
),(
	null,
    'deleted'
);
 
-- SELECT user_status_id 
SELECT user_status_id FROM user_status
WHERE user_status_details = 'active';

-- table for gender
CREATE TABLE user_genders(
	user_gender_id tinyint primary key auto_increment,
    user_gender_details varchar(50) unique
);

-- insert for user gender
INSERT INTO user_genders VALUES
(
	null,
    'Male'
),(
	null,
    'Female'
),(
	null,
    'Other'
);

-- SELECT user gender id
SELECT user_gender_id FROM user_genders 
WHERE user_gender_details = 'Male';

-- table for phone country code
CREATE TABLE user_phone_country_code(
	user_phone_country_code_id int primary key auto_increment,
    user_phone_contry_code_details VARCHAR(15)
);

-- insert for phone country code
INSERT INTO user_phone_country_code VALUES
(
	null,
    '+63'
);

-- SELECT user phone country code id 
SELECT user_phone_country_code_id FROM user_phone_country_code 
WHERE user_phone_contry_code_details ='+63';


-- table for users 
CREATE TABLE users(
	user_id int primary key auto_increment,
    user_status_id int,
    user_type_id int ,
    user_gender_id tinyint,
    user_phone_country_code_id int,
    user_phone_number VARCHAR(15) ,
    user_email VARCHAR(255),
    user_name VARCHAR(255),
    user_password_hashed VARCHAR(255),
    user_firstname VARCHAR(100),
    user_lastname VARCHAR(100),
    user_address VARCHAR(255),
	user_birthdate DATE,
    user_valid_id_photo VARCHAR(100),
    user_profile_picture VARCHAR(100),
    user_date_created datetime,
    user_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_type_id) REFERENCES user_types(user_type_id),
	FOREIGN KEY (user_status_id) REFERENCES user_status(user_status_id),
    FOREIGN KEY (user_gender_id) REFERENCES user_genders(user_gender_id),
    FOREIGN KEY (user_phone_country_code_id) REFERENCES user_phone_country_code(user_phone_country_code_id)
);

-- index for users
CREATE INDEX idx_user_email ON users(user_email);
CREATE INDEX idx_user_name ON users(user_name);
CREATE INDEX idx_user_phone_number ON users(user_phone_number);
CREATE INDEX idx_user_password ON users(user_password_hashed);

-- note that 1 user can have 1 unique phone 1 unique email and 1 unique username do it with php error handling

-- INSERT for users
INSERT INTO users VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '9265827342',
    'hanz.dumapit53@gmail.com',
    'Drusha01',
    'NewUserPassword',
    'Hanrickson',
    'Dumapit',
	'user address',
    (CURDATE()),
    'valid_photo',
    'profile_picture',
    now(),
	now()
    
);

-- insert for users
INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_firstname,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '9265827342',
    'hanz.dumapit53@gmail.com',
    'Drusha01',
    'NewUserPassword',
    'Hanrickson',
    'Dumapit',
	'user address',
    (CURDATE()),
    'valid_photo',
    'profile_picture',
    now(),
	now()
    
);

-- SELECT * users
SELECT * FROM users;

SELECT user_id FROM users
WHERE user_name = BINARY 'Drusha01' OR user_email = 'hanz.dumapit54@gmail.com' OR user_phone_number = '9266827342';

-- login
SELECT user_id,user_password_hashed FROM users
WHERE user_name = BINARY 'Drusha01' OR user_email = 'hanz.dumapit54@gmail.com' OR user_phone_number = '9266827342';

-- select user details
SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
user_name,user_firstname,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE user_id = 1;

-- change user password
UPDATE users
SET user_password_hashed = 'passwordsomething'
WHERE user_id = 1;

-- update user information (note that email and phone have separate update because it is used in loggin in option)
UPDATE  users
SET 
user_gender_id = (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
user_firstname ='Tipamood',
user_lastname = 'Drusha',
user_birthdate = CURDATE(),
user_valid_id_photo = 'something valid id',
user_profile_picture ='somethingpicture'
WHERE user_id = 1;

        

    
SELECT  CURDATE();
