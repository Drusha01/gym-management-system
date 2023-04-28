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
CREATE TABLE controls(
	control_id int primary key auto_increment,
    control_details varchar(50) unique
);

INSERT INTO controls (control_id, control_details) VALUES 
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




-- table for admin
CREATE TABLE admins(
	admin_id int primary key auto_increment,
    admin_type_id int NOT NULL ,
	admin_user_id int unique not null,
    admin_announcement_restriction int not null,
    admin_attendance_restriction int not null,
    admin_locker_restriction int not null,
    admin_notification_restriction int not null,
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
    
	FOREIGN KEY (admin_announcement_restriction) REFERENCES controls(control_id),
	FOREIGN KEY (admin_attendance_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_locker_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_notification_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_offer_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_avail_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_account_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_payment_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_maintenance_restriction) REFERENCES controls(control_id),
    FOREIGN KEY (admin_report_restriction) REFERENCES controls(control_id)
    );



-- INSERT admin
INSERT INTO admins VALUES(
	null,
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'admin'),
    (SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha01') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1)) ,
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    now(),
    now()
);

use gms;
INSERT INTO admins VALUES(
	null,
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'sub-admin'),
    (SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha02') OR (user_email = 'hanz.dumapit54@gmail.com' AND user_email_verified = 1)) ,
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    (SELECT control_id FROM controls WHERE control_details = "Modify"),
    now(),
    now()
);

(SELECT control_id FROM controls WHERE control_details = "Modify");

UPDATE admins 
SET
admin_announcement_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_attendance_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_locker_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_notification_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_offer_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_avail_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_account_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_payment_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_maintenance_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_report_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify")
WHERE admin_id = 3;

UPDATE admins 
SET
admin_announcement_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify")
WHERE admin_user_id = 1;


UPDATE admins 
SET
admin_announcement_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_attendance_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_locker_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_notification_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_offer_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_avail_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_account_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_payment_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_maintenance_restriction = (SELECT control_id FROM controls WHERE control_details = "Modify"),
admin_report_restriction= (SELECT control_id FROM controls WHERE control_details = "Modify")
WHERE admin_id = 3;

 SELECT user_id FROM users WHERE (user_name = BINARY 'Drusha01') OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1);
-- SELECT * admins
SELECT * FROM admins;

SELECT admin_user_id FROM admins
LEFT OUTER JOIN controls as notification_controls ON admins.admin_notification_restriction=notification_controls.control_id
WHERE notification_controls.control_details != 'None';

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

SELECT user_id FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
WHERE user_type_details = 'admin';

-- admin details
SELECT * FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE admin_id =1;



-- admin details
SELECT admin_id, user_id, user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
 user_phone_number, user_email, user_name, user_firstname, user_middlename, user_lastname, user_address,
 user_birthdate, user_valid_id_photo,user_name_verified, user_email_verified,user_phone_verified, user_profile_picture, user_date_created,  user_date_updated,
 announcement_controls.control_details as admin_announcement_restriction_details,
 attendance_controls.control_details as admin_attendance_restriction_details,
 locker_controls.control_details as admin_locker_restriction_details,
 notification_controls.control_details as admin_notification_restriction_details,
 offer_controls.control_details as admin_offer_restriction_details,
 avail_controls.control_details as admin_avail_restriction_details,
 account_controls.control_details as admin_account_restriction_details,
 payment_controls.control_details as admin_payment_restriction_details,
 maintenance_controls.control_details as admin_maintenance_restriction_details,
 report_controls.control_details as admin_report_restriction_details
 FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
LEFT OUTER JOIN controls as announcement_controls ON admins.admin_announcement_restriction=announcement_controls.control_id
LEFT OUTER JOIN controls as attendance_controls ON admins.admin_attendance_restriction=attendance_controls.control_id
LEFT OUTER JOIN controls as locker_controls ON admins.admin_locker_restriction=locker_controls.control_id
LEFT OUTER JOIN controls as notification_controls ON admins.admin_notification_restriction=notification_controls.control_id
LEFT OUTER JOIN controls as offer_controls ON admins.admin_offer_restriction=offer_controls.control_id
LEFT OUTER JOIN controls as avail_controls ON admins.admin_avail_restriction=avail_controls.control_id
LEFT OUTER JOIN controls as account_controls ON admins.admin_account_restriction=account_controls.control_id
LEFT OUTER JOIN controls as payment_controls ON admins.admin_payment_restriction=payment_controls.control_id
LEFT OUTER JOIN controls  as maintenance_controls ON admins.admin_maintenance_restriction=maintenance_controls.control_id
LEFT OUTER JOIN controls as report_controls ON admins.admin_report_restriction=report_controls.control_id
WHERE admin_id = 1
;

-- select all sub admins
SELECT admin_id, user_id,user_name, CONCAT(user_lastname,',',user_firstname,' ',user_middlename) AS user_fullname,user_status_details, user_type_details, user_gender_details, user_phone_contry_code_details, 
 user_phone_number, user_email, user_name, user_firstname, user_middlename, user_lastname, user_address,
 user_birthdate, user_valid_id_photo, user_profile_picture, user_date_created,  user_date_updated,CAST(admin_date_created AS DATE) admin_date_created,
 announcement_controls.control_details as admin_announcement_restriction_details,
 attendance_controls.control_details as admin_attendance_restriction_details,
 locker_controls.control_details as admin_locker_restriction_details,
 notification_controls.control_details as admin_notification_restriction_details,
 offer_controls.control_details as admin_offer_restriction_details,
 avail_controls.control_details as admin_avail_restriction_details,
 account_controls.control_details as admin_account_restriction_details,
 payment_controls.control_details as admin_payment_restriction_details,
 maintenance_controls.control_details as admin_maintenance_restriction_details,
 report_controls.control_details as admin_report_restriction_details
 FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON admins.admin_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
LEFT OUTER JOIN controls as announcement_controls ON admins.admin_announcement_restriction=announcement_controls.control_id
LEFT OUTER JOIN controls as attendance_controls ON admins.admin_attendance_restriction=attendance_controls.control_id
LEFT OUTER JOIN controls as locker_controls ON admins.admin_locker_restriction=locker_controls.control_id
LEFT OUTER JOIN controls as notification_controls ON admins.admin_notification_restriction=notification_controls.control_id
LEFT OUTER JOIN controls as offer_controls ON admins.admin_offer_restriction=offer_controls.control_id
LEFT OUTER JOIN controls as avail_controls ON admins.admin_avail_restriction=avail_controls.control_id
LEFT OUTER JOIN controls as account_controls ON admins.admin_account_restriction=account_controls.control_id
LEFT OUTER JOIN controls as payment_controls ON admins.admin_payment_restriction=payment_controls.control_id
LEFT OUTER JOIN controls  as maintenance_controls ON admins.admin_maintenance_restriction=maintenance_controls.control_id
LEFT OUTER JOIN controls as report_controls ON admins.admin_report_restriction=report_controls.control_id
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

-- table for forgot paass word
CREATE TABLE forgot_password(
	forgot_password_id int primary key	auto_increment,
    forgot_password_email varchar(100) not null,
    forgot_password_hashed varchar(250) not null,
    forgot_password_tried int not null default 0
);

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
WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(email_date_time) ) <=60 AND email_verify_user_id = '9';

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

CREATE TABLE equipment_types(
	equipment_type_id int primary key auto_increment,
    equipment_type_details varchar(50) unique
);

INSERT INTO equipment_types VALUES
(
	null,
    'Machine'
),(
	null,
    'Weights'
),(
	null,
    'Tool'
);

-- table for maintenance
CREATE TABLE equipments(
	equipment_id int primary key auto_increment,
    equipment_name VARCHAR(100) not null,
    equipment_type_id int not null,
    equipment_status_id int not null,
    FOREIGN KEY (equipment_status_id) REFERENCES statuses(status_id),
    FOREIGN KEY (equipment_type_id) REFERENCES equipment_types(equipment_type_id)
);
INSERT INTO equipments (equipment_id, equipment_name, equipment_type_id, equipment_status_id) VALUES
(
	null,
    'TreadMill Machine A',
    (SELECT equipment_type_id FROM equipment_types WHERE equipment_type_details = 'Machine'),
    (SELECT status_id FROM statuses WHERE status_details = 'Active')
);
SELECT equipment_id,equipment_name,equipment_type_details,status_details FROM equipments
LEFT OUTER JOIN equipment_types ON equipments.equipment_type_id=equipment_types.equipment_type_id
LEFT OUTER JOIN statuses ON equipments.equipment_status_id=statuses.status_id
;
UPDATE equipments
SET equipment_status_id = (SELECT status_id FROM statuses WHERE status_details = 'Active')
WHERE equipment_id =1
;


CREATE table remarks(
	remark_id int primary key auto_increment,
    remark_equipment_id int not null,
    remark_equipment_condition_id int not null,
    remark_admin_id int not null,
    remark_time datetime not null,
    remark_remark varchar(50) not null,
    remark_file varchar(50) default null,
	FOREIGN KEY (remark_equipment_condition_id) REFERENCES equipments_conditions(equipment_condition_id),
	FOREIGN KEY (remark_equipment_id) REFERENCES equipments(equipment_id),
	FOREIGN KEY (remark_admin_id) REFERENCES admins(admin_id)
);


INSERT INTO remarks (remark_id, remark_equipment_id, remark_equipment_condition_id, remark_admin_id, remark_time, remark_remark, remark_file) VALUES
(
	null,
    :remark_equipment_id,
	(SELECT equipment_condition_id FROM equipments_conditions WHERE equipment_condition_details = :equipment_condition_details),
    :remark_admin_id,
    now(),
    :remark_remark,
    :remark_file
);


use gms;

SELECT remark_id,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE remark_id = 6

;

SELECT remark_id,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
LEFT OUTER JOIN equipments ON remarks.remark_equipment_id=equipments.equipment_id
LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE remark_equipment_id = 1
ORDER BY remark_time ASC
;

SELECT remark_id,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
LEFT OUTER JOIN equipments ON remarks.remark_equipment_id=equipments.equipment_id
LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE remark_equipment_id = 1
;

SELECT remark_id,equipment_condition_details,remark_remark,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, remark_time FROM remarks 
LEFT OUTER JOIN equipments_conditions ON remarks.remark_equipment_condition_id=equipments_conditions.equipment_condition_id
LEFT OUTER JOIN admins ON remarks.remark_admin_id=admins.admin_id
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE remark_equipment_id = 1
ORDER BY remark_time ASC
LIMIT 1
;




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



-- settings
CREATE TABLE admin_settings(
	setting_id int primary key auto_increment,
	setting_attendance_force_timeout time not null,
    setting_percentage_of_payment_per_day float not null,
    setting_gym_address varchar(255) not null,
    setting_gym_contact_number varchar(20) not null,
    setting_num_of_dates_to_notify int not null,
    setting_gym_email_address varchar(255) not null,
    setting_num_of_lockers int not null,
	setting_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- default settings
INSERT INTO admin_settings (setting_id, setting_attendance_force_timeout,setting_percentage_of_payment_per_day,setting_gym_address,setting_gym_contact_number,setting_num_of_dates_to_notify,setting_gym_email_address,setting_num_of_lockers) VALUES
(
	null,
    '18:00:00',
    .05,
    'San Jose, Zamboanga City',
    '8(800)316-06-42',
    10,
    'kenogymofficial@kenogym.online',
    40
);

SELECT * FROM admin_settings
WHERE setting_id =1;
;

UPDATE admin_settings
set setting_attendance_force_timeout = '18:00'
WHERE setting_id = 1;




CREATE TABLE landing_page_types(
	landing_page_type_id int primary key auto_increment,
    landing_page_type_details VARCHAR(50) unique
);

INSERT INTO landing_page_types (landing_page_type_details) VALUES
(
	'Carousel'
),(
	'Weights Room'
),(
	'Function Room'
);

SELECT landing_page_type_id FROM landing_page_types WHERE landing_page_type_details = 'Carousel';

CREATE TABLE landing_page(
	landing_page_id int primary key auto_increment,
    landing_page_title varchar(50),
    landing_page_file varchar(50),
    landing_page_type_id int not null,
	FOREIGN KEY (landing_page_type_id) REFERENCES landing_page_types(landing_page_type_id)
    
);

-- UPDATE landing_page
-- SET landing_page_title = '',
-- landing_page_file = ''
-- WHERE landing_page_id =;


-- SELECT * FROM landing_page
-- WHERE landing_page_type_id = (SELECT landing_page_type_id FROM landing_page_types WHERE landing_page_type_details = 'Carousel')
-- ;

-- SELECT * FROM landing_page
-- LEFT OUTER JOIN landing_page_types ON landing_page.landing_page_type_id=landing_page_types.landing_page_type_id
-- ;

-- DELETE FROM landing_page WHERE landing_page_id = 17;



-- sample
-- INSERT INTO landing_page  (landing_page_id,landing_page_title,landing_page_file,landing_page_type_id) VALUES
-- (
-- 	null,
--     'something title',
--     'landing_page_file.jpg',
--     (SELECT landing_page_type_id FROM landing_page_types WHERE landing_page_type_details = 'Carousel')
-- );

CREATE TABLE team_positions(
	team_position_id int primary key auto_increment,
    team_position_details VARCHAR(50) unique
);

INSERT INTO team_positions(team_position_details) VALUES
(
	'Gym-Owner'
),(
	'Employee'
);


SELECT team_position_id FROM team_positions WHERE team_position_details = "Gym-Owner";

CREATE TABLE teams(
	team_id int primary key auto_increment,
	team_position_id int not null,
    team_name varchar(255) not null ,
	team_file varchar(255) not null ,
    FOREIGN KEY (team_position_id) REFERENCES team_positions(team_position_id)
);

-- UPDATE teams
-- SET team_position_id =( SELECT team_position_id FROM team_positions WHERE team_position_details = :team_position_details),
-- team_name =:team_name ,
-- team_file =:team_file,
-- WHERE team_id=:team_id;

SELECT * FROM teams
LEFT OUTER JOIN team_positions ON teams.team_position_id=team_positions.team_position_id
 ;






-- annoucement_status
CREATE TABLE announcement_statuses(
	announcement_status_id int primary key auto_increment,
    announcement_status_details varchar(50) unique
);

-- insert for announcement_status
INSERT INTO announcement_statuses (announcement_status_id, announcement_status_details ) VALUES
(
	null,
    'Active'
),(
	null,
    'Disabled'
);
-- SELECT announcement_status_id FROM announcement_statuses WHERE announcement_status_details = 'Active'; 
-- table for announcement_type
CREATE TABLE announcement_types(
	announcement_type_id int primary key auto_increment,
    announcement_type_details varchar(50) unique
);

INSERT INTO announcement_types (announcement_type_id, announcement_type_details ) VALUES
(
	null,
    'Text'
),(
	null,
    'Image'
);

-- SELECT announcement_type_id FROM announcement_types WHERE announcement_type_details = 'Image'; 

-- announcement
CREATE TABLE announcements(
	announcement_id int primary key auto_increment,
    announcement_status_idannouncement_status_id INT NOT NULL,
    announcement_type_id INT NOT NULL,
    announcement_title VARCHAR(50) NOT NULL,
    announcement_content VARCHAR(1024) NOT NULL,
    announcement_file_image VARCHAR(50) DEFAULT 'default.png',
	announcement_order INT NOT NULL DEFAULT 0,
    announcement_start_date DATETIME NOT NULL,
	announcement_end_date DATETIME NOT NULL,
	announcement_date_created datetime default NOW(),
    announcement_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (announcement_status_id) REFERENCES announcement_statuses(announcement_status_id),
    FOREIGN KEY (announcement_type_id) REFERENCES announcement_types(announcement_type_id)
);
-- UPDATE announcements
-- SET announcement_order = 3,
-- announcement_status_id = (SELECT announcement_status_id FROM announcement_statuses WHERE announcement_status_details = 'Disabled')
-- WHERE announcement_id = 15;
-- DELETE FROM announcements
-- WHERE announcement_id = 1;

-- INSERT into announcements (announcement_id, announcement_status_id, announcement_type_id, announcement_title, announcement_content, announcement_file_image, announcement_order, announcement_start_date, announcement_end_date) VALUES
-- ();

-- SELECT count(*)AS number_of_announcements FROM announcements;

-- SELECT announcement_id, announcement_status_details, announcement_type_details, announcement_title, announcement_content, announcement_file_image, announcement_order, announcement_start_date, announcement_start_date, DATE(announcement_end_date) as announcement_end_date,
-- 	announcement_date_created, announcement_date_updated
-- FROM announcements
-- LEFT OUTER JOIN announcement_statuses ON announcements.announcement_status_id=announcement_statuses.announcement_status_id
-- LEFT OUTER JOIN announcement_types ON announcements.announcement_type_id=announcement_types.announcement_type_id
-- ORDER BY announcement_order DESC;

-- down
-- SELECT announcement_id, announcement_order 
-- FROM announcements
-- WHERE announcement_order <= 3
-- ORDER BY announcement_order DESC
-- LIMIT 2;

-- up
-- SELECT announcement_id, announcement_order 
-- FROM announcements
-- WHERE announcement_order >= 1
-- ORDER BY announcement_order ASC
-- LIMIT 2;

-- UPDATE announcements
-- SET announcement_status_id = (SELECT announcement_status_id FROM announcement_statuses WHERE announcement_status_details = :announcement_status_details),
-- announcement_type_id = (SELECT announcement_type_id FROM announcement_types WHERE announcement_type_details = :announcement_type_details),
-- annoucement_title =:annoucement_title,
-- announcement_content=:announcement_content,
-- announcement_file_image=:announcement_file_image,
-- announcement_start_date =:announcement_start_date,
-- announcement_end_date=:announcement_end_date
-- WHERE announcement_id =:announcement_id;


-- SELECT announcement_id, announcement_status_details, announcement_type_details, announcement_title, announcement_content, announcement_file_image, announcement_order, announcement_start_date, announcement_start_date, DATE(announcement_end_date) as announcement_end_date,
-- 	announcement_date_created, announcement_date_updated
-- FROM announcements
-- LEFT OUTER JOIN announcement_statuses ON announcements.announcement_status_id=announcement_statuses.announcement_status_id
-- LEFT OUTER JOIN announcement_types ON announcements.announcement_type_id=announcement_types.announcement_type_id
-- WHERE  announcement_status_details = 'Active' AND CURDATE() < announcement_end_date 
-- ORDER BY announcement_order DESC
-- ;

-- attendance
CREATE TABLE attendances(
	attendance_id int primary key auto_increment,
    attendance_user_id INT NOT NULL,
    attendance_time_in DATETIME NOT NULL DEFAULT NOW(),
    attendance_time_out DATETIME ,
	FOREIGN KEY (attendance_user_id) REFERENCES users(user_id)
);

INSERT attendances (attendance_user_id,attendance_time_in)VALUES (
	10,
    '2023-04-14 14:20:06'
);

SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, '%h:%i %p') as time_in, TIME_FORMAT(attendance_time_out, '%h:%i %p') as time_out,attendance_time_in ,attendance_time_out, NOW() as date_now 
FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE attendance_id = 10 ;

DELETE FROM attendances 
WHERE attendance_id = 4;
UPDATE attendances
SET attendance_time_out = CONCAT(CAST(attendance_time_in AS DATE)," 18:00:00")
WHERE attendance_id = 4;

SELECT * FROM attendances;

SELECT attendance_id,TIME_FORMAT(attendance_time_in, '%h:%i %p') as attendance_time_in,CAST(attendance_time_in AS DATE) AS date_time_in,attendance_time_out  
FROM attendances
WHERE CAST(attendance_time_in AS DATE) = CURDATE() AND attendance_time_out is null;

SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, '%h:%i %p') as time_in, TIME_FORMAT(attendance_time_out, '%h:%i %p') as time_out,attendance_time_in ,attendance_time_out, NOW() as date_now 
FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
ORDER BY attendance_time_in DESC
;
	
SELECT attendance_id,user_id,user_name,CAST(attendance_time_in AS DATE) AS date_time_in,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname, TIME_FORMAT(attendance_time_in, '%h:%i %p') as time_in, TIME_FORMAT(attendance_time_out, '%h:%i %p') as time_out,attendance_time_in ,attendance_time_out, NOW() as date_now 
FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE attendance_user_id = 10 
ORDER BY attendance_time_in DESC
;
SELECT attendance_id,TIME_FORMAT(attendance_time_in, '%h:%i %p') as attendance_time_in,CAST(attendance_time_in AS DATE) AS date_time_in,attendance_time_out  
FROM attendances
WHERE CAST(attendance_time_in AS DATE) = CURDATE();
;
-- table for lockers
CREATE TABLE lockers(
	locker_id int primary key auto_increment,
    locker_subscription_id int not null,
    locker_UID int unique not null ,
	FOREIGN KEY (locker_subscription_id) REFERENCES subscriptions(subscription_id)
);


INSERT INTO lockers (locker_id,locker_subscription_id,locker_UID) VALUES
(
	1,
    23,
    1
);
SELECT * FROM lockers;

DELETE FROM lockers
WHERE locker_id = 1;

SELECT locker_id,locker_UID,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date FROM lockers
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=lockers.locker_subscription_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
WHERE  subscription_status_details = 'Active' AND user_id =10
ORDER BY locker_UID;

SELECT locker_id,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name FROM lockers
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=lockers.locker_subscription_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
WHERE  locker_id =10;

-- SELECT locker_id,locker_UID FROM lockers
-- WHERE locker_subscription_id =:locker_subscription_id;

SELECT subscription_id,user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end 
FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
WHERE (subscription_status_details = "Active" AND type_of_subscription_details = "Locker Subscription" AND user_id = 10)
ORDER by subscription_start_date DESC
;


-- forgot password
CREATE TABLE forgot_password(
	forgot_password_id int primary key auto_increment,
    forgot_password_user_id int not null,
    forgot_password_hashed varchar(100) not null,
    forgot_password_date_time DATETIME default NOW(),
    FOREIGN KEY (forgot_password_user_id) REFERENCES users(user_id)
);
INSERT INTO forgot_password(forgot_password_user_id,forgot_password_hashed) VALUES
(
	3,
    'sdfasdfsaf'
);


SELECT  forgot_password_id,forgot_password_user_id,UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(forgot_password_date_time) as seconds,forgot_password_hashed FROM forgot_password
WHERE (UNIX_TIMESTAMP(now()) -UNIX_TIMESTAMP(forgot_password_date_time) ) <=60*15 AND forgot_password_user_id= 6 
ORDER BY forgot_password_date_time DESC
LIMIT 1;


CREATE TABLE notification_types(
	notification_type_id int primary key auto_increment,
    notification_type_details varchar(50) unique
);

INSERT INTO notification_types (notification_type_details)  VALUES
(
	'Avail'
),(
	'Cancel'
),(
	'Renew'
),(
	'Partial'
),(
	'Payment'
),(
	'Activate'
),(
	'Trainer'
),(
	'Expiration'
),(
	'Unpaid'
),(
	'Overdue'
),(
	'Logs'
),(
	'Locker'
),(
	'Activated'
);

SELECT notification_type_id FROM notification_types WHERE notification_type_details = 'Avail';


CREATE TABLE notification_icons(
	notification_icon_id int primary key auto_increment,
    notification_icon_details varchar(50) unique
);

INSERT INTO notification_icons (notification_icon_details) VALUES
(
	'avail.png'
),(
	'cancelled.png'
),(
	'renew.png'
),(
	'partial.png'
),(
	'payment.png'
),(
	'activated.png'
),(
	'trainer.png'
),(
	'trainer_not.png'
),(
	'change.png'
),(
	'choose.png'
),(
	'expiration.png'
),(
	'unpaid.png'
),(
	'overdue.png'
),(
	'verified.png'
),(
	'logs.png'
),(
	'locker.png'
),(
	'account.png'
);

SELECT notification_icon_id FROM notification_icons WHERE notification_icon_details = 'avail.png';

CREATE TABLE notifications(
	notification_id int primary key auto_increment,
	notification_creator int not null,
	notification_target int not null,
	notification_type_id int not null,
	notification_icon_id int not null,
	notification_info varchar(255) not null,
	notification_is_read bool not null default 0,
    notification_date_created datetime default NOW(),
    notification_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (notification_creator) REFERENCES users(user_id),
    FOREIGN KEY (notification_target) REFERENCES users(user_id),
    FOREIGN KEY (notification_type_id) REFERENCES notification_types(notification_type_id),
    FOREIGN KEY (notification_icon_id) REFERENCES notification_icons(notification_icon_id)
);

INSERT INTO notifications (notification_id,notification_creator,notification_target,notification_type_id,notification_icon_id,notification_info,notification_is_read,notification_date_created,notification_date_updated) VALUES
(
	null,
    2,
    4,
    (SELECT notification_type_id FROM notification_types WHERE notification_type_details = 'Avail'),
    (SELECT notification_icon_id FROM notification_icons WHERE notification_icon_details = 'avail.png'),
    'Customer XXXXX has availed gym-use, trainer, locker, and program.',
    0
);




SELECT * FROM notifications ;
-- receiver of notification
SELECT count(notification_is_read)as number_of_notification FROM notifications 
WHERE notification_target = 6 AND notification_is_read = 0
ORDER BY notification_date_created DESC;


UPDATE notifications 
SET notification_is_read = false
WHERE notification_target = 7;
-- receiver
SELECT notification_id,notification_icon_details,notification_type_details,notification_date_created,notification_date_updated,notification_info,notification_is_read FROM notifications 
LEFT OUTER JOIN notification_types ON notification_types.notification_type_id=notifications.notification_type_id
LEFT OUTER JOIN notification_icons ON notification_icons.notification_icon_id=notifications.notification_icon_id
WHERE notification_target = 6 AND notification_is_read = 0
ORDER BY notification_date_created DESC
LIMIT 3
;

UPDATE notifications 
SET notification_is_read = true
WHERE notification_id = 1;

DELETE FROM notifications WHERE notification_id = 150;

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



CREATE TABLE subscriber_trainers(
	subscriber_trainers_id int primary key auto_increment ,
    subscriber_trainers_subscriber_id int not null,
    subscriber_trainers_trainer_id int not null,
    subscriber_trainers_subscription_id int not null,
    FOREIGN KEY (subscriber_trainers_subscriber_id) REFERENCES users(user_id),
    FOREIGN KEY (subscriber_trainers_trainer_id) REFERENCES trainers(trainer_id),
    FOREIGN KEY (subscriber_trainers_subscription_id) REFERENCES subscriptions(subscription_id)
);

SELECT CONCAT(user_lastname,", ",user_firstname," ",user_middlename) as user_fullname,subscriber_trainers_subscriber_id FROM subscriber_trainers 
LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
LEFT OUTER JOIN users ON users.user_id=trainers.trainer_user_id
LEFT OUTER JOIN subscriptions ON subscriptions.subscription_id=subscriber_trainers.subscriber_trainers_subscription_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE subscriber_trainers_trainer_id = 4 AND  subscription_status_details = 'Active';




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
),(
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

SELECT walk_in_id,CONCAT(u.user_lastname,", ",u.user_firstname," ",u.user_middlename) AS user_fullname, walk_in_service_details, walk_in_date,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS trainer_fullname FROM walk_ins
LEFT OUTER JOIN users as u ON walk_ins.walk_in_user_id=u.user_id
LEFT OUTER JOIN walk_in_services ON walk_ins.walk_in_service_id=walk_in_services.walk_in_service_id
LEFT OUTER JOIN trainers ON walk_ins.walk_in_trainer_id=trainers.trainer_id
LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
WHERE walk_in_id = 1;
;



CREATE TABLE payment_types(
	payment_type_id int primary key auto_increment,
    payment_type_details varchar(50) unique
);

INSERT INTO payment_types (payment_type_details) VALUES
(
	'Partial Payment'
),(
	'Full Payment'
),(
	'Void Payment'
),(
	'Discount Payment'
);

(SELECT payment_type_id FROM payment_types WHERE payment_type_details="Paid");
CREATE TABLE payments(
	payment_id int primary key auto_increment ,
    payment_amount float not null,
    payment_subscription_id int not null,
    payment_type_id int not null,
    payment_date datetime default NOW(),
    FOREIGN KEY (payment_subscription_id) REFERENCES subscriptions(subscription_id),
    FOREIGN KEY (payment_type_id) REFERENCES payment_types(payment_type_id)
);
use gms;
SELECT * FROM payments
LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
;

-- payment history of subscriber
SELECT payment_id,type_of_subscription_details,payment_amount,payment_type_details,payment_date FROM payments
LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
ORDER BY payment_date DESC
;

-- reports
SELECT payment_id,type_of_subscription_details,subscription_offer_name,payment_amount,payment_type_details,payment_date,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name 
FROM payments
LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
LEFT OUTER JOIN users  ON users.user_id=subscriptions.subscription_subscriber_user_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
ORDER BY payment_date DESC
;
 
SELECT distinct (user_id),CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name FROM payments
LEFT OUTER JOIN payment_types  ON payment_types.payment_type_id=payments.payment_type_id
LEFT OUTER JOIN subscriptions  ON subscriptions.subscription_id=payments.payment_subscription_id
LEFT OUTER JOIN users  ON users.user_id=subscriptions.subscription_subscriber_user_id
ORDER BY payment_date DESC
;




INSERT INTO payments (payment_id,payment_amount,payment_subscription_id,payment_type_id,payment_date) VALUES
(
	null,
	800,
	30,
	(SELECT payment_type_id FROM payment_types WHERE payment_type_details = "Paid" ),
	NOW()
);




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

-- activate pending sub at date
UPDATE subscriptions 
SET subscription_start_date ='2023-4-20' , 
subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Active")
WHERE  (subscription_subscriber_user_id = 8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = "Pending"))
;

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

SELECT distinct user_name,subscription_status_details FROM subscriptions 
LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
;

-- ------------------------------------------------------------------------------------------------------------------------------------------------

-- attendance
SELECT distinct user_name from users 
LEFT OUTER JOIN subscriptions ON users.user_id=subscriptions.subscription_subscriber_user_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE subscription_status_details = 'Active' ;  

-- selecting non subscribers
SELECT distinct user_name,
CASE WHEN subscription_status_details = 'Active' THEN '0'
 WHEN subscription_status_details = 'Pending' THEN '0'
ELSE '1'
END AS sub
 from users 
LEFT OUTER JOIN subscriptions ON users.user_id=subscriptions.subscription_subscriber_user_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id

;

SELECT distinct user_name
 from users 
LEFT OUTER JOIN subscriptions ON users.user_id=subscriptions.subscription_subscriber_user_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id

;

SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
            subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
            LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
            LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
            WHERE (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Pending") OR (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Active")
            ;

SELECT distinct user_name from users 
WHERE EXISTS
(SELECT subscription_subscriber_user_id FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
 WHERE subscription_status_details ='Active' );

-- ------------------------------------------------------------------------------------------------------------------------------------------------
-- activation / making it active
UPDATE subscriptions 
SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active')
WHERE  (subscription_subscriber_user_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'));

-- deletion of active and pending subs
UPDATE subscriptions 
SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Deleted')
WHERE  (subscription_subscriber_user_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'));

-- deleting pending subs
UPDATE subscriptions 
SET subscription_start_date = now(), subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Deleted')
WHERE  (subscription_id =8 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'));


(SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active' );

-- selecting all
SELECT distinct subscription_subscriber_user_id, CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_name, subscription_subscriber_user_id,subscription_start_date FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN users ON subscriptions.subscription_subscriber_user_id=users.user_id
WHERE subscription_status_details = 'Active' OR  subscription_status_details = 'Pending' OR  subscription_status_details = '' OR  subscription_status_details = '' OR  subscription_status_details = ''
ORDER BY subscription_start_date DESC
;
(SELECT user_id FROM users WHERE user_name = BINARY 'Drusha01');

-- pending and active of customer
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Pending') OR (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Active')
;

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

-- --------------------------- test ---------------------------------------
-- dashboard Sales & Revenue
SELECT DISTINCT YEAR(subscription_start_date )AS YEAR FROM subscriptions
;

SELECT SUM(subscription_paid_amount)as Sales_Revenue FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE YEAR(subscription_start_date ) = '2023';

-- dashboard Status of Subscriptions

SELECT user_id FROM users WHERE user_name = 'Hanrickson11';

SELECT DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions;

SELECT  subscription_id,((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due)as balance,subscription_paid_amount FROM subscriptions
WHERE ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount + subscription_penalty_due) -subscription_paid_amount <=0 AND subscription_subscriber_user_id =11
;


UPDATE subscriptions 
SET subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active')
WHERE  (subscription_subscriber_user_id =11 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed'));

UPDATE subscriptions 
SET subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed')
WHERE  subscription_id = 24 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active');

UPDATE subscriptions 
SET subscription_start_date=  (SELECT DATE_ADD(NOW(), INTERVAL -84 DAY)  ) 
WHERE  (subscription_subscriber_user_id =11 AND subscription_status_id = (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'));
-- --------------------------- test ---------------------------------------
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

SELECT count(case subscription_status_details when 'Program Subscription' then 1 else null end)as program_subscriptions_count FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active' OR subscription_status_details = 'Completed' ;

SELECT *,DATE(walk_in_date) FROM walk_ins;
-- dashboard walkins
SELECT count(walk_in_id)as number_of_walkins,DATE(walk_in_date) as walk_in_date,DATE_FORMAT (DATE(walk_in_date), '%W') as walk_in_day FROM walk_ins
WHERE DATE(walk_in_date) >= current_date - interval '7' day
GROUP BY DATE(walk_in_date)
ORDER BY walk_in_date ASC;
;


SELECT * FROM payments
ORDER BY payment_date DESC
;
-- report subscriptions
select DATE(subscription_start_date) as subscription_start_date,sum(1*subscription_quantity) as subscription_count_per_day,
sum(case type_of_subscription_details when 'Program Subscription' then 1*subscription_quantity else null end)as program_subscriptions_count,
sum(case type_of_subscription_details when 'Gym Subscription' then 1*subscription_quantity else null end)as gym_subscriptions_count,
sum(case type_of_subscription_details when 'Locker Subscription' then 1*subscription_quantity else null end)as locker_subscriptions_count,
sum(case type_of_subscription_details when 'Trainer Subscription' then 1*subscription_quantity else null end) as trainer_subscriptions_count
from subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active' OR subscription_status_details = 'Completed' 
GROUP BY DATE(subscription_start_date)
ORDER BY subscription_start_date ASC;

-- report subscriptions
select DATE(subscription_start_date) as subscription_start_date,sum(1*subscription_quantity) as subscription_count_per_day,
sum(case type_of_subscription_details when 'Program Subscription' then 1*subscription_quantity else null end)as program_subscriptions_count,
sum(case type_of_subscription_details when 'Gym Subscription' then 1*subscription_quantity else null end)as gym_subscriptions_count,
sum(case type_of_subscription_details when 'Locker Subscription' then 1*subscription_quantity else null end)as locker_subscriptions_count,
sum(case type_of_subscription_details when 'Trainer Subscription' then 1*subscription_quantity else null end) as trainer_subscriptions_count
from subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_status_details = 'Active' AND (DATE(subscription_start_date) >= current_date - interval '7' day)) OR (subscription_status_details = 'Completed' AND (DATE(subscription_start_date) >= current_date - interval '7' day))
GROUP BY DATE(subscription_start_date)
ORDER BY subscription_start_date DESC;

-- report most availed offer
SELECT subscription_offer_name,sum(subscription_quantity) as subscription_quantity FROM subscriptions 
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE subscription_status_details = 'Active' OR subscription_status_details = 'Completed' 
GROUP BY subscription_offer_name;

-- report most availed over with limit
SELECT *,subscription_offer_name,sum(subscription_quantity)FROM subscriptions 

LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_status_details = 'Active' AND (DATE(subscription_start_date) >= current_date - interval '15' day)) OR (subscription_status_details = 'Completed' AND (DATE(subscription_start_date) >= current_date - interval '15' day))
GROUP BY subscription_offer_name
ORDER BY DATE(subscription_start_date)
;

 CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS user_fullname;
SELECT * FROM attendances;

;

-- report most frequent customer ?ASD?asd?ASD?
SELECT DATE(attendance_time_out) as attendance_date,attendance_user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,count(attendance_id),(sum(UNIX_TIMESTAMP(attendance_time_out)-UNIX_TIMESTAMP(attendance_time_in))/3600) as time_attended_in_hours,
sum(UNIX_TIMESTAMP(attendance_time_out)-UNIX_TIMESTAMP(attendance_time_in)) as time_attended_in_seconds
 FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE DATE(attendance_time_out) >= current_date - interval '15' day
GROUP BY attendance_user_id
ORDER BY time_attended_in_seconds DESC;

-- report most frequent customer
SELECT DATE(attendance_time_out) as attendance_date,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,
user_id,
UNIX_TIMESTAMP(attendance_time_out)-UNIX_TIMESTAMP(attendance_time_in) as time_attended_in_seconds,
(UNIX_TIMESTAMP(attendance_time_out)-UNIX_TIMESTAMP(attendance_time_in))/3600 as time_attended_in_hours
 FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE DATE(attendance_time_out) >= current_date - interval '15' day
ORDER BY time_attended_in_seconds DESC;

SELECT distinct date(attendance_time_out) FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE DATE(attendance_time_out) >= current_date - interval '30' day;

SELECT distinct user_id,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM attendances
LEFT OUTER JOIN users ON users.user_id=attendances.attendance_user_id
WHERE DATE(attendance_time_out) >= current_date - interval '30' day;;
;
count(subscriber_trainers_id),CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS user_fullname,;

-- report most availed trainer
SELECT count(subscriber_trainers_id)as subscriber_trainers_id,CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS user_fullname,count(subscriber_trainers_trainer_id)as subscriber_trainers_trainer_count 
FROM subscriber_trainers
LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
LEFT OUTER JOIN subscriptions  ON subscriber_trainers.subscriber_trainers_subscription_id=subscriptions.subscription_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE (subscription_status_details = 'Active' AND (DATE(subscription_start_date) >= current_date - interval '15' day)) OR (subscription_status_details = 'Completed' AND (DATE(subscription_start_date) >= current_date - interval '15' day))
GROUP BY subscriber_trainers_trainer_id
ORDER BY DATE(subscription_start_date) ASC
;



SELECT *,DATE(subscription_start_date),CONCAT(tr_u.user_lastname,", ",tr_u.user_firstname," ",tr_u.user_middlename) AS user_fullname,user_name FROM subscriber_trainers
LEFT OUTER JOIN trainers ON trainers.trainer_id=subscriber_trainers.subscriber_trainers_trainer_id
LEFT OUTER JOIN users as tr_u ON trainers.trainer_user_id=tr_u.user_id
LEFT OUTER JOIN subscriptions  ON subscriber_trainers.subscriber_trainers_subscription_id=subscriptions.subscription_id
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE subscription_status_details = 'Active' OR subscription_status_details = 'Completed' AND (DATE(subscription_start_date) >= current_date - interval '5' day)
;
-- payment 
SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_offer_name, subscription_duration, subscription_price, subscription_total_duration, 
subscription_date_created,subscription_date_updated,subscription_discount,subscription_penalty_due,subscription_paid_amount FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE  (subscription_subscriber_user_id =8 AND  subscription_status_details = 'Active')
;



SELECT * FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE subscription_status_details = 'Completed';

-- full payment
UPDATE subscriptions 
SET subscription_paid_amount =  ((subscription_quantity*subscription_price * (subscription_total_duration / subscription_duration )) - subscription_discount - subscription_paid_amount + subscription_penalty_due)
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
WHERE subscription_status_details = 'Completed' AND subscription_subscriber_user_id = 11
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

-- active user
SELECT distinct user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname,user_password_hashed FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
WHERE  subscription_status_details = 'Active' AND user_id = 8
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

SELECT user_id,user_name,CONCAT(user_lastname,", ",user_firstname," ",user_middlename) AS user_fullname FROM subscriptions
LEFT OUTER JOIN users ON users.user_id=subscriptions.subscription_subscriber_user_id
WHERE subscription_id =;

SELECT SUM(subscription_paid_amount)as Sales_Revenue FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
WHERE YEAR(subscription_start_date ) = 2023 AND (subscription_status_details = 'Active'  OR subscription_status_details = 'Completed') ;

-- dashboard Status of Subscriptions
SELECT count(case subscription_status_details when 'Active' then 1 else null end)as active_subscriptions,count(case subscription_status_details when 'Deleted' then 1 else null end)as deleted_subscriptions,
count(case subscription_status_details when 'Pending' then 1 else null end)as pending_subscriptions,count(case subscription_status_details when 'Terminated' then 1 else null end)as terminated_subscriptions,
count(case subscription_status_details when 'Completed' then 1 else null end)as completed_subscriptions
FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id;

DELETE FROM subscriptions WHERE subscription_subscriber_user_id =(SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02');

(SELECT user_id FROM users WHERE user_name = BINARY 'RobRoche');

SELECT MONTH(DATE_ADD(MONTH, -1, CURRENT_TIMESTAMP));

SELECT  CURDATE();


SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Pending") OR (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Active")
;

SELECT subscription_id,subscription_status_details ,subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id,type_of_subscription_details, subscription_duration, subscription_price, subscription_total_duration, 
subscription_start_date,DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY) AS subscription_end_date,subscription_date_created,subscription_date_updated,DATEDIFF(DATE_ADD(subscription_start_date, INTERVAL subscription_total_duration  DAY), NOW()) as subscription_days_to_end FROM subscriptions
LEFT OUTER JOIN subscription_status ON subscription_status.subscription_status_id=subscriptions.subscription_status_id
LEFT OUTER JOIN type_of_subscriptions ON type_of_subscriptions.type_of_subscription_id=subscriptions.subscription_type_of_subscription_id
WHERE (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Pending") OR (subscription_subscriber_user_id = :user_id AND  subscription_status_details = "Active")
;