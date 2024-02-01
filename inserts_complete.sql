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
    (SELECT DATE_ADD(NOW(), INTERVAL -120 DAY)  ) 
);

INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha03'),
     '1-Month Locker-Use',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    200.00,
    30,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed'),
    (SELECT DATE_ADD(NOW(), INTERVAL -120 DAY)  ) 
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
    (SELECT DATE_ADD(NOW(), INTERVAL -86 DAY)  ) 
);

INSERT INTO subscriptions (subscription_id, subscription_quantity, subscription_subscriber_user_id, subscription_offer_name, subscription_type_of_subscription_id, subscription_duration, subscription_price, subscription_total_duration, 
subscription_status_id, subscription_start_date)VALUES (
	null,
    2,
    (SELECT user_id FROM users WHERE user_name = BINARY 'Drusha03'),
     '1-Month Locker-Use',
    (SELECT type_of_subscription_id FROM type_of_subscriptions WHERE type_of_subscription_details ='Locker Subscription'),
    30,
    200.00,
    30,
    (SELECT subscription_status_id FROM subscription_status WHERE subscription_status_details = 'Completed'),
    (SELECT DATE_ADD(NOW(), INTERVAL -120 DAY)  ) 
);