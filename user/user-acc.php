<!-- start of container -->
<div class="container-fluid p-3">
    <!-- start of row -->
    <div class="row gutters-sm">
        <!-- start of col -->
        <div class="col-md-4 mb-3">
        <!-- card -->
            <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                <a href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150"></a>
                <div class="mt-3">
                    <h4><?php echo_safe($_SESSION['user_name'])?></h4>
                    <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Subscribed</span></p>
                    <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                </div>
                </div>
            </div>
            </div>
            <!-- end of card -->

        <!-- card -->
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
        <!-- end of card -->
        </div>
        <!-- end of col -->
        <!-- start of col -->
        <div class="col-md-8">
            <!-- start of card -->
            <div class="card mb-3">
                <!-- start of card body -->
                <div class="card-body">
                    <!-- start of row -->
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
                    <!-- end of row -->
                    <hr>
                    <!-- start of row -->
                    <div class="row">
                        <!-- start of col -->
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
                        <!-- end of col -->
                        <!-- start of col -->
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($_SESSION['user_phone_number']) ?>
                            </div>
                        </div>
                        <!-- end of col -->
                    </div>
                    <!-- end of row -->

                    <hr>

                    <!-- start of row -->
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
                    <!-- end of row -->

                    <hr>

                    <!-- start of row -->
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
                    <!-- end of row -->

                    <hr>

                    <!-- start of row -->
                    <div class="row px-3 ">
                    <div class="col-7">
                        <li class="list-group-item d-flex">
                        <a class="btn btn-success float-right" id="view-valid-id" href="<?php echo_safe('../img/valid-id/'.$_SESSION['user_valid_id_photo'])?>">View Valid ID</a>
                        </li>
                    </div>
                    <div class="col">
                        <li class="list-group-item d-flex flex-row-reverse flex-wrap">
                            <a class="btn btn-primary float-right " href="user-edit.php">MODIFY</a>
                        </li>
                    </div>
                    </div>
                    <!-- end of row -->

                </div>
                <!-- end of card body -->
            </div>
            <!-- end of card -->
        </div>
        <!-- end of col -->
    </div>
    <!-- end of row -->
</div>
<!-- end of container -->