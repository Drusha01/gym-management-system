<div class="container">
    <div class="row g-2 mb-2 mt-1">
        <div class="form-group col-12 col-lg-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
        <div class="table-responsive table-container table-2">
            <table id="table-2" class="table table-striped table-borderless" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none d-sm-none" rowspan="2"></th>
                    <th class="text-center align-middle d-none d-sm-table-cell" rowspan="2">#</th>
                    <th class="text-center align-middle" rowspan="2" >USERNAME</th>
                    <th class="text-center align-middle" rowspan="2" >FULL NAME</th>
                    <th class="text-center" colspan="4">SUBSCRIPTION TYPE</th>
                    </tr>
                    <tr>
                    <th class="text-center">Gym-Use</th>
                    <th class="text-center">Trainer</th>
                    <th class="text-center">Locker</th>
                    <th class="text-center">Program</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        require_once '../../classes/subscriptions.class.php';

                        $subscriptionsObj = new subscriptions();

                        $counter =1;
                        if($list_of_ActiveOrPeding_users = $subscriptionsObj->fetchAllActiveOrPendingSubscriptions('Active','Pending','Completed','','')){
                            foreach ($list_of_ActiveOrPeding_users as $key => $value) {
                                echo '<tr>';
                                echo '<td class="d-lg-none d-sm-none"></td>';
                                echo '<td class="text-center d-none d-sm-table-cell">'.$counter.'</td>';
                                echo '<td class="text-center">'.htmlentities($value['user_name']).'</td>';
                                echo '<td class="text-center">'.htmlentities($value['user_fullname']).'</td>';

                                $gym_sub = false;
                                $locker_sub =false;
                                $trainer_sub = false;
                                $program_sub = false;
                                if($user_subscription_data = $subscriptionsObj->fetchAllSubscriptionPerUser_id('Active','Pending','Completed','','',$value['subscription_subscriber_user_id'])){
                                    foreach ($user_subscription_data as $key => $user_subscription_data_value) {
                                        if($user_subscription_data_value['type_of_subscription_details'] =='Gym Subscription'){
                                             $end_date = date_create($user_subscription_data_value['subscription_start_date']);
                                            date_add($end_date, date_interval_create_from_date_string(strval($user_subscription_data_value['subscription_total_duration'])." days"));
                                            $gym_sub =$end_date ;
                                        }elseif($user_subscription_data_value['type_of_subscription_details'] =='Locker Subscription'){
                                            $end_date = date_create($user_subscription_data_value['subscription_start_date']);
                                            date_add($end_date, date_interval_create_from_date_string(strval($user_subscription_data_value['subscription_total_duration'])." days"));
                                            $locker_sub = $end_date;
                                            
                                        }elseif($user_subscription_data_value['type_of_subscription_details'] =='Trainer Subscription'){
                                            $end_date = date_create($user_subscription_data_value['subscription_start_date']);
                                            date_add($end_date, date_interval_create_from_date_string(strval($user_subscription_data_value['subscription_total_duration'])." days"));
                                            $trainer_sub = $end_date;
                                        }elseif($user_subscription_data_value['type_of_subscription_details'] =='Program Subscription'){
                                            $end_date = date_create($user_subscription_data_value['subscription_start_date']);
                                            date_add($end_date, date_interval_create_from_date_string(strval($user_subscription_data_value['subscription_total_duration'])." days"));
                                            $program_sub = $end_date;
                                        }
                                    }
                                }
                                if(($gym_sub)){
                                    echo '<td class="text-center">'.htmlentities(date_format($gym_sub, "F d, Y")).'</td>';
                                }else{
                                    echo '<td class="text-center">None</td>';
                                }
                                if(($trainer_sub)){
                                    echo '<td class="text-center">'.htmlentities(date_format($trainer_sub, "F d, Y")).'</td>';
                                }else{
                                    echo '<td class="text-center">None</td>';
                                }
                                if(($locker_sub)){
                                    echo '<td class="text-center">'.htmlentities(date_format($locker_sub, "F d, Y")).'</td>';
                                }else{
                                    echo '<td class="text-center">None</td>';
                                }
                                if(($program_sub)){
                                    echo '<td class="text-center">'.htmlentities(date_format($program_sub, "F d, Y")).'</td>';
                                }else{
                                    echo '<td class="text-center">None</td>';
                                }
                                
                                
                              
                                echo '</tr>';
                                $counter++;
                            }
                        }
                    
                    ?>
                
                <!-- <tr>
                    <td class="d-lg-none d-sm-none"></td>
                    <td class="text-center d-none d-sm-table-cell">1</td>
                    <td class="text-center">Trinidad, James Lorenz</td>
                    <td class="text-center">Active</td>
                    <td class="text-center">Pending</td>
                    <td class="text-center">Active</td>
                    <td class="text-center">None</td>

                    <td class="text-center"><a href="edit-user.php" class="btn btn-success btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#Modalactivate">Activate</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>

                    </tr> -->

                </tbody>
            </table>
        </div>
    </div>
</div>



