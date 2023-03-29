<div class="container-fluid p-3">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                <a href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150"></a>
                <div class="mt-3">
                    <h4><?php if(isset($_SESSION['user_name'])){
                    echo_safe($_SESSION['user_name']);}else {echo 'username not set';}?></h4>
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
            <?php 
            // query my active / pending subscription

                require_once('../classes/subscriptions.class.php');
                $subscriptionsObj = new subscriptions();
                $gym_use_str = 'Not Availed';
                $trainer_use_str = 'Not Availed';
                $locker_use_str = 'Not Availed';
                $program_use_str = 'Not Availed';
                if($subscription_data = $subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id'])){

                    foreach ($subscription_data as $key => $value) {
                        if($value['type_of_subscription_details'] == 'Gym Subscription'){
                            if($value['subscription_status_details'] == 'Active'){
                                $gym_use_str = 'Subscribed';
                            }elseif($value['subscription_status_details'] == 'Pending'){
                                $gym_use_str = 'Inactive';
                            }else{
                                $gym_use_str = 'Not Availed';
                            }
                        }else if($value['type_of_subscription_details'] == 'Trainer Subscription' ){
                            if($value['subscription_status_details'] == 'Active'){
                                $trainer_use_str = 'Subscribed';
                            }elseif($value['subscription_status_details'] == 'Pending'){
                                $trainer_use_str = 'Inactive';
                            }else{
                                $trainer_use_str = 'Not Availed';
                            }

                        }else if($value['type_of_subscription_details'] == 'Locker Subscription' ){
                            if($value['subscription_status_details'] == 'Active'){
                                $locker_use_str = 'Subscribed';
                            }elseif($value['subscription_status_details'] == 'Pending'){
                                $locker_use_str = 'Inactive';
                            }else{
                                $locker_use_str = 'Not Availed';
                            }

                        }else if($value['type_of_subscription_details'] == 'Program Subscription' ){
                            if($value['subscription_status_details'] == 'Active'){
                                $program_use_str = 'Subscribed';
                            }elseif($value['subscription_status_details'] == 'Pending'){
                                $program_use_str = 'Inactive';
                            }else{
                                $program_use_str = 'Not Availed';
                            }

                        }
                    }
                }
            ?>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Gym-Use</h6>
                    <span class="text-secondary"><?php echo  $gym_use_str;?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Trainer</h6>
                    <span class="text-secondary"><?php echo  $trainer_use_str;?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Locker</h6>
                    <span class="text-secondary"><?php echo  $locker_use_str;?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Programs</h6>
                    <span class="text-secondary"> <?php echo  $program_use_str;?></span>
                    </li>
                    <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                        <a href="../user/user-profile.php?active=Subscription-tab"><button type="button" class="btn btn-success" >
                                More Details
                        </button>
                        </a>
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
                                <?php echo_safe($_SESSION['user_lastname']. ', '.$_SESSION['user_firstname'].' '.$_SESSION['user_middlename']) ?>
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
                                <?php if (strlen($_SESSION['user_address']) > 0) {
                                    echo_safe($_SESSION['user_address']);
                                    
                                } else {
                                    echo 'No address';
                                } ?>
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
                                <?php echo_safe($_SESSION['user_email']); if(isset($_SESSION['user_email_verified'])){echo '<a class="btn btn-success float-right ms-2" id="view-valid-id">Verified ✓</a>';}else{echo('<a href="user-change-email-address.php" class="btn btn-success float-right" id="view-valid-id">Verify your email </a>');} ?>
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

                                <?php echo_safe(date_format(date_create($_SESSION['user_date_created']), "F d, Y"));?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row px-3 ">
                    <div class="col-7">
                        <li class="list-group-item d-flex">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            View Valid ID
                        </button>
                        </li>
                    </div>
                        <div class="col">
                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                <a class="btn btn-primary float-right " href="user-edit.php">MODIFY</a>
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
                            <h5> Attendance </h5>
                        </div>
                        <div class="col">
                            <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                                <a class="btn btn-success float-right " href="attendance-hist.php">More Details</a>
                            </li>
                        </div>
                        </div>
                        <div class="row mt-2">
                        <div class="container table-responsive">
                            <table class="table  table-striped table-borderless" style="border: 3px solid black;">
                            <thead class="bg-dark text-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">DATE</th>
                                <th scope="col">TIME IN</th>
                                <th scope="col">TIME OUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>October 16, 2022</td>
                                <td>3:00 PM</td>
                                <td>4:30 PM</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>January 16, 2022</td>
                                <td>3:00 PM</td>
                                <td>4:30 PM</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td>September 16, 2022</td>
                                <td>3:00 PM</td>
                                <td>4:30 PM</td>
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