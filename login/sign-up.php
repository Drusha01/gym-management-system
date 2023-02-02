<?php

// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // go to userpage
      header('location:../user/user-page.php');
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
}else{
  // must be sign up 
  // check the post global variable
  if(validate_signup($_POST)){
    $userObj = new Users();
    // set attributes
    $userObj->setuser_status_details('active');
    $userObj->setuser_type_details('normal');
    $userObj->setuser_gender_details($_POST['gender']);
    $userObj->setuser_phone_contry_code_details('+63');

    $userObj->setuser_phone_number($_POST['phone']);
    $userObj->setuser_email($_POST['email']);
    $userObj->setuser_name($_POST['username']);
    $userObj->setuser_password_hashed(password_hash($_POST['password'], PASSWORD_ARGON2I));
    $userObj->setuser_firstname($_POST['fname']);
    $userObj->setuser_lastname($_POST['lname']);
    $userObj->setuser_birthdate($_POST['birthdate']);
    

    // check for duplicates
    if(!$userObj->user_duplicateAll()){
      // available
      // proceed


      $valid_id = true;
      $profile_pic = true;
      // set default valid id and profile picture
      $userObj->setuser_valid_id_photo('default.jpg');
      $userObj->setuser_profile_picture('default.jpg');
      // check the valid id file upload
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
            $valid_id = true;
            
            // change valid id photo in db
            $userObj->setuser_valid_id_photo($filename);
            // echo 'moved';
            // resize file?
          }
        }
      }
      
      // check the profile picture file upload
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
            $profile_pic = true;

            // change profile picture in db
            $userObj->setuser_profile_picture($filename);
            //echo 'moved';
            // resize file?

            // resize profile

            // resize for thumb nail
          }
        }
      }
      // note that the file must be uploaded before inserting the user
      // insert
      if ($userObj->signup() ) {
        $userObj->setuser_id($userObj->user_id_with_username()['user_id']);
        // get_user_details
        $user_details = $userObj->get_user_details();
        // set session
        $_SESSION['user_id'] = $user_details['user_id'];
        $_SESSION['user_status_details'] = $user_details['user_status_details'];
        $_SESSION['user_type_details'] = $user_details['user_type_details'] ;
        $_SESSION['user_gender_details'] = $user_details['user_gender_details'];
        $_SESSION['user_phone_contry_code_details'] = $user_details['user_phone_contry_code_details'];

        $_SESSION['user_phone_number'] = $user_details['user_phone_number'];
        $_SESSION['user_email'] =$user_details['user_email'];
        $_SESSION['user_name'] = $user_details['user_name'];
        $_SESSION['user_password_hashed'] = 'null';
        $_SESSION['user_firstname'] = $user_details['user_firstname'];

        $_SESSION['user_lastname'] = $user_details['user_lastname'];
        $_SESSION['user_address'] = $user_details['user_address'];
        $_SESSION['user_birthdate'] = $user_details['user_birthdate'];
        $_SESSION['user_valid_id_photo'] = $user_details['user_valid_id_photo'];
        $_SESSION['user_profile_picture'] = $user_details['user_profile_picture'];

        $_SESSION['user_date_created'] = $user_details['user_date_created'];
        $_SESSION['user_date_updated'] = $user_details['user_date_updated'];
        // go to user page
        header('location:../user/user-profile.php');
      }else{
        echo 'error';
      }
    }else{
        echo 'used';
    }
  }
}

// check if the account status is valid

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym | Sign-Up</title>
    <link rel="icon" type="images/x-icon" href="/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log-in.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>
<body>
  <section class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5">
        <div class="box shadow bg-white rounded">
          <div class="container-fluid bg-danger p-2 rounded-top d-inline-flex justify-content-center">
            <img src="../images/logo.png" alt="" width="55">
            <div class="d-flex flex-column p-2 pt-0 pb-0 ">
              <h3 class="mb-1 fs-5 text-white "><strong>KE-NO</strong></h3>
              <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
          </div>
          <a class="text-decoration-none text-black m-0" aria-current="page" href="../index.php"><span class='bx bxs-left-arrow align-middle fs-4'></span>Go Back</a>
          <form class="form-signup p-2" method="post" enctype="multipart/form-data">
            <h2 class="text-center">Create Account</h2>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" class="form-control-file" id="profilepic" name="profilepic" >
            </div>
            <div class="form-group py-1">
              <input type="text" class="form-control" name="username" id="username" placeholder="Username" oninput="functiononkeyup()" required>
            </div>
            <div class="form-group py-1">
                <div class="row">
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" oninput="functiononkeyup()" required>
                    </div>
                    <div class="col-md-6 py-1">
                        <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"  oninput="functiononkeyup()"  required>
                    </div>
                </div>
            </div>
            <div class="form-group py-1">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" oninput="functiononkeyup()" required>
            </div>
            <div class="form-group py-1">
              <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone Number" oninput="functiononkeyup()" maxlength="10" required>
            </div>
            <label>Gender</label>
            <div class="form-group py-1">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" oninput="functionOnchangeGender('Male')" id="Male" value="Male" required >
                    <label class="form-check-label" for="Male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="gender" oninput="functionOnchangeGender('Female')" id="Female" value="Female" required>
                    <label class="form-check-label" for="Female">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"  name="gender" oninput="functionOnchangeGender('Other')" id="Other" value="Other" required>
                    <label class="form-check-label" for="Other">Other</label>
                  </div>
            </div>
            <div class="form-group py-1">
              <label>Birth Date</label>
              <input type="date" class="form-control" id="birthdate" name="birthdate" onchange="functionOnchangeBirthdate(this)" id="birthdate" required>
            </div>
            <div class="form-group py-1">
              <label for="exampleFormControlFile1">Valid ID</label>
              <input type="file" class="form-control-file" id="valid_id" name="valid_id" accept="image/*"  >
            </div>
            <div class="form-group py-1">
            <input type="password" class="form-control" name="password" placeholder="Password" oninput="functiononkeyup()" id="password" required>
            </div>
            <div class="form-group py-1">
                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" oninput="functiononkeyup()" id="cpassword"required>
            </div>
            <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg border-0 rounded" onclick="functiononsignup()" id="submit"> Sign-Up</button>
            </div>
            <p class="text-center">Already Have an Account? <a class="text-decoration-none" href="../login/log-in.php">Log-in</a></p>
          </form>
          

        </div>
      </div>
    </div>
  </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>

<script>
function signup() {
  // get the
  var username = $('#email').val();
  var password = $('#password').val();
  var bday = $('#bday').val();
  console.log(username)
  console.log(bday)
  // javascript validation here 
  // ajax here

}
function functionOnchangeGender(gender){
  console.log(gender)
  validateAll();
}
function functionOnchangeBirthdate(birthdate){
  // do some error handling here
  functiononkeyup();
}
var validateallvar=true;
function functiononkeyup() {
  
  //make ajax first
  let username = $('#username').val(); 
  let phone = $('#phone').val();
  let email = $('#email').val();
  if(username.length>=6 || ValidateEmail(email) || phone.length ==10 ){
    if((username.length)>=6){
      // check if it is a valid username
      // ajax text username if valid
      xhttp.open("POST", "../ajax/user/usernamecheck.php", true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("username="+username);
    }
    if(ValidateEmail(email)){
      // check if it is a valid email
      // ajax text email if valid
      console.log('ajax');
      xhttpEmail.open("POST", "../ajax/user/emailcheck.php", true);
      xhttpEmail.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttpEmail.send("email="+email);
    }
    if(phone.length ==10){ 
      // ajax here
      console.log('ajax');
      xhttpEmail.open("POST", "../ajax/user/emailcheck.php", true);
      xhttpEmail.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttpEmail.send("email="+phone);
    }
  }
  if(validateallvar){
    setInterval(validateAll, 500);
    validateallvar=false;
  }
  
  
}
function validateAll(){
        console.log('tick');
        // console.log('nice');
        let firstname = $('#fname').val().length;
        let lastname = $('#lname').val().length;
        let birthdate = $('#birthdate').val();
        let password = $('#password').val();
        let confirmpassword = $('#cpassword').val();
        let submit = $('#submit');
        let username = $('#username').val(); 
        let phone = $('#phone').val();
        let email = $('#email').val();

        // console.log(username);
        // console.log(firstname);
        // console.log(lastname);
        // console.log(email);
        // console.log(phone);
        // console.log(birthdate);
        // console.log(password);
        // console.log(confirmpassword);

        if( username.length<6 ||(firstname) == 0 || lastname == 0 || phone.length < 10 || phone.length > 10 || !ValidateEmail(email)|| !ValidatePasswordLength(password) || !ValidatePasswordUppercase(password) || !ValidatePasswordLowercase(password)
        || !ValidatePasswordIsnum(password) || !validatedPassowrdConfirmPassword(password,confirmpassword)){
            // submit.disabled = true;
             $("#submit").attr("disabled", true);
            if(username.length < 6){
              $('#submit').html('Username must be >= 6 ');
              $("#username").css("color","red");
              return;
            }
            if((firstname) == 0){
              $('#submit').html('Enter Firstname');
              return;
            }
            if(lastname == 0){
              $('#submit').html('Enter Lastname');
              return;
            }
            if(email.length == 0 || !ValidateEmail(email)){
              console.log('email err');
              $('#submit').html('Enter valid email ');
              $("#email").css("color","red");
              return;
            }
            if(phone.length < 10 || phone.length > 10){
              $('#submit').html('Phone number must be 10 digits');
              $("#phone").css("color","red");
              console.log('phone err');
              return;
            }
            if(!ValidatePasswordLength(password)){
                // submit.setAttribute('value','Password length must be >=12');
              $('#submit').html('Password length must be >=12');
              console.log('pass err');
              return;
            }
            if(!ValidatePasswordUppercase(password)){
                // submit.setAttribute('value','Password must have uppercase letter');
                $('#submit').html('Password must have uppercase letter');
                console.log('pass err');
                return;
            }
            if(!ValidatePasswordLowercase(password)){
               // submit.setAttribute('value','Password must have lowercase letter');
               $('#submit').html('Password must have lowercase letter');
               return;
            }
            if(!ValidatePasswordIsnum(password)){
                //submit.setAttribute('value','Password must have number letter');
                $('#submit').html('Password must have number letter');
                return;
            }
            if(!validatedPassowrdConfirmPassword(password,confirmpassword)){
               // submit.setAttribute('value','Password don\'t match');
               $('#submit').html('Password don\'t match');
               return;
            }
            
            
            
            
            
        }else{
          $("#submit").removeAttr("disabled");
          $("#submit").attr("value",'Sign-Up');
          document.getElementById("submit").disabled = false; 
        }
        // }else{
            
        //     if (firstname == 0){
        //         submit.setAttribute('value','Invalid firstname');
        //     } 
        //     if (lastname == 0){
        //         console.log(parseInt(lastname));
        //     }
        //     if (!ValidateEmail(email)){
        //         submit.setAttribute('value','Invalid email');
        //     }
        //     if (!ValidatePasswordLength(password)){
        //         submit.setAttribute('value','Password length more than or equal to 12');
        //     }
        //     document.getElementById("submit").disabled = true;
            
        // }
       
    }
    function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        // ajax email??
        return (true)
    }
        return (false)
    }
    function ValidatePasswordLength(password){
        if(password.length <12){
            return false;
        }
        return true;
    }
    function ValidatePasswordUppercase(password){
        for (let i = 0; i < password.length; i++) {
            if(password[i] == password[i].toUpperCase()){
                return true;
            }
        }
        return false;
    }
    function ValidatePasswordLowercase(password){
        for (let i = 0; i < password.length; i++) {
            if(password[i] == password[i].toLowerCase()){
                return true;
            }
        }
        return false;
    }
    function ValidatePasswordIsnum(password){
        for (let i = 0; i < password.length; i++) {
            if(isNumber(password[i])){
                return true;
            }
        }
        return false;
    }
    function isNumber(char) {
        return /^\d$/.test(char);
    }
    function validatedPassowrdConfirmPassword(password,confirmpassword){
        return password  === confirmpassword;
    }
    function ValidatePassword(password){
        if(password.length <12){
            return false;
        }else if(0){
            return false;
        }
    }

function functiononsignup(){
  console.log('signup');
}

var xhttp = new XMLHttpRequest();


xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:
      console.log(xhttp.responseText);
      if(xhttp.responseText==1){
        // make the username green if valid
        $("#username").css("color","green");
        $('#submit').html('Sign-Up');
      }else{
        // make the username red if not valid
        $("#username").css("color","red");
        // change the sign up
        $('#submit').html('Username taken');
        return;
      }
      
      
    }
};

var xhttpEmail = new XMLHttpRequest();


xhttpEmail.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:
      console.log(xhttpEmail.responseText);
      if(xhttpEmail.responseText==1){
        // make the username green if valid
        $("#email").css("color","green");
        $('#submit').html('Sign-Up');
      }else{
        // make the username red if not valid
        
        // change the sign up
        $('#submit').html('Email taken');
        $("#email").css("color","red");
        return;
      }
      
      
    }
};

var xhttpPhone = new XMLHttpRequest();

xhttpPhone.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:
      console.log(xhttpPhone.responseText);
      if(xhttpPhone.responseText==1){
        // make the username green if valid
        $('#submit').html('Sign-Up');  
        $("#phone").css("color","green");
      }else{
        // make the username red if not valid
        
        // change the sign up
        $('#submit').html('Phone taken');
        $("#email").css("color","red");
        return;
      }
      
      
    }
};

</script>