<?php 

// gender array
$gender_array  = array('Male', 'Female','Other');

function validate_string($POST,$name){
    return (isset($POST[$name]) && strlen(trim($POST[$name]))>1  && strlen(trim($POST[$name])) < 255) ;
}
function validate_email($POST){
    // Remove all illegal characters from email
    if(!isset($POST['email'])){
        return false;
    }
    $email = filter_var($POST['email'], FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_username($POST,$username){
    return (isset($POST[$username]) && strlen(trim($POST[$username]))>=6  && strlen(trim($POST[$username])) < 255);
}
function validate_phone($POST,$phone){
    // do this
    return (isset($POST[$phone]));
}

function validate_gender($POST,$gender){
    // check if the gender is in the array
    if (isset($POST[$gender])) {
        $gender_array = array('Male', 'Female', 'Other');
        foreach ($gender_array as $value) {
            if ($value == $POST[$gender]) {
                return true;
            }
        }
        return false;
    }
}

function validate_birthdate($POST,$birthdate){
    //  do this
    return (isset($POST[$birthdate]));
}

function validate_password($POST,$password){
    if(strlen($POST[$password]) < 12 ) {
        return false;
    }
    elseif(!preg_match("#[0-9]+#",$POST[$password])) {
        return false;
    }
    elseif(!preg_match("#[A-Z]+#",$POST[$password])) {
        return false;
    }
    elseif(!preg_match("#[a-z]+#",$POST[$password])) {
        return false;
    }
    return true; 
}

function validate_password_same($POST,$password,$cpassword){
    return (isset($POST[$password]) && isset($POST[$cpassword]) && strcmp($POST[$password], $POST[$cpassword]) == 0);
}

function validate_signup($POST){
    return (validate_username($POST, 'username') && validate_string($POST, 'fname') && validate_string($POST, 'lname') && validate_email($POST) && 
    validate_phone($POST, 'phone') && validate_gender($POST,'gender') && validate_birthdate($POST,'birthdate') && validate_password_same($POST,'password','cpassword') && validate_password($POST,'password') ); 
    
  
}
// username,firstname, lastname ,email, phone, gender, birthdate, profile picture,  valid id, password, confirm password


function validate_file($FILES,$filenameArray,$type,$size){
    // check file size
    if($FILES[$filenameArray]['size'] > 10 && $FILES[$filenameArray]['size'] < $size){
        // filename and extension
        $length=(strlen($_FILES[$filenameArray]['name']));
        $length2 = $length;
        $ext= null;
        while($length--){
            if ($_FILES[$filenameArray]['name'][$length] == '.'){
                $ext = substr($_FILES[$filenameArray]['name'],$length-$length2+1);
                break;
            }
        }
        foreach ($type as $value) {
            if ($ext == $value) {
                return true;
            }
        }
        return false;
    }
    return false;
}

function resizeImage($filename,$filedestication,$quality,$width,$height){
    return false;
}

function getFileExtensionfromFilename($filename){
    $length=(strlen($filename));
    $length2 = $length;
    $ext= null;
    while($length--){
        if ($filename[$length] == '.'){
            $ext = substr($filename,$length-$length2+1);
            return $ext;
        }
    }

}
?>