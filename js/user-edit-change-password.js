function savepassword(){
    // get all password inputs
    let current_password = $('#current_password').val();
    let new_password = $('#new_password').val();
    let confirm_password = $('#confirm_password').val();
    //console.log(current_password);

    // validate
    if(ValidatePassword(current_password) && ValidatePassword(new_password) && ValidatePassword(confirm_password) && 
    validatedPassowrdConfirmPassword(new_password,confirm_password)&& !validatedPassowrdConfirmPassword(new_password,current_password)){
        // ajax
        xhttp.open("POST", "user-edit-ajax-savepassword.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("current_password="+current_password+"&new_password="+new_password+"&confirm_password="+confirm_password);
    }else{
        // check if
    }


    


}
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Typical action to be performed when the document is ready:

        alert(xhttp.responseText);
      
        // do something here
        $('#current_password').val('');
        $('#new_password').val('');
        $('#confirm_password').val('');
      
    }
};

function ValidatePassword(password){
    if(!ValidatePasswordLength(password)){
        // change the 
        return false;
    }
    if(!ValidatePasswordUppercase(password)){
        return false;
    }
    if(!ValidatePasswordLowercase(password)){
        return false;
    }
    if(!ValidatePasswordIsnum(password)){
        return false;
    }
    return true;
}

function ValidatePasswordLength(password){
    if(password.length <12){
        return false;
    }
    return true;
}
function ValidatePasswordUppercase(password){
    for (let i = 0; i < password.length; i++) {
        if(password.charCodeAt(i) > 64 && password.charCodeAt(i) < 91){
            return true;
        }
    }
    return false;
}
function ValidatePasswordLowercase(password){
    for (let i = 0; i < password.length; i++) {
        if(password.charCodeAt(i) > 96  && password.charCodeAt(i) < 123){
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

function function_password_validation(password_id,error_id){
    let password = $('#'+password_id).val();
    if(!ValidatePasswordLength(password)){
        // change the 
        //console.log('<12');
        $('#'+error_id).html('Password must be >= 12');
        return false;
    }
    if(!ValidatePasswordUppercase(password)){
        $('#'+error_id).html('Password must have uppercase letter');
        //console.log('u');
        return false;
    }
    if(!ValidatePasswordLowercase(password)){
        $('#'+error_id).html('Password must have lowercase letter');
        //console.log('u');
        return false;
    }
    if(!ValidatePasswordIsnum(password)){
        $('#'+error_id).html('Password must have number');
        return false;
    }
    $('#'+error_id).html('');
    let current_password = $('#current_password').val();
    let new_password = $('#new_password').val();
    let confirm_password = $('#confirm_password').val();

    if(!validatedPassowrdConfirmPassword(new_password,confirm_password)){
        $('#confirm_password_error').html('Password Password do not match');
        return false;
        
    }
    if(validatedPassowrdConfirmPassword(new_password,confirm_password)&& validatedPassowrdConfirmPassword(current_password,new_password)){
        $('#current_password_error').html('current password is same with new password');
        $('#new_password_error').html('current password is same with new password');
        return false;
    }else{
        $('#current_password_error').html('');
        $('#new_password_error').html('');
    }
    $('#confirm_password_error').html('');

    

}