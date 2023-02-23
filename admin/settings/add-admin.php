<?php
// start session
session_start();

// includes


// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in2.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
    <div class="row">
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Add User</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row form-group pb-2">
                <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" >
                </div>
                <div class="row form-group pb-2">
                    <div class="col">
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
                    <div class="col">
                        <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                        <input type="text" class="form-control" value="" id="lname" name="lname"placeholder="Enter Last Name" required>
                    </div>
                </div>
                <div class="row form-group pb-2">
                    <div class="col">
                        <label class="pb-1 ms-1" for="name_offer">Phone Number</label>
                        <input type="text" class="form-control" value="" id="phone" maxlength="11" name="phone" placeholder="Enter Phone Number" required onchange="validate_phone()">
                    </div>
                </div>
                <div class="row form-group pb-2">
                    <div class="col">
                        <label class="pb-1 ms-1" for="name_offer">Email</label>
                        <input type="email" class="form-control" value="" id="email" name="email"placeholder="Enter Email" required onchange="validate_email()">
                    </div>
                </div>
                
                <div class="row form-group pb-2">
                    <div class="col-12 col-lg-6">
                        <label for="Gender">Gender</label>
                        <select class="form-select" id="gender" name="gender" onchange="genders()">
                            <option value="None" >Select Gender </option>
                        
                        </select>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="pb-1 ms-1" for="name_offer">Not in the list?</label>
                        <input type="text" class="form-control" value="" id="gender_other" name="gender_other"placeholder="Enter gender" onchange="other_genders()">
                    </div>
                </div>
                
            </div>
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Birth Date</label>
                            <input type="date" class="form-control" value="<?php echo date('Y-m-d', time()-(60*60*24*365*18)); ?>" id="birthdate" name="birthdate"placeholder="Enter Birth Date" max="<?php echo date('Y-m-d', time()-60*60*24*5); ?>" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <label for="exampleFormControlFile1">ID or Birth Certificate</label>
                        <input type="file" class="form-control-file" id="valid_id" accept="image/*" >
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Address</label>
                            <input type="text" class="form-control" value="" id="address" name="address"placeholder="Enter Address" tabindex="100" >
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-12">
                            <label class="pb-1 ms-1" for="name_offer">Password</label>
                            <input type="password" class="form-control" value="" id="password" name="password"placeholder="Enter Password" required onkeyup="function_password_validation('password','password_err')">
                        </div>
                        <div class="col-sm-4 text-secondary pb-1" id='password_err'>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-12">
                            <label class="pb-1 ms-1" for="name_offer">Confirm Password</label>
                            <input type="password" class="form-control" value="" id="confirm_password" name="cpassword"placeholder="Confirm Password" required onkeyup="function_password_validation('confirm_password','confirm_password_error')">
                        </div>
                        <div class="col-sm-4 text-secondary pb-1" id='confirm_password_error'>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="col-12 fw-regular ">Control</h5>
        <hr>
        <div class="table-responsive table-user">
            <table id="table-2" class="table table-striped table-borderless " style="border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="ps-lg-5 ">Choose what to display</th>
                    <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-lg-5 pt-3 align-middle">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Offers</label>
                            </div>
                        </td>
                        <td >
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="group1" id="group1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="group1" id="group1" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="group1" id="group1" checked>
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
                                <input class="form-check-input" type="radio" name="Avail" id="Avail">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Avail" id="Avail" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Avail" id="Avail" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    None
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-lg-5 pt-3 align-middle">
                            <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Accounts</label>
                            </div>
                        </td>
                        <td >
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Accounts" id="Accounts">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Accounts" id="Accounts" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Accounts" id="Accounts" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
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
                                <input class="form-check-input" type="radio" name="Payment" id="Payment">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Payment" id="Payment" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Payment" id="Payment" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
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
                                <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Maintenance" id="Maintenance" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
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
                                <input class="form-check-input" type="radio" name="Reports" id="Reports">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Modify
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Reports" id="Reports" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Read-Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="Reports" id="Reports" checked>
                                <label class="form-check-label" for="flexRadioDefault3">
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
                <button type="submit" class="btn btn-success  border-0 rounded" name="add_offer" value="add_offer" id="submit">Submit</button>
            </div>
        </div>
    </div>
</main>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>      
</script>
</html>