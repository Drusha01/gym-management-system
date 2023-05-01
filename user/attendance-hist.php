<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
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
<?php require_once '../includes/header-user.php';?>

<body>
<?php require_once '../includes/header.php';?>
<div class="container-fluid p-3 user-trainer-prof ps-4 pe-5" style="min-height: 500px;">
    <div class="row">
        <h5 class="col-8 col-lg-4 fw-bold pb-4">Attendance Profile</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="user-profile.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a> 
    </div>
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
            <div class="card-body">
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
                <div class="d-flex flex-column align-items-center text-center">
                <a href="../img/profile/<?php echo_safe($_SESSION['user_profile_picture'])?>"><img src="../img/profile-resize/<?php echo_safe($_SESSION['user_profile_picture'])?>" alt="Admin" class="rounded-circle" width="150"></a>
                <div class="mt-3">
                    <h4><?php echo htmlentities($_SESSION['user_name'])?></h4>
                    <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal"><?php if(isset( $gym_use_str)){echo 'Subscribed';}?></span></p>
                        <p class="text-muted font-size-sm"><?php echo $_SESSION['user_address']?></p>
                </div>
                </div>
            </div>
            </div>
        </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label>Minimum Date</label>
                                <input type="text" id="min" name="min" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>Maximum Date</label>
                                <input type="text" id="max" name="max" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive table-container">
                            <table id="example" class="table  table-striped table-borderless" style="width:100%;border: 3px solid black;">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    <th class="d-lg-none"></th>
                                    <th>#</th>
                                    <th>DATE</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    require_once('../classes/attendances.class.php');
                                    $attendanceObj = new attendances();

                                    if($attendance_data = $attendanceObj->fetch_all_user_attendances($_SESSION['user_id'])){
                                        $counter=1;
                                        foreach ($attendance_data as $key => $value) {
                                            echo '
                                    <tr>
                                        <th class="d-lg-none"></th>
                                        <th scope="row">'.$counter.'</th>
                                        <td>'.date_format(date_create(($value['attendance_time_in'])), "F d, Y").'</td>
                                        <td>'.htmlentities($value['time_in']).'</td>
                                        <td>'.htmlentities($value['time_out']).'</td>
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
</div>


</body>
<?php require_once '../includes/footer.php';?>
<script>
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[2] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#example').DataTable({
        "dom": '<"top"f>rt<"bottom"lp><"clear">',
        responsive: true
     });
     
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
     });
 });
</script>
</html>