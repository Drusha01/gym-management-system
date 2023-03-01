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
            }else{
                header('location:account.php');
            }
        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            header('location:account.php');
        }else{
            //do not load the page
            header('location:../dashboard/dashboard.php');
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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#MoreDetailsSubs">
                                    More Details
                            </button>
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
                    <?php if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){?>
                    <div class="col-5">
                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                            <a class="btn btn-primary float-right " href="account-profile-edit.php?user_id=<?php echo_safe( $_GET['user_id']);?>">MODIFY</a>
                        </li>
                    </div>
                    <?php }?>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#HistorySubs">
                                    More Details
                                </button>
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
        <img class="img-fluid" src="<?php echo_safe('../../img/valid-id/'.$user_data['user_valid_id_photo'])?>">

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="MoreDetailsSubs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Current Subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive table-1">
                <table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">
                    <thead class="bg-dark text-light">
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                        <th class="col-3">NAME OF SUBSCRIPTION</th>
                        <th class="text-center ">TYPE OF SUBSCRIPTION</th>
                        <th scope="col" class="text-center">DATE SUBSCRIBED</th>
                        <th scope="col" class="text-center">END DATE</th>
                        <th scope="col" class="text-center">DAYS LEFT</th>
                        <th scope="col" class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                        <td>1-Month Gym-Use (21 and above)</td>
                        <td class="text-center ">Gym-Use Subscription</td>
                        <td class="text-center">October 16, 2022</td>
                        <td class="text-center">November 15, 2022</td>
                        <td class="text-center">24</td>
                        <td class="text-center">Paid</td>
                        </tr>
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                        <td>1-Month Trainer</td>
                        <td class="text-center ">Trainer Subscription</td>
                        <td class="text-center">October 16, 2022</td>
                        <td class="text-center">November 15, 2022</td>
                        <td class="text-center">24</td>
                        <td class="text-center">Paid</td>
                        </tr>
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">3</th>
                        <td>1-Month Locker</td>
                        <td class="text-center ">Locker Subscription</td>
                        <td class="text-center">October 16, 2022</td>
                        <td class="text-center">November 15, 2022</td>
                        <td class="text-center">---</td>
                        <td class="text-center">Pending</td>
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="row" class="text-center d-none d-sm-table-cell">4</th>
                        <td>----</td>
                        <td class="text-center ">Program Subscription</td>
                        <td class="text-center">----</td>
                        <td class="text-center">----</td>
                        <td class="text-center">----</td>
                        <td class="text-center">----</td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="HistorySubs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container table-responsive">
            <table class="table  table-striped table-borderless">
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
        <div class="container d-flex justify-content-center justify-content-lg-end pb-3">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>

                    <li class="page-item" aria-current="page">
                        <a class="page-link text-dark" href="#">2</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link text-dark" href="#">3</a>
                    </li>

                    <li class="page-item">
                    <a class="page-link text-dark" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
</html>