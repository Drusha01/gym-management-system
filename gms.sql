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

INSERT into user_types VALUES
(	
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
    user_phone_number VARCHAR(15) unique  NOT NULL,
    user_email_verified BOOL DEFAULT NULL,
    user_phone_verified BOOL DEFAULT NULL,
    user_email VARCHAR(255) unique  NOT NULL,
    user_name VARCHAR(255) unique  NOT NULL,
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
user_name,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827342',
    'hanz.dumapit53@gmail.com',
    true,
    'Drusha01',
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    (CURDATE()),
    'default.png',
    'default.png',
    now(),
	now()
    
);

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827343',
    'hanz.dumapit54@gmail.com',
    'Drusha02',
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    (CURDATE()),
    'default.png',
    'default.png',
    now(),
	now()
    
);

-- insert for users
INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827345',
    'hanz.dumapit56@gmail.com',
    'Drusha03',
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    (CURDATE()),
    'default.png',
    'default.png',
    now(),
	now()
    
);

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827344',
    'hanz.dumapit55@gmail.com',
    'Drusha04',
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    (CURDATE()),
    'default.png',
    'default.png',
    now(),
	now()
    
);


-- SELECT * users
SELECT * FROM users;

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

-- select user details
SELECT user_id,user_status_details,user_type_details,user_gender_details,user_phone_contry_code_details,user_phone_number,user_email,
user_name,user_firstname,user_middlename,user_lastname,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated FROM users
LEFT OUTER JOIN user_status ON users.user_status_id=user_status.user_status_id
LEFT OUTER JOIN user_types ON users.user_type_id=user_types.user_type_id
LEFT OUTER JOIN user_genders ON users.user_gender_id=user_genders.user_gender_id
LEFT OUTER JOIN user_phone_country_code ON users.user_status_id=user_phone_country_code.user_phone_country_code_id
WHERE user_id = 1;

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


-- table for admin
CREATE TABLE admins(
	admin_id int primary key auto_increment,
    admin_type_id int NOT NULL ,
	admin_user_id int unique,
    admin_date_created datetime,
    admin_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_type_id) REFERENCES user_types(user_type_id),
    FOREIGN KEY (admin_user_id) REFERENCES users(user_id)
);

-- INSERT admin
INSERT INTO admins VALUES(
	null,
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'admin'),
    3,
    now(),
    now()
);

-- SELECT * admins
SELECT * FROM admins;

-- admin login
SELECT admin_id,admin_user_id,user_password_hashed FROM admins
LEFT OUTER JOIN users ON admins.admin_user_id=users.user_id
WHERE user_name = BINARY 'Drusha03' OR (user_email =  'hanz.dumapit56@gmail.com' AND user_email_verified = 1) ; 

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
WHERE admin_id =1;
        
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
    'None'
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
    offer_price float,
    FOREIGN KEY (offer_status_id) REFERENCES statuses(status_id),
    FOREIGN KEY (offer_age_qualification_id) REFERENCES age_qualifications(age_qualification_id),
    FOREIGN KEY (offer_type_of_subscription_id) REFERENCES type_of_subscriptions(type_of_subscription_id)
    
);

-- inserts for offers
INSERT INTO offers VALUES
(
	null,
    '1-Month Gym-Use(21 and Above)',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    30,
    'None',
    800.00
),(
	null,
    '1-Month Trainer',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Trainer Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    'None',
    1500.00
),(
	null,
    '1-Month Locker',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Locker Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    30,
    'None',
    100.00
),(
	null,
    'Zumba',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Program Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    30,
    45,
    500.00
),(
	null,
    'Samba',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Program Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    30,
    45,
    500.00
);

INSERT INTO offers VALUES
(
	null,
    '1-Month Gym-Use(21 and Above)',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details= 'Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= '21 above'),
    30,
    'None',
    800.00
);




SELECT * FROM offers;

-- select all offers
SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price FROM offers
LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
WHERE status_details ='active'
;

-- select offer with id
SELECT offer_id,offer_name,status_details,type_of_subscription_details,age_qualification_details,offer_duration,offer_slots,offer_price FROM offers
LEFT OUTER JOIN statuses ON offers.offer_status_id=statuses.status_id
LEFT OUTER JOIN age_qualifications ON offers.offer_age_qualification_id=age_qualifications.age_qualification_id
LEFT OUTER JOIN type_of_subscriptions ON offers.offer_type_of_subscription_id=type_of_subscriptions.type_of_subscription_id
WHERE offer_id = 1 AND status_details ='active'
;

-- soft delete for offer
UPDATE offers
SET offer_status_id = (SELECT status_id FROM statuses WHERE status_details= 'deleted')
WHERE offer_id = 69
; 
 -- count offers
SELECT COUNT(*) FROM offers;


-- table for subscriptions
-- CREATE TABLE subscriptions(
-- 	
-- );




SELECT  CURDATE();
