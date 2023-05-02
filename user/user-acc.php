<div class="container-fluid p-3">
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                <?php 
                // query my active / pending subscription
                session_start();
                require_once '../tools/functions.php';
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
                    <div class="d-flex flex-column align-items-center text-center">
                    <a href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150"></a>
                    <div class="mt-3">
                        <h4><?php if(isset($_SESSION['user_name'])){
                        echo_safe($_SESSION['user_name']);}else {echo 'username not set';}?></h4>
                        <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal"><?php if(isset( $gym_use_str)){echo 'Subscribed';}?></span></p>
                        <p class="text-muted font-size-sm"><?php echo $_SESSION['user_address']?></p>
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
            <!-- ito kapag trainer remove mo lng sa taaas -->
            <!-- <div class="card mt-3">
                <div class="pt-3 px-3 text-center">
                    <h5 class="fw-bold">Total Person who Availed</h5>
                </div>
                <div class="row text-center pt-2 pb-3">
                    <i class='bx bxs-group' style="font-size: 75px;"></i>
                    <h4 class="fw-bold">5</h4>
                </div>
            </div> -->
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
                            <div class="col- lg-3">
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
                                <?php echo_safe($_SESSION['user_email']); if(isset($_SESSION['user_email_verified'])){echo '<a class="btn btn-success float-right ms-2" id="view-valid-id">Verified ✓</a>';}else{echo('<a href="email/email-ver-form.php" class="btn btn-success float-right" id="view-valid-id">Verify your email </a>');} ?>
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
                                        <a class="btn btn-success float-right " href="attendance-hist.php?user_id=<?php echo $_SESSION['user_id']?>">More Details</a>
                                    </li>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="container table-responsive">
                                    <table class="table  table-striped table-borderless" style="border: 3px solid black;">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th class="text-center" scope="col">DATE</th>
                                                <th class="text-center" scope="col">TIME IN</th>
                                                <th class="text-center" scope="col">TIME OUT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            require_once('../classes/attendances.class.php');
                                            $attendanceObj = new attendances();

                                            if($attendance_data = $attendanceObj->fetch_5_user_attendances($_SESSION['user_id'])){
                                                $counter=1;
                                                foreach ($attendance_data as $key => $value) {
                                                    echo '
                                            <tr>
                                                <th class="text-center" scope="row">'.$counter.'</th>
                                                <td class="text-center">'.date_format(date_create(($value['attendance_time_in'])), "F d, Y").'</td>
                                                <td class="text-center">'.htmlentities($value['time_in']).'</td>
                                                <td class="text-center">'.htmlentities($value['time_out']).'</td>
                                            </tr>';
                                                $counter++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row gutters-sm">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <h5> Description </h5> 
                                </div>
                                <div class="col-auto">
                                    <button class="badge bg-danger rounded-pill border-0" data-bs-toggle="modal" data-bs-target="#trainerdesc"><i class='bx bx-edit-alt'></i></button>
                                </div>
                            </div>
                            <hr>
                            <p>Hello I am good at calisthenics</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Modal for description -->
            <div class="modal fade" id="trainerdesc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Description</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>    
</div>