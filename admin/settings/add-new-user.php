<?php
if($_SESSION['admin_user_type_details'] != 'admin'){
    header('location:../dashboard/dashboard.php');
}
?>

<form action="add-admin.php" method="post">
    <form action="" method="POST" id="add-admin.php">
            <div class="row pt-3">
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label for="exampleFormControlFile1">Profile Picture</label>
                            <input type="file" class="form-control" id="profilepic" name="profilepic" accept="image/*" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Username</label>
                            <input type="text" class="form-control" value="" id="username" name="username"placeholder="Enter Username" required onchange="validate_user_name()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">First Name</label>
                            <input type="text" class="form-control" value="" id="fname" name="fname"placeholder="Enter First Name" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Middle Name</label>
                            <input type="text" class="form-control" value="" id="mname" name="mname"placeholder="Enter Middle Name" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                            <input type="text" class="form-control" value="" id="lname" name="lname"placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Phone Number</label>
                            <input type="text" class="form-control" value="" id="phone" maxlength="11" name="phone" placeholder="Enter Phone Number" required onchange="validate_phone()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="name_offer">Email</label>
                            <input type="email" class="form-control" value="" id="email" name="email"placeholder="Enter Email" required onchange="validate_email()">
                        </div>
                    </div>
                    
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label for="Gender">Gender</label>
                            <select class="form-select" id="gender" name="gender" onchange="genders()">
                                <option value="None" >Select Gender </option>
                                <?php 
                                
                                $genderObj = new genders();
                                $data = $genderObj->get_gender_list();
                                foreach ($data as $key => $value) {
                                    echo '<option value="';
                                    echo_safe($value['user_gender_details']);
                                    echo '"';
                                    echo 'id="';echo_safe($value['user_gender_details']);
                                    echo '">';
                                    echo_safe($value['user_gender_details']);
                                    echo '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="ms-1" for="name_offer">Not in the list?</label>
                            <input type="text" class="form-control" value="" id="gender_other" name="gender_other"placeholder="Enter gender" onchange="other_genders()">
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Birth Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d', time()-(60*60*24*365*18)); ?>" id="birthdate" name="birthdate"placeholder="Enter Birth Date" max="<?php echo date('Y-m-d', time()-60*60*24*5); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label for="exampleFormControlFile1">ID or Birth Certificate</label>
                            <input type="file" class="form-control" id="valid_id" accept="image/*" >
                        </div>
                    </div>
                    <!-- <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Address</label>
                            <input type="text" class="form-control" value="" id="address" name="address"placeholder="Enter Address" tabindex="100" >
                        </div>
                    </div> -->
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="password">Password</label>
                            <input type="password" class="form-control" value="" id="password" name="password"placeholder="Enter Password" required onkeyup="function_password_validation('password','password_err')">
                        </div>
                        <div class="col-12 text-secondary pb-1" id='password_err'>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12">
                            <label class="pb-1 ms-1" for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" value="" id="confirm_password" name="cpassword"placeholder="Confirm Password" required onkeyup="function_password_validation('confirm_password','confirm_password_error')">
                        </div>
                        <div class="col-12 text-secondary pb-1" id='confirm_password_error'>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="col-12 fw-regular ">Control</h5>
            <hr>
            <div class="table-responsive col-lg-6">
                <table id="table-2" class="table table-striped table-borderless " style="border: 3px solid black; width:100%;">
                    <thead class="bg-dark text-light">
                        <tr>
                        <th class="ps-lg-5 ">Choose what to display</th>
                        <th >Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Announcement</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Announcement" id="Announcement" value="Modify">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Announcement" id="Announcement" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Announcement" id="Announcement" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Attendance</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Attendance" id="Attendance" value="Modify">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Attendance" id="Attendance" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Attendance" id="Attendance" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Locker</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Locker" id="Locker" value="Modify">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Locker" id="Locker" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Locker" id="Locker" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Offer</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Offer" id="Offer" value="Modify">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Offer" id="Offer" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Offer" id="Offer" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Avail</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Avail" id="Avail" value="Modify" >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Avail" id="Avail" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Avail" id="Avail" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Account</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Account" id="Account" value="Modify">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Account" id="Account" value="Read-Only" checked >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Account" id="Account" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Payment</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Payment" id="Payment" value="Modify" >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Payment" id="Payment" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Payment" id="Payment" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Maintenance</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance" value="Modify" >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance" value="Read-Only" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance" value="None" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-lg-5 pt-3 align-middle">
                                <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Reports</label>
                                </div>
                            </td>
                            <td >
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Report" id="Report" value="Modify" >
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Modify
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Report" id="Report" value="Read-Only" checked >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Read-Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Report" value="None" id="Report" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        None
                                    </label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="row d-flex flex-row-reverse">
                <div class="col-12 col-lg-12 d-grid d-lg-flex pt-3 pt-lg-1">
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_admin" value="add_admin" id="submit">Submit</button>
                </div>
            </div>
    </form>
</form>




<script>
function genders(){
    $('#gender_other').val(''); 

    console.log('gender selected  changed');
    if(($('#gender').val() == 'None' )|| $('#gender').val() == 'Other'  ) {
        gender_valid= false;
        if($('#gender').val() == 'Other' && $('#gender_other').val().length>0){
            gender_valid= true;
        }
    }else{
        gender_valid= true;

    }
}
function other_genders(){
  $('#gender').val('Other'); 
  $('#gender option[value=Other]').attr('selected','selected'); 
  gender_valid = true;
  console.log('gender others changed');
}
var username_valid = false;
var gender_valid = false;
var email_valid = false;
var phone_valid = false;
var password_valid = false;

function validate_user_name(){
    var username = $('#username').val();
    if(username.length >=6){
        // ajax
        var values = $('#username').serialize();
        $.ajax({
            type: "POST",
            data: values,
            url: '../../ajax/user/usernamecheck.php',
            success: function(result)
            {
                if(result ==1){
                    $("#username").css("color","green");
                    username_valid =true;
                }else{
                    $("#username").css("color","red");
                    username_valid = false;
                }
               
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else{
        $("#username").css("color","red");
        username_valid = false;
    }
}

function validate_email(){
    var email = $('#email').val();
    if(ValidateEmail(email)){
        var values = $('#email').serialize();
        $.ajax({
            type: "POST",
            data: values,
            url: '../../ajax/user/emailcheck.php',
            success: function(result)
            {
                if(result ==1){
                    $("#email").css("color","green");
                    email_valid =true;
                }else{
                    $("#email").css("color","red");
                    email_valid = false;
                }
               
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else{
        $("#email").css("color","red");
    }
}

function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){
        // ajax email??
        return (true)
    }
        return (false)
    }

function validate_phone(){
    var phone = $('#phone').val();
    if(phone.length  == 11){
        $("#phone").css("color","green");
        phone_valid = true;
    }else{
        $("#phone").css("color","red");
        phone_valid = false;
    }
}

$("#submit").click(function (event) {
    // validate
    if(gender_valid && username_valid && email_valid && password_valid && phone_valid &&  $('#lname').val().length >0 && $('#fname').val().length >0 ){
        $(this).attr("type", "submit");
        $(this).click();
    }else{
        if(!username_valid){
            alert('invalid username');
            return;
        }
        if( $('#fname').val().length <=0){
            alert('first name is not populated');
            return;
        }
        if( $('#lname').val().length <=0){
            alert('lastname name is not populated');
            return;
        }
        if(!phone_valid){
            alert('invalid phone');
            return;
        }
        if(!email_valid){
            alert('invalid email');
            return;
        }
        if(!gender_valid){
            alert('invalid gender');
            return;
        }
        if(!password_valid){
            alert('invalid password');
            return;
        }
        
    }
    
    
});


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
    password_valid = false;
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
    let current_password = $('#password').val();
    let confirm_password = $('#confirm_password').val();

    if(!validatedPassowrdConfirmPassword(current_password,confirm_password)){
        $('#confirm_password_error').html('Password Password do not match');
        return false;
        
    }
    password_valid = true;
    
    $('#confirm_password_error').html('');

    

}
</script>