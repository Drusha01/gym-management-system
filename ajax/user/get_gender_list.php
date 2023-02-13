<?php 
session_start();

// includes
require_once '../../tools/functions.php';
require_once '../../classes/genders.class.php';
$genderObj = new genders();

// software firewall // check how many times did the user check in a minute (max would be 5 times in every minute per ip address) although this wont protect the sytem externally, they can just abuse this via
// using new session and abuse it.

// set attributes
$data = $genderObj->get_gender_list();
foreach ($data as $key => $value) {
    echo $key . ' ' . $value['user_gender_details'].'<br>';
}



?>
