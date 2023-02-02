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
      header('location:../admin/admin-profile.php');
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keno Gym</title>
    <link rel="icon" type="images/x-icon" href="../images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/boxicons.min.css">

</head>
<body>
  <?php require_once '../includes/header.php';?>
    <section class="my_acc">
        <div class="container-fluid mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true">My Account</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab" aria-controls="notification" aria-selected="false">Notifications</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab" data-bs-target="#Subscription" type="button" role="tab" aria-controls="contact" aria-selected="false">My Subscriptions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainer-tab" data-bs-toggle="tab" data-bs-target="#trainer" type="button" role="tab" aria-controls="contact" aria-selected="false">My Trainers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="contact" aria-selected="false">Payment</button>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="container-fluid p-3">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                      <h4><?php echo_safe($_SESSION['user_name'])?></h4>
                                      <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Subscribed</span></p>
                                      <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
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
                                                <?php echo_safe($_SESSION['user_lastname']. ', '.$_SESSION['user_firstname']) ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Gender</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <?php echo_safe($_SESSION['user_gender_details']) ?>
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
                                                <?php echo_safe($_SESSION['user_address']) ?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col-lg-3">
                                                <h6 class="mb-0">Phone Number</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                              <?php echo_safe($_SESSION['user_phone_number']) ?>
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
                                              <?php echo_safe(getAge($_SESSION['user_birthdate'])) ?>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-9 text-secondary">
                                              <?php echo_safe($_SESSION['user_email']) ?>
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
                                              <?php echo_safe(date_format(date_create($_SESSION['user_birthdate']), "F d,Y"));?>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <h6 class="mb-0">Account Created</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">

                                                <?php echo_safe(date_format(date_create($_SESSION['user_date_created']), "F d,Y"));?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row px-3 ">
                                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                            <a class="btn btn-primary float-right " href="user-edit.php">MODIFY</a>
                                        </li>
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
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                    <div class="container-fluid p-3">
                        Notifications
                    </div>
                </div>
                <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab">
                    <div class="container-fluid p-3">
                        Subscriptions
                    </div>
                </div>
                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
                    <div class="container-fluid p-3">
                        Trainers
                    </div>
                </div>
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                    <div class="container-fluid p-3">
                        Payment
                    </div>
                </div>
              </div>
            </div>
    </section>


    <?php require_once '../includes/footer.php';?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
</body>
</html>