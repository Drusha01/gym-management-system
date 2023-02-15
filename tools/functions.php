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
    return (isset($POST[$username]) && strlen(trim($POST[$username]))>=6  && strlen(trim($POST[$username])) < 255 && !str_contains($_POST[$username], ' '));
}
function validate_phone($POST,$phone){
    // do this
    return (isset($POST[$phone]) && strlen($POST[$phone]) == 11 && (intval($POST[$phone])));
}

function validate_gender($POST,$gender){
    // check if the gender is in the array
    return (isset($POST[$gender]) && $POST[$gender]!='None');
}

function validate_birthdate($POST,$birthdate){
    //  do this
    return (isset($POST[$birthdate]) && strtotime($POST[$birthdate])-time() < 0) ;
}

function validateDate($POST,$birthdate, $format = 'm-d-Y H:i:s')
{
    $d = DateTime::createFromFormat($format, $POST[$birthdate]);
    return $d && $d->format($format) == $POST[$birthdate];
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
    return (validate_username($POST, 'username') && validate_string($POST, 'fname') && validate_string($POST, 'lname')&& validate_string($POST, 'mname') && validate_email($POST) && 
    validate_phone($POST, 'phone') && validate_birthdate($POST,'birthdate') && validate_password_same($POST,'password','cpassword') && validate_password($POST,'password') ); 
    
  
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

function resizeImage($sourceFilename,$destination,$filename,$newFilename,$quality,$newwidth,$newheight){
    list($width, $height) = getimagesize($sourceFilename.$filename);
    if($width/$height > 1){
        $x = ($width - $height) / 2;
        $y = 0;
        $width= $width - ($x*2);
        $height;
    }else{
        $y = ($height - $width) / 2;
        $x = 0;
        $width;
        $height = $height - ($y*2);
    }

    // creating jpeg 
    $img = imagecreatefromjpeg($sourceFilename.$filename);
    $img =imagecrop($img, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if(imagecopyresized($thumb, $img, 0, 0, 0, 0,$newwidth, $newheight, $width, $height)){
        if(imagejpeg($thumb,$destination.$filename,$quality)){
            return true;
        }else{
            return false;
        }
    }else {
        return false;
    }
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

function echo_safe($string){
    echo htmlentities($string);
}

function getAge($date) {
    return intval(date('Y', time() - strtotime($date))) - 1970;
}

function validate_profile_info($POST){
    return  validate_string($POST, 'fname') && validate_string($POST, 'mname') && validate_string($POST, 'lname') && validate_birthdate($POST, 'birthdate') && validate_phone($POST, 'phone')&& validate_email($POST);
}

function validate_offer_duration($POST,$offer_duration){
    return (isset($POST[$offer_duration])  && (intval($POST[$offer_duration]))>0);
}

function validate_offer_price($POST,$offer_price){
    return (isset($POST[$offer_price])  && (floatval($POST[$offer_price])));
}

  

function validate_offer($POST){
    return validate_string($POST, 'offer_name') && validate_offer_duration($POST,'offer_duration') && validate_offer_price($POST,'offer_price') && validate_string($POST,'type_of_subscription');
}
?>