use gms;

INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES
(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'active'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827000',
    'andre.que@gmail.com',
    'Andre01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Andre',
    'Julkarin',
    'Que',
	'',
    ('2001-02-12'),
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
    '09265827001',
    'Al-khayzel.sali@gmail.com',
    'Khay01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Al-khayzel',
    'Abdulla',
    'Sali',
	'',
    ('2001-02-12'),
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
    '09265827002',
    'Daph.Nagata@gmail.com',
    'Daph01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Daph',
    'Dubibudaphdaph',
    'Nagata',
	'',
    ('2001-02-12'),
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
    'Charity_Emmanuel@gmail.com',
    'Charity01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Charity',
    'Cha',
    'Emmanuel',
	'user address',
    ('2001-02-12'),
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
    'Khasmir.Basaluddin@gmail.com',
    'Khas01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Khasmir',
    '',
    'Basaluddin',
	'user address',
    ('2001-02-12'),
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
    '09265827005',
    'Kent.Adlawan@gmail.com',
    'Kent01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Kent',
    '',
    'Adlawan',
	'user address',
    ('2001-02-12'),
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
    '09265827006',
    'Sidrick.Cadungog@gmail.com',
    'Sidrick01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Sidrick',
    '',
    'Cadungog',
	'user address',
    ('2001-02-12'),
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
    '09265827008',
    'Vinczar_Jailani@gmail.com',
    'Vinczar01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Vinczar',
    'Raveche',
    'Jailani',
	'user address',
    ('2001-02-12'),
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
    '09265827009',
    'Bennett_Chan@gmail.com',
    'Bennett01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Bennett',
    '',
    'Chan',
	'',
    ('2001-02-12'),
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
    '09265827010',
    'Sherinata.Said@gmail.com',
    'Sheri01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Sherinata',
    '',
    'Said',
	'user address',
    ('2001-02-12'),
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
    '09265827011',
    'Bushra.Adjaluddin@gmail.com',
    'Bushra01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Bushra',
    '',
    'Adjaluddin',
	'user address',
    ('2001-02-12'),
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
    '09265827012',
    'Darshell_Amsain@gmail.com',
    'Darsh01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Darshell',
    '',
    'Amsain',
	'user address',
    ('2001-02-12'),
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
    '09265827013',
    'Peter.Valdahuesa@gmail.com',
    'Peter01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Peter',
    '',
    'Valdahuesa',
	'',
    ('2001-02-12'),
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
    '09265827014',
    'Aldasher.Tawasil@gmail.com',
    'Dasher01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Aldasher',
    '',
    'Tawasil',
	'',
    ('2001-02-12'),
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
    '09265827015',
    'Jaydee_Ballaho@gmail.com',
    'Jaydee01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Jaydee',
    '',
    'Ballaho',
	'user address',
    ('2001-02-12'),
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
    '09265827016',
    'Hannazelle.dumapit56@gmail.com',
    'Hannazelle01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hannazelle',
    'Etrone',
    'Dumapit',
	'user address',
    ('2001-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);


INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    1,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Jaydee01'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Gym Subscription'),
    30,
    800,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'),
    NOW()
);



INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Jaydee01'),
    '1-Month Locker-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    100,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'),
    NOW()
);
INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Jaydee01'),
    '1-Month Trainer-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Trainer Subscription'),
    30,
    1500,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'),
    NOW()
);

INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Jaydee01'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    100,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Terminated'),
    NOW()
);


-- 1-Month Gym-Use(21 and Above)

-- 2-Months Gym-Use

-- 3-Months Gym-Use

-- 1-Month Locker-Use

-- 2-Months Locker-Use

-- 3-Months Locker-Use

-- 1-Month Trainer

-- 2-Months Trainer

-- 3-Month Trainer

-- 1-Month Zumba

-- Walk-In Gym-Use

-- Walk-In Trainer
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

INSERT INTO offers   (offer_id, offer_name, offer_status_id, offer_type_of_subscription_id, offer_age_qualification_id, offer_duration, offer_slots, offer_price,offer_file,offer_description)VALUES
(
	null,
    'Walk-In Gym-Use',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Walk-In Gym Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    1,
    'None',
    100.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
),(
	null,
    'Walk-In Trainer-Use',
    (SELECT status_id FROM statuses WHERE status_details= 'active'),
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details=  'Walk-In Trainer Subscription'),
    (SELECT age_qualification_id FROM age_qualifications WHERE age_qualification_details= 'None'),
    1,
    'None',
    150.00,
    'offer_default.jpg',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
);

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

select COUNT(*) FROM users WHERE user_status_id= (SELECT user_status_id FROM user_status WHERE user_status_details = 'active');

select COUNT(*) as number_of_users FROM users;
SELECT *  FROM users
LIMIT 0,10
;

SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02';
INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    1,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Gym Subscription'),
    30,
    800,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'),
    NOW()
);


INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    1,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha03'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Gym Subscription'),
    30,
    800,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Active'),
    NOW()
);



INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02'),
    '1-Month Locker-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    100,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Pending'),
    NOW()
);
INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha03'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Gym Subscription'),
    30,
    1500,
    30,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed'),
    (SELECT DATE_ADD(NOW(), INTERVAL -35 DAY)  ) 
);

INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha02'),
    '1-Month Gym-Use(21 and Above)',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    100,
    90,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Terminated'),
    (SELECT DATE_ADD(NOW(), INTERVAL -84 DAY)  ) 
);

