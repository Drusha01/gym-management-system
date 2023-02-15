<?php
require_once '../vendor/autoload.php';

// Get $id_token via HTTPS POST.
if(isset($_POST['idtoken'])){
    $client = new Google_Client(['53523092857-46kpu1ffikh67k7kckngcbm6k7naf8ic.apps.googleusercontent.com' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
    $payload = $client->verifyIdToken($_POST['idtoken']);
    if ($payload) {
    $userid = $payload['sub'];
    print_r($payload);


    // active
    // normal
    // Other
    // +63
    // 
    // If request specified a G Suite domain:
    //$domain = $payload['hd'];
    } else {
    // Invalid ID token
    }
}
?>