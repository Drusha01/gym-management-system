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
        <h5 class="col-7 col-lg-4 fw-bold  ms-3">Trainer Profile</h5>
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
                            <h4><?php echo_safe($user_data['user_name'])?></h4>
                            <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal"><?php echo_safe($user_data['trainer_availability_details'])?></span></p>
                            <p class="text-muted font-size-sm"><?php echo_safe($user_data['user_address'])?></p>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="card mt-3">
                    <div class="py-1 px-3 pt-2">
                        <h5 class="fw-bold">To Train For Today</h5>
                    </div>
                    <div class="container">
                        <table class="table table-responsive table-striped table-borderless" style="width:100%">
                            <thead class="bg-dark text-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Trinidad, James Lorenz</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Nicholas, Shania Grabrielle</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>Lim, Robbie John</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="col pb-3">
                            <div class="list-group-item d-flex flex-row-reverse flex-wrap">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#moredetailstrain">More Details</button> 
                            </div>
                        </div>
                    </div>
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
                                <?php echo_safe($user_data['user_fullname'])?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_gender_details'])?>
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
                                <?php echo_safe($user_data['user_address'])?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_phone_number'])?>
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
                                <?php echo_safe(getAge($user_data['user_birthdate'])) ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                <?php echo_safe ($user_data['user_email'])?>
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
                    
                    <?php if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){ ?>
                    <div class="col-5">
                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                            <a class="btn btn-primary float-right " href="account-profile-edit.php?user_id=<?php echo_safe($_GET['trainer_id'])?>">MODIFY</a>
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
                                <h5 class="fw-bold">Total Person Who Availed</h5>
                            </div>
                            <hr>
                        </div>
                    <div class="row mt-2">
                        <div class="col-4 text-center">
                            <i class='bx bx-male' style="font-size: 75px;"></i>
                            <h4 class="fw-bold">1</h4>
                            <h6 class="fw-bold">Male</h6>
                        </div>
                        <div class="col-4 text-center">
                            <i class='bx bx-female' style="font-size: 75px;"></i>
                            <h4 class="fw-bold">4</h4>
                            <h6 class="fw-bold">Female</h6>
                        </div>
                        <div class="col-4 text-center">
                            <i class='bx bxs-group' style="font-size: 75px;"></i>
                            <h4 class="fw-bold">5</h4>
                            <h6 class="fw-bold">Others</h6>
                        </div>
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
        <img src="<?php echo_safe('../../img/valid-id/'.$user_data['user_valid_id_photo'])?>" class="img-fluid">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="moredetailstrain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">To Train</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-striped table-borderless" style="width:100%">
                <thead class="bg-dark text-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAME</th>
                    <th scope="col">GENDER</th>
                    <th scope="col">AGE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Trinidad, James Lorenz</td>
                    <td>Male</td>
                    <td>25</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Nicholas, Shania Grabrielle</td>
                    <td>Female</td>
                    <td>30</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Lim, Robbie John</td>
                    <td>Male</td>
                    <td>21</td>
                    </tr>
                </tbody>
            </table>
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