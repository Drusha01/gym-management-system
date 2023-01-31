<?php 
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';
$userObj = new Users();

// set attributes
$userObj->setuser_name('Drusha01');
$userObj->setuser_firstname('Hanrickson');
$userObj->setuser_lastname('Dumapit');
$userObj->setuser_email('hanz.dumapit54@gmail.com');
$userObj->setuser_phone_number('9265827343');
$userObj->setuser_gender_details('Male');
$userObj->setuser_birthdate('2000/08/31');
$userObj->setuser_password_hashed(password_hash('Uwat09hanz@2', PASSWORD_ARGON2I));


if(!$userObj->user_duplicateAll()){
    echo '0';
}else{
    echo '1';
}
// check for duplicates
echo $userObj->getuser_name();
echo '<br>';
echo $userObj->getuser_firstname();
echo '<br>';
echo $userObj->getuser_lastname();
echo '<br>';
echo $userObj->getuser_email();
echo '<br>';
echo $userObj->getuser_phone_number();
echo '<br>';
echo $userObj->getuser_gender_details();
echo '<br>';
echo $userObj->getuser_birthdate();
echo '<br>';
echo $userObj->getuser_password_hashed();
echo '<br>';




?>