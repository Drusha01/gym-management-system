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
        // 
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){
        // query the user information with id
            if(isset($_GET['trainer_id'])){
                // 
                require_once '../../classes/trainers.class.php';
                require_once '../../tools/functions.php';
                $trainerObj = new trainers();
                if($user_data = $trainerObj->fetch_trainer_with_id($_GET['trainer_id'])){
                }else{
                    return 'error';
                }
            }else{
                header('location:account.php');
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            header('location:account.php');
        }else{
            header('location:account.php');
        }

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
            <h5 class="col-7 col-lg-4 fw-bold  ms-3">Trainer Profile (Edit)</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a> 
        </div>
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../../images/acc_img.png" alt="Admin" class="rounded-circle p-1 bg-danger" width="110">
                                    <div class="mt-3">
                                        <h4>Trinidad, James Lorenz</h4>
                                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="file">Upload new image</button>
                                        <hr>
                                        <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 5 MB</div>
                                        <!-- Profile picture upload button-->
                                        <button class="btn btn-primary" type="button">Upload ID or Birth Certificate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-3">
                                    <div class="col-sm-2 align-self-center pb-1">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-10 text-secondary">
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">First Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Middle Name</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1">
                                        <h6 class="mb-0">Last Name</h6>
                                    </div>
                                    <div class="col-sm-10 text-secondary">
                                        <input type="text" class="form-control" value="Trinidad">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                    <select class="form-select" id="exampleFormControlSelect1">
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Helicopter</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Other</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="Thomas the Train Engine">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="email" class="form-control" value="">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="number" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="col-sm-2 align-self-center pb-1"> 
                                        <h6 class="mb-0">Birth Date</h6>
                                    </div>
                                    <div class="col-sm-4 text-secondary pb-1">
                                        <input type="text" class="form-control" onfocus="(this.type='date')" value=""
                                        onblur="(this.type='text')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-3 text-secondary">
                                        <input type="button" class="btn btn-success px-4" value="Save Changes">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


</body>
</html>