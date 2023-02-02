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



// -- start of test statements

echo dirname(__DIR__, 1);
echo '<br>';
echo dirname(__DIR__, 1).'/img/profile';
echo '<br>';

if (isset($_FILES['valid_id'])) {
  $valid_id = false;
  $type = array('png', 'bmp', 'jpg');
  $size = (1024 * 1024) * 5; // 2 mb
  if (validate_file($_FILES, 'valid_id', $type, $size)) {
    $valid_id_dir = dirname(__DIR__, 1) . '/img/valid-id/';
    // check if the folder exist  
    if(!is_dir($valid_id_dir)){
      // create directory
      mkdir($valid_id_dir);
    }
    $extension = getFileExtensionfromFilename($_FILES['valid_id']['name']);
    $filename = md5($_FILES['valid_id']['name']).'.'.$extension;
    $counter = 0;
    // only move if the filename is unique
    while(is_dir($filename)){
      $counter++;
      $filename = md5($_FILES['valid_id']['name']).$counter.'.'.$extension;
    }
    // move file
    if (move_uploaded_file($_FILES['valid_id']['tmp_name'],$valid_id_dir.$filename )) {
      echo 'moved';
      // resize file?
    }
  }
}
if (isset($_FILES['profilepic'])) {
  $profile_pic = false;
  $type = array('png', 'bmp', 'jpg');
  $size = (1024 * 1024) * 5; // 2 mb
  if (validate_file($_FILES, 'profilepic', $type, $size)) {
    $profilepic_dir = dirname(__DIR__, 1) . '/img/profile/';
    // check if the folder exist  
    if(!is_dir($profilepic_dir)){
      // create directory
      mkdir($profilepic_dir);
    }
    $extension = getFileExtensionfromFilename($_FILES['profilepic']['name']);
    $filename = md5($_FILES['profilepic']['name']).'.'.$extension;
    $counter = 0;
    // only move if the filename is unique
    while(is_dir($filename)){
      $counter++;
      $filename = md5($_FILES['profilepic']['name']).$counter.'.'.$extension;
    }
    // move file
    if (move_uploaded_file($_FILES['profilepic']['tmp_name'],$profilepic_dir.$filename )) {
      echo 'moved';
      // resize file?

      // resize profile

      // resize for thumb nail
    }
  }
}else{
  // use default picture
}
echo '<br>';
print_r($_POST);

// -- end of test statements
?>