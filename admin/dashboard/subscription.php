
    <div class="container">
        <div class="row">
            <!-- Start of card -->
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12 pb-2">
                <div class="card rounded-4 border-0 shadow pe-0" style="width: 18rem;">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="text-nowrap">
                            <h5 style="font-size: 18px;">Total Subscriptions for <br>Gym-Use</h5>
                        </div>
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="card-text fs-5 fw-bold">
                                    <?php
                                    require_once('../../classes/subscriptions.class.php');

                                    $subscriptionsObj= new subscriptions();
                                    if($subscription_data = $subscriptionsObj->get_number_of_gym_use()){
                                        if(isset($subscription_data['number_of_gym_use'])){
                                            echo htmlentities($subscription_data['number_of_gym_use']);
                                        }else{
                                            echo '0';
                                        }
                                        
                                    }else{
                                        echo '0';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-6 text-nowrap">
                                <i class='bx bx-dumbbell border-0 p-2 rounded-4' style="position: absolute; top: 40px; right: 40px; background-color: #A5D7E2; color:#2999c1; font-size:50px;"></i>
                            </div>
                        </div>
                        <span class="">As of <?php echo ' ' . date("m-d-Y h:i:s A"); ?></span>
                    </div>
                </div>
            </div>
            <!-- end of card -->

            <!-- Start of card -->
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 pb-2">
                <div class="card rounded-4 border-0 shadow pe-0" style="width: 18rem;">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="text-nowrap">
                            <h5 style="font-size: 18px;">Total Subscriptions for <br>Trainer</h5>
                        </div>
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="card-text fs-5 fw-bold">
                                    <?php 
                                    if($subscription_data = $subscriptionsObj->get_number_of_trainer_use()){
                                        if(isset($subscription_data['number_of_trainer_use'])){
                                            echo htmlentities($subscription_data['number_of_trainer_use']);
                                        }else{
                                            echo '0';
                                        }
                                    }else{
                                        echo '0';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-6 text-nowrap">
                                <i class='bx bx-universal-access border-0 p-2 rounded-4' style="position: absolute; top: 40px; right: 40px; background-color: #F3CB9C; color:#8f6c1c; font-size:50px;"></i>
                            </div>
                        </div>
                        <span class="">As of <?php echo ' ' . date("m-d-Y h:i:s A"); ?></span>
                    </div>
                </div>
            </div>
            <!-- end of card -->

            <!-- Start of card -->
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12  pb-2">
                <div class="card rounded-4 border-0 shadow pe-0" style="width: 18rem;">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="text-nowrap">
                            <h5 style="font-size: 18px;">Total Subscriptions for <br>Locker</h5>
                        </div>
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="card-text fs-5 fw-bold">
                                <?php 
                                    if($subscription_data = $subscriptionsObj->get_number_of_locker_use()){
                                        if(isset($subscription_data['number_of_locker_use'])){
                                            echo htmlentities($subscription_data['number_of_locker_use']);
                                        }else{
                                            echo '0';
                                        }
                                    }else{
                                        echo '0';
                                    }
                                ?>
                                </p>
                            </div>
                            <div class="col-6 text-nowrap">
                                <i class='bx bx-cabinet border-0 p-2 rounded-4' style="position: absolute; top: 40px; right: 40px; background-color: #00D03A; color:#118932; font-size:50px;"></i>
                            </div>
                        </div>
                        <span class="">As of <?php echo ' ' . date("m-d-Y h:i:s A"); ?></span>
                    </div>
                </div>
            </div>
            <!-- end of card -->

            <!-- Start of card -->
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 pb-2">
                <div class="card rounded-4 border-0 shadow pe-0" style="width: 18rem;">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="text-nowrap">
                            <h5 style="font-size: 18px;">Total Subscriptions for <br>Programs</h5>
                        </div>
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="card-text fs-5 fw-bold">
                                <?php 
                                    if($subscription_data = $subscriptionsObj->get_number_of_program_use()){
                                        if(isset($subscription_data['number_of_program_use'])){
                                            echo htmlentities($subscription_data['number_of_program_use']);
                                        }else{
                                            echo '0';
                                        }
                                    }else{
                                        echo '0';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-6 text-nowrap">
                                <i class='bx bx-calendar-star border-0 p-2 rounded-4' style="position: absolute; top: 40px; right: 40px; background-color: #EA87EC; color:#8a4b8d; font-size:50px;"></i>
                            </div>
                        </div>
                        <span class="">As of <?php echo ' ' . date("m-d-Y h:i:s A"); ?></span>
                    </div>
                </div>
            </div>
            <!-- end of card -->

            <!-- Start of card -->
            <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 pb-2">
                <div class="card rounded-4 border-0 shadow pe-0" style="width: 18rem;">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="text-nowrap">
                            <h5 style="font-size: 18px;">Available Lockers <br> Left</h5>
                        </div>
                        <div class="row pb-3">
                            <div class="col-6">
                                <p class="card-text fs-5 fw-bold">
                                <?php 
                                    require_once('../../classes/number_of_lockers.class.php');
                                    $number_of_lockersObj = new number_of_lockers();

                                    
                                    if($subscription_data = $subscriptionsObj->get_number_of_locker_use()){
                                        if($number_of_lockers_data = $number_of_lockersObj->get_number_of_lockers()){
                                            echo htmlentities($number_of_lockers_data['locker_number'] - $subscription_data['number_of_locker_use']);
                                        }else{
                                            echo 'error';
                                        }
                                        
                                    }else{
                                        echo '0';
                                    }
                                ?>
                                </p>
                            </div>
                            <div class="col-6 text-nowrap">
                                <i class='bx bx-cabinet border-0 p-2 rounded-4' style="position: absolute; top: 40px; right: 40px; background-color: #00D03A; color:#118932; font-size:50px;"></i>
                            </div>
                        </div>
                        <span class="">As of <?php echo ' ' . date("m-d-Y h:i:s A"); ?></span>
                    </div>
                </div>
            </div>
            <!-- end of card -->
        </div>
    </div>