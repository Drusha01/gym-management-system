// tbh this is a garbage type of validation it works tho, just not efficient
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
  var dateOne = new Date($('#birthdate').val()); //Year, Month, Date
  var dateTwo = new Date($('#birthdatehidden').val()); //Year, Month, Date
  if (dateOne > dateTwo) {
    $('#birthdate').val($('#birthdatehidden').val())
      alert("Age must be 10 years old higher");
  }else {
    
  }
  functiononkeyup();
}
var validateallvar=true;
function functiononkeyup() {
  
  //make ajax first
  let username = $('#username').val(); 
  if(username.length>=6 || ValidateEmail(email) || phone.length ==11 ){
    console.log(username.length);
    if((username.length)>=6){
      // check if it is a valid username
      // ajax text username if valid
      xhttp.open("POST", "../ajax/user/usernamecheck.php", true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send("username="+username);
    }
  }
  if(username.length <6){
    $('#submit').html('Username must be >= 6 ');
    $("#username").css("color","red");

  }
  if(validateallvar){
    setInterval(validateAll, 500);
    validateallvar=false;
  }
  

}

function validateAll(){
        
        functiononkeyup();
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
      //console.log(xhttp.responseText);
      if(xhttp.responseText==1){
        // make the username green if valid
        $("#username").css("color","green");
        // $('#submit').html('Sign-up');
        console.log('username valid');
        let email = $('#email').val();
        if(ValidateEmail(email)){
          // check if it is a valid email
          // ajax text email if valid
          console.log('ajax');
          xhttpEmail.open("POST", "../ajax/user/emailcheck.php", true);
          xhttpEmail.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhttpEmail.send("email="+email);
        }else{
          let phone = $('#phone').val();
          if(phone.length==11  ){
            // ajax here
            console.log('ajax');
            xhttpPhone.open("POST", "../ajax/user/phonecheck.php", true);
            xhttpPhone.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttpPhone.send("phone="+phone);
          }else{
            // $("#phone").css("color","red");
            // // change the sign up
            // $('#submit').html('phone number must be 11 digits ');
            // $("#submit").attr("disabled", true);
          }
        }
      }else{
        // make the username red if not valid
        $("#username").css("color","red");
        // change the sign up
        // $('#submit').html('Username taken');
        $("#submit").attr("disabled", true);
        return;
      }
      
      
    }
};

var xhttpEmail = new XMLHttpRequest();
var email_val;
var username_val;
var phone_val;

xhttpEmail.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    // Typical action to be performed when the document is ready:
    //console.log(xhttpEmail.responseText);
    if(xhttpEmail.responseText==1){
      // make the signup green if valid
      $("#email").css("color","green");
      // $('#submit').html('Sign-up');
      console.log('email valid');
      let phone = $('#phone').val();
      if(phone.length== 11){
        // ajax here
        console.log('ajax');
        xhttpPhone.open("POST", "../ajax/user/phonecheck.php", true);
        xhttpPhone.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttpPhone.send("phone="+phone);
      }else{
        $("#phone").css("color","red");
        // change the sign up
        $('#submit').html('phone number must be 11 digits ');
        $("#submit").attr("disabled", true);
      }
      
    }else{
      // make the username red if not valid
      
      // change the sign up
      //$('#submit').html('Email taken');
      $("#email").css("color","red");
      $("#submit").attr("disabled", true);
      if(phone.length== 11){
        // ajax here
        console.log('ajax');
        xhttpPhone.open("POST", "../ajax/user/phonecheck.php", true);
        xhttpPhone.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttpPhone.send("phone="+phone);
      }
      return;
    }
    
    
  }
};

var xhttpPhone = new XMLHttpRequest();

xhttpPhone.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:
      //console.log(xhttpPhone.responseText);
      if(xhttpPhone.responseText==1){
        // make the username green if valid
        //console.log('tick');
        // console.log('nice');
        $("#phone").css("color","green");
        // $('#submit').html('Sign-up');
        console.log('phone valid');
        
      }else{
        // make the username red if not valid
        
        // change the sign up
        // $('#submit').html('Phone taken');
        $("#phone").css("color","red");
        $("#submit").attr("disabled", true);
        return;
      }

      let firstname = $('#fname').val().length;
        let lastname = $('#lname').val().length;
        let birthdate = $('#birthdate').val();
        let password = $('#password').val();
        let confirmpassword = $('#cpassword').val();
        let submit = $('#submit');
        let username = $('#username').val(); 
        let phone = $('#phone').val();
        let email = $('#email').val();
        let gender = $('#gender').val();
        let gender_other = $('#gender_other').val();

        // console.log(username);
        // console.log(firstname);
        // console.log(lastname);
        // console.log(email);
        // console.log(phone);
        // console.log(birthdate);
        // console.log(password);
        // console.log(confirmpassword);

        if( username.length<6 ||(firstname) == 0 || lastname == 0 || phone.length < 11 || phone.length > 11 || !ValidateEmail(email)|| !ValidatePasswordLength(password) || !ValidatePasswordUppercase(password) || !ValidatePasswordLowercase(password)
        || !ValidatePasswordIsnum(password) || !validatedPassowrdConfirmPassword(password,confirmpassword) || ((gender == 'None' || gender == 'Other') && gender_other.length == 0)){
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
            if(phone.length < 11 || phone.length > 11){
              $('#submit').html('Phone number must be 11 digits');
              $("#phone").css("color","red");
              console.log('phone err');
              return;
            }
            if(gender == 'None' && gender_other.length == 0){
              $('#submit').html('Select Gender');
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
          $('#submit').html('Sign-up');
          // $("#submit").attr("value",'Sign-Up');
          //document.getElementById("submit").disabled = false; 
        }
      
      
    }
};

