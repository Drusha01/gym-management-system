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
),(	
	null,
    'admin'
),(	
	null,
    'sub-admin'
),(	
	null,
    'super-admin'
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
),(
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
    'Prefer not to say'
),(
	null,
    'Male'
),(
	null,
    'Female'
),(
	null,
    'Other'
),(
	null,
    'Transgender'
),(
	null,
    'Gender neutral'
),(
	null,
    'Non-binary'
),(
	null,
    'Agender'
),(
	null,
    'Pangender'
),(
	null,
    'Genderqueer'
),(
	null,
    'Two-spirit'
),(
	null,
    'Third gender'
);



-- SELECT user gender id
SELECT user_gender_id FROM user_genders 
WHERE user_gender_details = 'Male';

-- SELECT * from genders
SELECT * FROM user_genders
ORDER BY user_gender_id 
LIMIT 20;

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
    user_status_id int NOT NULL,
    user_type_id int NOT NULL ,
    user_gender_id tinyint  NOT NULL,
    user_phone_country_code_id int  NOT NULL,
    user_phone_number VARCHAR(15)   NOT NULL,
    user_name_verified BOOL DEFAULT NULL,
    user_email_verified BOOL DEFAULT NULL,
    user_phone_verified BOOL DEFAULT NULL,
    user_valid_id_validated BOOL DEFAULT NULL,
    user_email VARCHAR(255)   NOT NULL,
    user_name VARCHAR(255)   NOT NULL,
    user_password_hashed VARCHAR(255)  NOT NULL,
    user_firstname VARCHAR(100)  NOT NULL,
    user_middlename VARCHAR(100)  NOT NULL,
    user_lastname VARCHAR(100)  NOT NULL,
    user_address VARCHAR(255) DEFAULT NULL,
	user_birthdate DATE NOT NULL, 
    user_valid_id_photo VARCHAR(100) DEFAULT 'default.png',
    user_profile_picture VARCHAR(100) DEFAULT 'default.png',
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

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,user_email_verified,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'deleted'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827341',
    'hanz.dumapit52@gmail.com',
    true,
    'Drusha01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

-- dashboard accounts count
SELECT count(user_email_verified) as verified,count(*)-count(user_email_verified)  as not_verified FROM users;


INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,user_email_verified,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827001',
    'jamestrinidad@gmail.com',
    true,
    'JamesNoLegDay',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'James',
    'Trinidad',
    'Trinidad',
	'',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
),(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Female'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827002',
    'Shania_Nicholas@gmail.com',
    true,
    'ShaniaNic',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Shania',
    'Gabrielle',
    'Nicholas',
	'',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
    
),(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827003',
    'RobbieLim@gmail.com',
    true,
    'RobbieLim',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Robbie',
    'John',
    'Lim',
	'',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
),(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827004',
    'jamestrinidad@gmail.com',
    true,
    'RobRoche',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Rob',
    'Roche',
    'Villanueva',
	'',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,user_email_verified,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827342',
    'hanz.dumapit53@gmail.com',
    true,
    'Drusha01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827343',
    'hanz.dumapit54@gmail.com',
    'Drusha02',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('1999-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

-- insert for users
INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827345',
    'hanz.dumapit56@gmail.com',
    'Drusha03',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('2001-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827344',
    'hanz.dumapit56@gmail.com',
    'Drusha04',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);

-- updating status
UPDATE users
SET user_status_id =(SELECT user_status_id FROM user_status WHERE user_status_details = 'active')
WHERE user_id = 1;

-- hard delete
DELETE FROM users WHERE  user_id = 1;

-- SELECT * users if it is active
SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE  user_status_details = 'active'
;

-- select * users for accounts
SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
ORDER BY user_status_details,user_name
;

SELECT user_id,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,user_email_verified,
user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
-- LEFT JOIN admins ON users.user_id=admins.admin_user_id
-- where admins.admin_user_id is null
ORDER BY user_status_details,user_name
LIMIT 10,20;

-- select * users
SELECT * FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
;

SELECT user_id FROM users
WHERE user_name = BINARY 'Drusha01' OR user_email = 'hanz.dumapit54@gmail.com' OR user_phone_number = '9266827342';

SELECT user_id FROM users
WHERE user_name = BINARY 'Drusha01' OR user_email = 'hanz.dumapit54@gmail.com' OR user_phone_number = '9266827342';

SELECT user_id,user_password_hashed FROM users
WHERE user_name = BINARY 'Drusha01' OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1) ;

SELECT user_id,user_password_hashed FROM users
WHERE user_name = BINARY 'Drusha01' OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1) AND user_type_id= (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal');

SELECT user_id,user_password_hashed FROM users
WHERE (user_name = BINARY 'Drusha02' AND  user_type_id= (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1 AND user_type_id= (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal')));

-- login
SELECT user_id,user_password_hashed FROM users
WHERE user_name = BINARY 'Drusha01' OR user_email = 'hanz.dumapit54@gmail.com' OR user_phone_number = '9266827342';

SELECT user_id,user_password_hashed FROM users
WHERE (user_name = BINARY 'jaydee' AND user_name_verified = 1) OR (user_email =  'jaydee' AND user_email_verified = 1) ;

-- select user details
SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE user_id = 6;

-- get user password by id
SELECT user_password_hashed FROM users 
WHERE user_id=1;

-- change user password
UPDATE users
SET user_password_hashed = '$argon2i$v=19$m=65536,t=4,p=1$YXVYRjN1VlJJdWpnYXRZSA$gC4ppnU/kaAX4NnOUs5riFCokl+qisTbp9GmCaXkO38'
WHERE user_id = 1;

-- update valid id
UPDATE users
SET user_valid_id_photo = 'valid_id.jpg'
WHERE user_id = 1;

-- update profile picture
UPDATE users
SET user_profile_picture = 'profilepicture.jpg'
WHERE user_id = 1;

-- update user information (note that email and phone have separate update because it is used in loggin in option)
UPDATE  users
SET 
user_gender_id = (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
user_firstname ='Tipamood',
user_lastname = 'Drusha',
user_birthdate = CURDATE(),
user_valid_id_photo = 'something valid id',
user_profile_picture ='default.png'
WHERE user_id = 1;

UPDATE  users
SET 
user_firstname ='Cammy',
user_middlename ='Tipamood',
user_lastname = 'Drusha',
user_gender_id = (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
user_email = 'hanz.dumapit69@gmail.com',
user_phone_number = '09469696969',
user_address = 'malagutay',
user_birthdate = CURDATE()
WHERE user_id = 1;

-- table for controls
CREATE TABLE offer_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);
CREATE TABLE avail_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);
CREATE TABLE account_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);
CREATE TABLE payment_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);
CREATE TABLE maintenance_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);
CREATE TABLE report_controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);

INSERT INTO offer_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);

INSERT INTO avail_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);
INSERT INTO account_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);
INSERT INTO payment_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);
INSERT INTO maintenance_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);
INSERT INTO report_controls (control_id, control_details) VALUES 
(
	null,
    'Modify'
),(
	null,
    'Read-Only'
),(
	null,
    'None'
);

SELECT control_id FROM offer_controls WHERE control_details="Read-Only";

-- table for admin
CREATE TABLE admins(
	admin_id int primary key auto_increment,
    admin_type_id int NOT NULL ,
	admin_user_id int unique not null,
    admin_offer_restriction int not null,
    admin_avail_restriction int not null,
    admin_account_restriction int not null,
    admin_payment_restriction int not null,
    admin_maintenance_restriction int not null,
    admin_report_restriction int not null,
    admin_date_created datetime,
    admin_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_type_id) REFERENCES user_types(user_type_id),
    FOREIGN KEY (admin_user_id) REFERENCES users(user_id),
    FOREIGN KEY (admin_offer_restriction) REFERENCES offer_controls(control_id),
    FOREIGN KEY (admin_avail_restriction) REFERENCES avail_controls(control_id),
    FOREIGN KEY (admin_account_restriction) REFERENCES account_controls(control_id),
    FOREIGN KEY (admin_payment_restriction) REFERENCES payment_controls(control_id),
    FOREIGN KEY (admin_maintenance_restriction) REFERENCES maintenance_controls(control_id),
    FOREIGN KEY (admin_report_restriction) REFERENCES report_controls(control_id)
);
-- INSERT admin
INSERT INTO admins VALUES(
	null,
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'admin'),
    (SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha01') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1)) ,
    (SELECT control_id FROM offer_controls WHERE control_details = "Read-Only"),
    (SELECT control_id FROM avail_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM account_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM payment_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM maintenance_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM report_controls WHERE control_details = "Modify"),
    now(),
    now()
);
INSERT INTO admins VALUES(
	null,
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'sub-admin'),
    (SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha02') OR (user_email = 'hanz.dumapit54@gmail.com' AND user_email_verified = 1)) ,
    (SELECT control_id FROM offer_controls WHERE control_details = "Read-Only"),
    (SELECT control_id FROM avail_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM account_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM payment_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM maintenance_controls WHERE control_details = "Modify"),
    (SELECT control_id FROM report_controls WHERE control_details = "Modify"),
    now(),
    now()
);

UPDATE admins 
SET
admin_offer_restriction = (SELECT control_id FROM offer_controls WHERE control_details = "Modify"),
admin_avail_restriction= (SELECT control_id FROM avail_controls WHERE control_details = "Modify"),
admin_account_restriction= (SELECT control_id FROM account_controls WHERE control_details = "Modify"),
admin_payment_restriction= (SELECT control_id FROM payment_controls WHERE control_details = "Modify"),
admin_maintenance_restriction = (SELECT control_id FROM maintenance_controls WHERE control_details = "Modify"),
admin_report_restriction= (SELECT control_id FROM report_controls WHERE control_details = "Modify")
WHERE admin_user_id = (SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha01') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1));


UPDATE admins 
SET
admin_offer_restriction = (SELECT control_id FROM offer_controls WHERE control_details = "Read-Only"),
admin_avail_restriction= (SELECT control_id FROM avail_controls WHERE control_details = "Modify"),
admin_account_restriction= (SELECT control_id FROM account_controls WHERE control_details = "Read-Only"),
admin_payment_restriction= (SELECT control_id FROM payment_controls WHERE control_details = "Modify"),
admin_maintenance_restriction = (SELECT control_id FROM maintenance_controls WHERE control_details = "Modify"),
admin_report_restriction= (SELECT control_id FROM report_controls WHERE control_details = "Modify")
WHERE admin_user_id = 2;

 SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha01') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1);
-- SELECT * admins
SELECT * FROM admins;


DELETE FROM admins
WHERE admin_id =3;
-- check if we are admin
SELECT * FROM admins
WHERE admin_type_id =(SELECT user_type_id FROM user_types WHERE user_type_details = 'admin') AND admin_user_id =3;


-- admin login
SELECT admin_id,admin_user_id,user_password_hashed FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE (user_name = BINARY 'Drusha01' AND user_name_verified = 1) OR (user_email =  'hanz.dumapit56@gmail.com' AND user_email_verified = 1) ; 

SELECT * FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE admin_id = 1;

-- admin details
SELECT * FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE admin_id =3;

-- admin details
SELECT admin_id, user_id, user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
 user_phone_number, user_email, user_name, user_firstname, user_middlename, user_lastname, user_address,
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
WHERE admin_id = 1
;

-- select all sub admins
SELECT admin_id, user_id,user_name, CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
 user_phone_number, user_email, user_name, user_firstname, user_middlename, user_lastname, user_address,
 user_birthdate, user_valid_id_photo, user_profile_picture, user_date_created,  user_date_updated,CAST(admin_date_created AS DATE) admin_date_created,
 offer_controls.control_details AS admin_offer_restriction_details,
 avail_controls.control_details AS admin_avail_restriction_details,
 account_controls.control_details AS admin_account_restriction_details,
 payment_controls.control_details AS admin_payment_restriction_details,
 maintenance_controls.control_details AS admin_maintenance_restriction_details,
 report_controls.control_details AS admin_reports_restriction_details
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
WHERE admin_id != 1
;

-- select all non admins
SELECT user_id,CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_birthdate,user_gender_details  from users
LEFT JOIN admins ON users.user_id=admins.admin_user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
where admins.admin_user_id is null
;

SELECT admin_id,admin_user_id,user_password_hashed FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE (user_name = BINARY 'Drusha01' AND user_name_verified = 1) OR (user_email =  's' AND user_email_verified = 1) ; 
   
   
   

-- db for address

-- table for province
CREATE TABLE location_provinces(
	location_province_id int primary key auto_increment,
    location_province_details varchar(50) not null unique	
);

    
    
-- table for age qualification
CREATE TABLE age_qualifications(
	age_qualification_id int primary key auto_increment,
    age_qualification_details varchar(50) not null unique	
);

-- insert for age qualification
INSERT INTO age_qualifications VALUES
(
	null,
    'None'
),(
	null,
    '21 above'
);

-- select * from age qualifications
SELECT * FROM age_qualifications;

-- insert into age qualifations
INSERT INTO age_qualifications VALUES
(
	null,
    '19 below'
);

-- select age_qualification_id from age_qualifications
SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None';

-- table for type of subscription
CREATE TABLE type_of_subscriptions(
	type_of_subscription_id int primary key auto_increment,
    type_of_subscription_details varchar(50) not null unique	
);

-- inserts for types of subscription
INSERT INTO type_of_subscriptions VALUES
(
	null,
    'Gym Subscription'
),(
	null,
    'Trainer Subscription'
),(
	null,
    'Locker Subscription'
),(
	null,
    'Program Subscription'
);

SELECT * from type_of_subscriptions;

SELECT * FROM type_of_subscriptions
WHERE type_of_subscription_details = 'Gym Subscription';

-- selecting id of type of subscription
SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription';

-- status table
CREATE TABLE statuses(
	status_id int primary key auto_increment,
    status_details varchar(50) not null unique	
);

-- inserts for statuses
INSERT statuses VALUES
(
	null,
    'active'
),(
	null,
    'inactive'
),(
	null,
    'deleted'
);

-- table for offers
CREATE TABLE offers(
	offer_id int primary key auto_increment ,
    offer_name varchar(50) not null,
    offer_status_id int not null,
    offer_type_of_subscription_id int not null,
    offer_age_qualification_id int not null,
    offer_duration int not null,
	offer_slots VARCHAR(10) default 'None',
    offer_price float not null,
    offer_description VARCHAR(1024) not null,
    offer_file VARCHAR(50),
    offer_date_created datetime default NOW(),
    offer_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (offer_status_id) REFERENCES statuses(status_id),
    FOREIGN KEY (offer_age_qualification_id) REFERENCES age_qualifications(age_qualification_id),
    FOREIGN KEY (offer_type_of_subscription_id) REFERENCES type_of_subscriptions(type_of_subscription_id)
    
);


-- inserts for offers

INSERT INTO offers  (offer_id, offer_name, offer_status_id, offer_type_of_subscription_id, offer_age_qualification_id, offer_duration, offer_slots, offer_price,offer_file,offer_description) VALUES
(
	null,
    '1-Month Gym-Use(21 and Above)',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    30,
    'None',
    800.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '2-Month Gym-Use(21 and Above)',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    60,
    'None',
    1500.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '3-Month Gym-Use(21 and Above)',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    90,
    'None',
    2200.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '1-Month Locker-Use',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Locker Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    20,
    200.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '2-Month Locker-Use',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Locker Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    60,
    20,
    390.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '3-Month Locker-Use',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Locker Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    90,
    20,
    550.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '1-Month Trainer',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Trainer Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    'None',
    1500.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '2-Month Trainer',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Trainer Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    60,
    'None',
    2900.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    '3-Month Trainer',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Trainer Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    90,
    'None',
    4200,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
);

-- INSERT INTO offers   (offer_id, offer_name, offer_status_id, offer_type_of_subscription_id, offer_age_qualification_id, offer_duration, offer_slots, offer_price,offer_file,offer_description)VALUES
-- (
-- 	null,
--     'Walk-In Gym-Use',
--     (SELECT status_id FROM statuses WHERE status_details= 'active'),
--     (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Walk-In Gym Subscription'),
--     (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
--     1,
--     'None',
--     100.00,
--     'offer_default.jpg',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
-- ),(
-- 	null,
--     'Walk-In Trainer-Use',
--     (SELECT status_id FROM statuses WHERE status_details= 'active'),
--     (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Walk-In Trainer Subscription'),
--     (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
--     1,
--     'None',
--     150.00,
--     'offer_default.jpg',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
-- );

INSERT INTO offers   (offer_id, offer_name, offer_status_id, offer_type_of_subscription_id, offer_age_qualification_id, offer_duration, offer_slots, offer_price,offer_file,offer_description)VALUES
(
	null,
    'Zumba',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Program Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    'None',
    400.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    'Calisthenics',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Program Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    'None',
    600,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
);



SELECT * FROM offers;

-- select all offers
SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price,offer_description ,offer_file FROM offers
LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
WHERE status_details ='active'
;

-- select offer with id
SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price,offer_description FROM offers
LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
WHERE offer_id = 4 AND status_details ='active'
;

CREATE TABLE offer_contents(
	offer_content_id int primary key auto_increment,
    offer_id int not null,
    content_name varchar(255),
    FOREIGN KEY (offer_id) REFERENCES offers(offer_id)
);




-- soft delete for offer
UPDATE offers
SET offer_status_id = (SELECT status_id FROM statuses WHERE status_details= 'deleted')
WHERE offer_id = 69
; 

-- update offer row
UPDATE offers
SET 
offer_name = ' Hanrickson Gym',
offer_type_of_subscription_id = (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
offer_age_qualification_id  = (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
offer_duration ='60',
offer_slots = 'None',
offer_price = 1000
WHERE offer_id =0;
 -- count offers
SELECT COUNT(*) FROM offers;

-- select * offers as per subscription type
SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price,offer_description,offer_file FROM offers
LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
WHERE offer_type_of_subscription_id = (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Locker Subscription')
;

-- trainer statuses
CREATE TABLE trainer_availability(
	trainer_availability_id int primary key auto_increment,
    trainer_availability_details varchar(50) not null unique	
);

-- insert for trainer status
INSERT INTO trainer_availability VALUES
(
	null,
    'Available'
),(
	null,
    'Unavailable'
);

SELECT * FROM trainer_availability;

SELECT trainer_availability_id FROM trainer_availability
WHERE trainer_availability_details = 'Available';

-- table for trainers
CREATE TABLE trainers(
	trainer_id int primary key auto_increment,
    trainer_user_id int not null,
    trainer_availability_id int not null,
    trainer_status_id int not null,
    trainer_date_created datetime default NOW(),
    trainer_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (trainer_user_id) REFERENCES users(user_id),
    FOREIGN KEY (trainer_availability_id) REFERENCES trainer_availability(trainer_availability_id),
    FOREIGN KEY (trainer_status_id) REFERENCES statuses(status_id)
);


-- inserts for trainer
INSERT INTO trainers (trainer_id,trainer_user_id,trainer_availability_id,trainer_status_id,trainer_date_created,trainer_date_updated) VALUES
(
	null,
    (SELECT user_id FROM users WHERE user_name = 'JamesNoLegDay'),
    (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = 'Available'),
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    now(),
    now()
    
),(
	null,
    (SELECT user_id FROM users WHERE user_name = 'ShaniaNic'),
    (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = 'Available'),
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    now(),
    now()
    
),(
	null,
    (SELECT user_id FROM users WHERE user_name = 'RobRoche'),
    (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = 'Available'),
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    now(),
    now()
    
),(
	null,
    (SELECT user_id FROM users WHERE user_name = 'RobbieLim'),
    (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = 'Available'),
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    now(),
    now()
    
);

-- select * trainers
SELECT * FROM trainers
LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
;

SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details FROM trainers
LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
WHERE trainer_availability_details = 'Available'
ORDER BY user_fullname

;

SELECT trainer_id,user_id,user_name,CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_email,user_status_details,user_birthdate,trainer_availability_details,user_gender_details,user_address,
user_phone_number,user_email,user_date_created FROM trainers
LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
WHERE trainer_id = 1;
;

-- select all non trainers
SELECT user_id,CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_birthdate,user_gender_details  from users
LEFT JOIN trainers ON users.user_id=trainers.trainer_user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
where trainers.trainer_user_id is null
;

update trainers 
SET trainer_availability_id = (SELECT trainer_availability_id FROM trainer_availability WHERE trainer_availability_details = 'Unavailable')
WHERE trainer_id = 1;

SELECT * FROM trainers;

-- table for email verification
CREATE TABLE email_verify(
	email_verify_id int primary key	auto_increment,
    email_verify_user_id int not null,
    email_verify_email VARCHAR(255) not null,
    email_verify_code int not null,
    email_date_time DATETIME default NOW(),
    FOREIGN KEY (email_verify_user_id) REFERENCES users(user_id)
);

-- email insert
INSERT INTO email_verify (email_verify_user_id,email_verify_email,email_verify_code) VALUES
(
	(SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02' AND user_name_verified = 1),
    'hanz.dumapit55@gmail.com',
    4558518
);

SELECT * FROM email_verify;

SELECT  email_verify_user_id,email_verify_email,UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) as seconds,email_verify_code FROM email_verify
WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) ) <=60 AND email_verify_user_id = '7';

UPDATE users
SET user_email ='hanz.dumapit55@gmail.com',
user_email_verified = 1
WHERE user_id = 7;

SELECT * FROM email_verify 
WHERE  email_verify_code = '4558518' AND email_verify_user_id =7
ORDER BY email_date_time DESC
LIMIT 1;

CREATE TABLE equipments_conditions(
	equipment_condition_id int primary key auto_increment,
    equipment_condition_details varchar(50) unique
);

INSERT INTO equipments_conditions (equipment_condition_id, equipment_condition_details) VALUES
(
	null,
	'Good'
),(
	null,
	'In-Maintenance'
);

SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = 'Good';

-- table for maintenance
CREATE TABLE equipments(
	equipment_id int primary key auto_increment,
    equipment_name VARCHAR(100) not null,
    equipment_quantity int not null,
    equipment_condition_id int not null,
    FOREIGN KEY (equipment_condition_id) REFERENCES equipments_conditions(equipment_condition_id)
);

INSERT INTO equipments (equipment_id,equipment_name,equipment_quantity,equipment_condition_id) VALUES
(
	null,
    'Treadmill',
    4,
    (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = 'Good')
),(
	null,
    '	Leg Press Machine',
    4,
    (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = 'In-Maintenance')
),(
	null,
    'Bench Press',
    4,
    (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = 'Good')
);

-- fetch all
SELECT equipment_id,equipment_name,equipment_quantity,equipment_condition_details FROM equipments
LEFT OUTER JOIN equipments_conditions ON equipments.equipment_condition_id=equipments_conditions.equipment_condition_id
;

DELETE FROM equipments 
WHERE equipment_id = 4;

-- fetch with id
SELECT equipment_id,equipment_name,equipment_quantity,equipment_condition_details FROM equipments
LEFT OUTER JOIN equipments_conditions ON equipments.equipment_condition_id=equipments_conditions.equipment_condition_id
WHERE equipment_id = 1
;

UPDATE equipments 
SET equipment_name= 'Treadmill',
equipment_quantity = '6',
equipment_condition_id = (SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = 'Good')
WHERE equipment_id = 1;

-- table for discounts
CREATE TABLE discounts(
	discount_id int primary key auto_increment,
    discount_name VARCHAR(50),
    discount_details VARCHAR(255),
    discount_rate FLOAT8
);

-- insert for discount
INSERT INTO discounts (discount_id, discount_name, discount_details, discount_rate) VALUES
(
	null,
    'No discount',
    'No discounted',
    0
);

-- table for subscription status
CREATE TABLE subscription_status(
	subscription_status_id int primary key auto_increment,
    subscription_status_details varchar(50) unique
);

INSERT INTO subscription_status (subscription_status_id, subscription_status_details) VALUES
( 
	null,
    'Active'
),( 
	null,
    'Pending'
),( 
	null,
    'Completed'
),( 
	null,
    'Deleted'
),( 
	null,
    'Terminated'
);

SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending';



SELECT * FROM subscription_status;
-- table for subscriptions
CREATE TABLE subscriptions(
	subscription_id int primary key auto_increment ,
    subscription_quantity int not null,
    subscription_subscriber_user_id int not null,
    subscription_offer_name VARCHAR(255) not null,	-- for persistence of data
    subscription_type_of_subscription_id  int not null ,	
    subscription_duration int not null , -- persistence of data
    subscription_price float not null,	-- persistence of data
    subscription_total_duration int not null , -- persistence of data
    subscription_status_id  int not null, 
    subscription_start_date datetime not null,
    subscription_discount float not null default 0,	-- discount
    subscription_penalty_due float not null default 0, -- penalty due
    subscription_paid_amount float not null default 0, -- paid amout
    
    subscription_date_created datetime default NOW(),
    subscription_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (subscription_subscriber_user_id) REFERENCES users(user_id),
    FOREIGN KEY (subscription_status_id) REFERENCES subscription_status(subscription_status_id),
    FOREIGN KEY (subscription_type_of_subscription_id) REFERENCES type_of_subscriptions(type_of_subscription_id)
    
    -- foreign keys
);

-- number of lockers
CREATE TABLE number_of_lockers(
	locker_id int primary key auto_increment ,
    locker_number int not null
);

INSERT INTO  number_of_lockers VALUES
(
	null,
    45
);

UPDATE number_of_lockers
SET locker_number = 3
WHERE locker_id =1;


SELECT locker_id,locker_number FROM number_of_lockers
WHERE locker_id =1;


CREATE TABLE subscriber_trainers(
	subscriber_trainers_id int primary key auto_increment ,
    subscriber_trainers_subscriber_id int not null,
    subscriber_trainers_trainer_id int not null,
    subscriber_trainers_subscription_id int not null,
    FOREIGN KEY (subscriber_trainers_subscriber_id) REFERENCES users(user_id),
    FOREIGN KEY (subscriber_trainers_trainer_id) REFERENCES trainers(trainer_id),
    FOREIGN KEY (subscriber_trainers_subscription_id) REFERENCES subscriptions(subscription_id)
);





CREATE TABLE walk_in_services(
	walk_in_service_id int primary key auto_increment,
    walk_in_service_details varchar(50) unique
);


INSERT INTO walk_in_services VALUES
(
	null,
    'Gym-Use'
),(
	null,
   'Gym-Use and Trainer'
);


INSERT INTO walk_in_services VALUES(
	null,
   'Walk-In Trainer'
);

CREATE TABLE walk_in_prices(
	walk_in_price_id int primary key auto_increment,
    walk_in_service_id int not null unique,
    walk_in_service_price float not null,
    FOREIGN KEY (walk_in_service_id) REFERENCES walk_in_services(walk_in_service_id)
);


INSERT INTO walk_in_prices VALUES
(	
	null,
    (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Gym-Use'),
    '100'
),(	
	null,
    (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Gym-Use and Trainer'),
    '150'
);

INSERT INTO walk_in_prices VALUES
(	
	null,
    (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Walk-In Trainer'),
    '100'
);

UPDATE walk_in_prices
SET walk_in_service_price = 150
WHERE walk_in_service_id = (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Walk-In Trainer');

SELECT * FROM walk_in_prices;
SELECT walk_in_price_id, walk_in_service_details, walk_in_service_price FROM walk_in_prices 
LEFT OUTER JOIN walk_in_services ON walk_in_prices.walk_in_service_id=walk_in_services.walk_in_service_id
WHERE walk_in_service_details = 'Gym-Use';

SELECT walk_in_price_id, walk_in_service_details, walk_in_service_price FROM walk_in_prices 
LEFT OUTER JOIN walk_in_services ON walk_in_prices.walk_in_service_id=walk_in_services.walk_in_service_id;


CREATE TABLE walk_ins(
	walk_in_id int primary key auto_increment ,
    walk_in_user_id int not null,
    walk_in_trainer_id int ,
    walk_in_service_id int not null,
    walk_in_price float not null,
    walk_in_date datetime default now(),
    FOREIGN KEY (walk_in_service_id) REFERENCES walk_in_services(walk_in_service_id),
    FOREIGN KEY (walk_in_user_id) REFERENCES users(user_id),
    FOREIGN KEY (walk_in_trainer_id) REFERENCES trainers(trainer_id)
);

INSERT INTO walk_ins (walk_in_id, walk_in_user_id, walk_in_trainer_id, walk_in_service_id, walk_in_price)VALUES
(
	null,
    8,
    null,
    (SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Gym-Use and Trainer'),
    (SELECT walk_in_service_price FROM walk_in_prices WHERE walk_in_service_id =(SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Gym-Use'))+
    (SELECT walk_in_service_price FROM walk_in_prices WHERE walk_in_service_id =(SELECT walk_in_service_id FROM walk_in_services WHERE walk_in_service_details = 'Walk-In Trainer'))
);

use gms;

-- walkintable
SELECT walk_in_id,CONCAT(u.user_lastname,", ",u.user_firstname," ",u.user_middlename) AS user_fullname, walk_in_service_details, walk_in_date,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS trainer_fullname FROM walk_ins
LEFT OUTER JOIN users as u ON walk_ins.walk_in_user_id=u.user_id
LEFT OUTER JOIN walk_in_services ON walk_ins.walk_in_service_id=walk_in_services.walk_in_service_id
LEFT OUTER JOIN trainers ON walk_ins.walk_in_trainer_id=trainers.trainer_id
LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
ORDER BY walk_in_date ASC
;



-- walk in table

--  subscription insert
-- INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, subscription_status_id, subscription_start_date)VALUES (
-- 	null,
-- 	:subscription_quantity,
-- 	:subscription_subscriber_user_id,
-- 	:subscription_offer_name,
-- 	:type_of_subscription_id,
-- 	:subscription_duration,
-- 	:subscription_price,
-- 	:subscription_total_duration,
-- 	(SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"),
-- 	NOW()
-- );

-- INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, subscription_status_id, subscription_start_date)VALUES (
-- 	null,
-- 	:subscription_quantity,
-- 	:subscription_subscriber_user_id,
-- 	:subscription_offer_name,
-- 	:type_of_subscription_id,
-- 	:subscription_duration,
-- 	:subscription_price,
-- 	:subscription_total_duration,
-- 	(SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"),
-- 	NOW()
-- );
            
            
-- To Train For Today
SELECT  CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriber_trainers 
LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
WHERE subscriber_trainers_trainer_id = 3 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active');

-- To Train For Today full details
SELECT  CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, user_gender_details, user_birthdate FROM subscriber_trainers 
LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
WHERE subscriber_trainers_trainer_id = 4 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active');

-- Total Person Who Availed
SELECT  user_gender_details FROM subscriber_trainers 
LEFT OUTER JOIN users ON subscriber_trainers.subscriber_trainers_subscriber_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
WHERE subscriber_trainers_trainer_id = 3 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active') ;

-- payment

-- dashboard Recent Customers Subscribed
SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_start_date FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
WHERE subscription_status_details = 'Active' 
ORDER BY subscription_start_date DESC 
LIMIT 5;

-- dashboard Recent Customers Subscribed
SELECT count(*) as total FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE subscription_status_details = 'Active' AND subscription_subscriber_user_id = 7;


SELECT * FROM subscriber_trainers
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
WHERE  subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active') ;
-- trainer info
SELECT trainer_id,user_firstname,user_middlename,user_lastname,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_profile_picture,user_birthdate,user_gender_details,trainer_availability_details FROM subscriber_trainers
LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
LEFT OUTER JOIN users ON trainers.trainer_user_id=users.user_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN trainer_availability ON trainers.trainer_availability_id=trainer_availability.trainer_availability_id
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
WHERE subscriber_trainers_subscriber_id = 3 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active');
;

-- activation / making it active
UPDATE subscriptions 
SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active')
WHERE  (subscription_subscriber_user_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'));

-- deletion of active and pending subs
UPDATE subscriptions 
SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Deleted')
WHERE  (subscription_subscriber_user_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'));


(SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active' );

-- selecting all
SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_subscriber_user_id FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
WHERE subscription_status_details = 'Active' OR  subscription_status_details = 'Pending' OR  subscription_status_details = '' OR  subscription_status_details = '' OR  subscription_status_details = ''
ORDER BY user_fullname
;
(SELECT user_id FROM users WHERE user_name = BINARY 'Drusha01');

-- pending and active of customer
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Pending') OR (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Active')
;

-- dashboard subscription TOTAL SUBSCRIPTIONS FOR GYM USE
SELECT SUM(subscription_quantity) as number_of_gym_use FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active'  AND type_of_subscription_details = 'Gym Subscription'
;

-- dashboard subscription Total Subscriptions for Trainer
SELECT SUM(subscription_quantity) as number_of_trainer_use FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active'  AND type_of_subscription_details = 'Trainer Subscription'
;

-- dashboard subscription Total Subscriptions for locker
SELECT SUM(subscription_quantity) as number_of_locker_use FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active'  AND type_of_subscription_details = 'Locker Subscription'
;

-- dashboard subscription Total Subscriptions for program
SELECT  SUM(subscription_quantity) as number_of_program_use FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active'  AND type_of_subscription_details = 'Program Subscription'
;

-- dashboard accounts
SELECT count(*) - count(user_email_verified) as not_verified,count(user_email_verified) as verified FROM users;


-- payment 
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_offer_name, subscription_duration, subscription_price, subscription_total_duration, 
subscription_date_created,subscription_date_updated,subscription_discount,subscription_penalty_due,subscription_paid_amount FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE  (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Active')
;

-- full payment
UPDATE subscriptions 
SET subscription_paid_amount =  ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due)
WHERE subscription_id = 9;

-- payment

SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration,subscription_status_details, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Pending' OR subscription_status_details = 'Active' OR subscription_status_details = 'Complete'
;

-- subscription complete 
UPDATE subscriptions 
SET subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed')
WHERE  (subscription_subscriber_user_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active') AND subscription_id = 25);

-- history
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Completed'
;

-- cancel pending subscription
DELETE FROM subscriptions
WHERE (subscription_subscriber_user_id = 8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'));

-- active
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE  subscription_status_details = 'Active'
;


-- update percent discount
UPDATE subscriptions
SET  subscription_discount=(subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration ))*.10
WHERE subscription_id = 1;

-- update fixed discount
UPDATE subscriptions
SET  subscription_discount= if(3000>(subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )),(subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )),3000)
WHERE subscription_id = 1;
SELECT * FROM subscriptions;

SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending';
use gms;

SELECT * FROM subscriptions 
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_subscriber_user_id = 8 AND  subscription_status_details = 'Pending' AND type_of_subscription_details = 'Trainer Subscription' ) ;

SELECT * FROM offers;

select * from trainers;

SELECT COUNT(*)  FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE  subscription_status_details = 'Active' AND subscription_type_of_subscription_details = 'Gym Subscription'
;


DELETE FROM subscriptions WHERE subscription_subscriber_user_id =(SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02');

(SELECT user_id FROM users WHERE user_name = BINARY 'RobRoche');

SELECT MONTH(DATE_ADD(MONTH, -1, CURRENT_TIMESTAMP));

SELECT  CURDATE();