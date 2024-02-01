<?php 
session_start();
if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>

<table id="table-1" class="table table-bordered table-striped display" style="width:100%;border: 3px solid black;">
    <thead class="table-dark ">
        <tr>
        <th class="d-lg-none d-sm-none"></th>
        <th class="text-center align-middle d-none d-sm-table-cell">#</th>
        <th class="text-center align-middle">USERNAME</th>
        <th class="text-center align-middle">FULL NAME</th>
        <th class="text-center">Gym-Use</th>
        <th class="text-center">Trainer</th>
        <th class="text-center">Locker</th>
        <th class="text-center">Program</th>
        <?php if($_SESSION['admin_avail_restriction_details'] =='Modify'){
        echo '<th class="text-center align-middle">ACTION</th>';
        }
        ?>
       
        </tr>
    </thead>
    <tbody>
        <?php
            require_once '../../classes/subscriptions.class.php';

            $subscriptionsObj = new subscriptions();

            $counter =1;
            if($list_of_ActiveOrPeding_users = $subscriptionsObj->fetchAllActiveOrPendingSubscriptions('Active','Pending','','','')){
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
                    if($user_subscription_data = $subscriptionsObj->fetchAllSubscriptionPerUser_id('Active','Pending','','','',$value['subscription_subscriber_user_id'])){
                        $gym_sub_total = 0;
                        $locker_sub_total = 0;
                        $trainer_sub_total = 0;
                        $program_sub_total = 0;
                        foreach ($user_subscription_data as $key => $user_subscription_data_value) {
                            if($user_subscription_data_value['subscription_days_to_end']<=0 && $user_subscription_data_value['balance'] -  $user_subscription_data_value['subscription_paid_amount']<=0){
                                // check if paid. 
                                $user_subscription_data_value['subscription_status_details'] = 'Completed';
                                echo $user_subscription_data_value['subscription_days_to_end'] = 'Completed';
                                // update subscription
                                $subscriptionsObj->complete_active_subscriptions($user_subscription_data_value['subscription_id']);
                                

                            // update subscription
                            }
                            if($user_subscription_data_value['type_of_subscription_details'] =='Gym Subscription'){
                                $gym_sub = true ;
                                $gym_sub_total += $user_subscription_data_value['subscription_quantity'];
                                
                            }elseif($user_subscription_data_value['type_of_subscription_details'] =='Locker Subscription'){
                                $locker_sub = true ;
                                $locker_sub_total += $user_subscription_data_value['subscription_quantity'];
                            }elseif($user_subscription_data_value['type_of_subscription_details'] =='Trainer Subscription'){
                                $trainer_sub = true ;
                                $trainer_sub_total += $user_subscription_data_value['subscription_quantity'];
                            }elseif($user_subscription_data_value['type_of_subscription_details'] =='Program Subscription'){
                                $program_sub = true ;
                                $program_sub_total += $user_subscription_data_value['subscription_quantity'];
                            }
                        }
                    }
                    if(($gym_sub)){
                        echo '<td class="text-center">'.htmlentities($user_subscription_data_value['subscription_status_details'].'('.$gym_sub_total.')').'
                        <br>'.htmlentities(date_format(date_create($user_subscription_data_value['subscription_start_date']), "F d, Y")).'</td>';
                    }else{
                        echo '<td class="text-center">None</td>';
                    }
                    if(($trainer_sub)){
                        echo '<td class="text-center">'.htmlentities($user_subscription_data_value['subscription_status_details'].'('.$trainer_sub_total.')').'
                        <br>'.htmlentities(date_format(date_create($user_subscription_data_value['subscription_start_date']), "F d, Y")).'</td>';
                    }else{
                        echo '<td class="text-center">None</td>';
                    }
                    if(($locker_sub)){
                        echo '<td class="text-center">'.htmlentities($user_subscription_data_value['subscription_status_details'].'('.$locker_sub_total.')').'
                        <br>'.htmlentities(date_format(date_create($user_subscription_data_value['subscription_start_date']), "F d, Y")).'</td>';
                    }else{
                        echo '<td class="text-center">None</td>';
                    }
                    if(($program_sub)){
                        echo '<td class="text-center">'.htmlentities($user_subscription_data_value['subscription_status_details'].'('.$program_sub_total.')').'
                        <br>'.htmlentities(date_format(date_create($user_subscription_data_value['subscription_start_date']), "F d, Y")).'</td>';
                    }else{
                        echo '<td class="text-center">None</td>';
                    }
                    if($_SESSION['admin_avail_restriction_details'] =='Modify'){
                        echo ' <td class="text-center"><a href="activate.php?user_id='.($value['subscription_subscriber_user_id']).'" class="btn btn-primary btn-sm" role="button">Manage</a>  </td>';
                    }
                    
                    echo '</tr>';
                    $counter++;
                }
            }
        ?>
    </tbody>
</table>