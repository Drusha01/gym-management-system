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
        
        // query the user information with id
        if(isset($_GET['user_id'])){
            // 
            require_once '../../classes/users.class.php';
            require_once '../../tools/functions.php';
            $userObj = new users();
            $userObj->setuser_id($_GET['user_id']);
            if($user_data = $userObj->get_user_details()){

            }else{
                return 'error';
            }
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
        <h5 class="col-7 col-lg-4 fw-bold  ms-3">Account Profile</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a> 
        </div>
        <div class="container-fluid p-3">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                            <img src="../../img/profile-resize/<?php echo_safe($user_data['user_profile_picture']);?>" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?php echo_safe($user_data['user_name']);?></h4>
                                <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Subscribed</span></p>
                                <p class="text-muted font-size-sm"><?php echo_safe($user_data['user_name']);?></p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="py-1 px-3">
                            <h5 class="fw-bold">Status of Subscription</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Gym-Use</h6>
                            <span class="text-secondary">Subscribed</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Trainer</h6>
                            <span class="text-secondary">Subscribed</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Locker</h6>
                            <span class="text-secondary">Subscribed</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Programs</h6>
                            <span class="text-secondary">Not Availed</span>
                            </li>
                            <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                <a class="btn btn-success float-right " href="#">More Details</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <div class="col-md-8">
                <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_lastname'].', '.$user_data['user_firstname'].' '.$user_data['user_middlename'])?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_gender_details']); ?>
                            </div>
                        </div>
                    </div>
                        <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_address']); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_phone_number']); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Age</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe(getAge($user_data['user_birthdate'])); echo' Years Old'; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                <?php echo_safe($user_data['user_email']); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Birth Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe(date_format(date_create($user_data['user_birthdate']), "F d,Y"));?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                <h6 class="mb-0">Account Created</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe(date_format(date_create($user_data['user_date_created']), "F d,Y"));?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row px-3">
                    <div class="col-7">
                        <li class="list-group-item d-flex">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            View Valid ID
                        </button>
                        </li>
                    </div>
                    <div class="col-5">
                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                            <a class="btn btn-primary float-right " href="account-profile-edit.php?user_id=<?php echo_safe( $_GET['user_id']);?>">MODIFY</a>
                        </li>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row gutters-sm">
                <div class="col">
                    <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col align-center">
                                <h5> History </h5>
                            </div>
                            <div class="col">
                                <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                    <a class="btn btn-success float-right " href="#">More Details</a>
                                </li>
                            </div>
                        </div>
                    <div class="row mt-2">
                    <div class="container">
                        <table class="table table-responsive table-striped table-borderless">
                            <thead class="bg-dark text-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">AVAILED SERVICE</th>
                                <th scope="col">DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Walk-In Gym</td>
                                <td>October 16, 2022</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Gym-Use Subscription</td>
                                <td>October 17, 2022</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>Locker Subscription</td>
                                <td>October 17, 2022</td>
                                </tr>
                            </tbody>
                            </table>
                    </div>
                </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img src="../../img/profile-resize/<?php echo_safe($user_data['user_profile_picture']);?>">
      </div>
    </div>
  </div>
</div>

</body>
</html>