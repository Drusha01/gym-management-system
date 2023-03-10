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
        if($_SESSION['admin_user_type_details'] == 'admin'){
            // get the admin details

            if($_SESSION['admin_user_type_details'] != 'admin'){
                header('location:../dashboard/dashboard.php');
            }


            require_once '../../classes/users.class.php';
            require_once '../../classes/admins.class.php';
            $userObj = new users();
            $adminObj = new admins();
            if(isset($_GET['user_id']) && intval($_GET['user_id'])>0){
                $userObj->setuser_id($_GET['user_id']);
                $user_data = $userObj->get_user_details();
            }else{
                header('location:../dashboard/dashboard.php');
            }
            if(isset($_POST['add_admin_from_existing_user'])&& isset($_POST['user_id']) && intval($_POST['user_id'])>0){
                
                print_r($_POST);
                if(isset($_POST['Offer']) && isset($_POST['Avail']) && isset($_POST['Account']) && isset($_POST['Payment']) && isset($_POST['Maintenance'])&& isset($_POST['Report'])){
                    if($adminObj->add($_POST['user_id'],$_POST['Offer'],$_POST['Avail'],$_POST['Account'],$_POST['Payment'],$_POST['Maintenance'],$_POST['Report'])){
                        header('location:settings.php');
                    }else{
                        echo 'error';
                    }
                }else{
                    header('location:settings.php');
                }


            }
        }else{
            // go to dashboard
            header('location:../dashboard/dashboard.php');
        }
    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
    <div class="row">
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Add Admin</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
        <div class="row">
            <div class="col-12 col-lg-6">
                <!-- <div class="row form-group pb-2">
                <label for="exampleFormControlFile1">Profile Picture</label>
                <input type="file" class="form-control-file" id="profilepic" name="profilepic" accept="image/*" >
                </div> -->
                <div class="row form-group pb-2">
                    <div class="col">
                        <label class="pb-1 ms-1" for="user_name">Username</label>
                        <h6><strong><?php echo htmlentities($user_data['user_name'])?></strong></h6>
                    </div>
                </div>
                <div class="row form-group pb-2">
                    <div class="col-12 col-lg-6">
                        <label class="pb-1 ms-1" for="name_offer">First Name</label>
                        <h6><strong><?php echo htmlentities($user_data['user_firstname'])?></strong></h6>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="pb-1 ms-1" for="name_offer">Middle Name</label>
                        <h6><strong><?php echo htmlentities($user_data['user_middlename'])?></strong></h6>
                    </div>
                </div>
                <div class="row form-group pb-2">
                    <div class="col">
                        <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                        <h6><strong><?php echo htmlentities($user_data['user_lastname'])?></strong></h6>
                    </div>
                </div>
                
                    
                </div>
            </div>
        </div>
        <h5 class="col-12 fw-regular ">Control</h5>
        <hr>
        <form action="" method="post">
            <div class="table-responsive table-user">
                <input type="text" value="<?php echo htmlentities($user_data['user_id'])?>" name="user_id" style="visibility:hidden;">
                <table id="table-2" class="table table-striped table-borderless " style="border: 3px solid black;">
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
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_admin_from_existing_user" value="add_admin_from_existing_user" id="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>      
</script>
</html>