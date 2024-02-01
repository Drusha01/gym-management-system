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
        // do nothing
        if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
            if(isset($_GET['subscription_id']) && intval($_GET['subscription_id'])>0){
                require_once '../../classes/lockers.class.php';
                require_once '../../classes/subscriptions.class.php';

                
                $lockerObj = new lockers();
                $subscriptionsObj = new subscriptions();
                $user_data = $subscriptionsObj->get_user_details_with_subscription_id($_GET['subscription_id']);
                $locker_data = $lockerObj->fetch_lockers_id($_GET['subscription_id']);
                $lockerlist = $lockerObj->fetch_all_lockers();
            }
            
        }else if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){
            header('location:locker.php');
        }else{
            header('location:../dashboard/dashboard.php');
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
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Edit Locker</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="locker.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="container">
            <h5 class="fw-bold fs-5">Customer: <span class="fw-light fs-5"><?php if($user_data){echo $user_data['user_fullname'];}?></span></h5>
            <div class="col-12 col-lg-6">
            <table class="table table-striped table-borderless" style="width:100%; border: 3px solid black;">
                <thead class="table-dark">
                    <tr>
                    <th class="text-center">LOCKER ID</th>
                    <th class="text-center col-5">CHANGE LOCKER</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                require_once('../../classes/admin_settings.class.php');
                $settingObj = new admin_settings();
                $setting_data = $settingObj->fetch_one();
                if($locker_data){
                    foreach ($locker_data as $key => $value) {
                        echo 
                        '
                    <tr>
                        <td class="text-center">Locker_'.$value['locker_UID'].'</td>

                        <td class="text-center">';
                        $found = false;
                        $locker_uid =1;
                        while($locker_uid<$setting_data['setting_num_of_lockers']){
                            $avail = true;
                            foreach ($lockerlist as $key => $locker_list_item) {
                                if($locker_list_item['locker_UID'] == $locker_uid){
                                    $avail = false;
                                }
                            }
                            if($avail){

                                if(!$found){
                                    echo '
                            <select class="form-select form-select-sm" name="users" id="locker_id_'.$value['locker_id'].'" onchange="update_locker_UID('.$value['locker_id'].')" style="width:100%;">
                                <option value="None" >Select Locker</option>';
                                $found =true;
                                }
                               echo '
                                <option value="'. $locker_uid.'" >Locker_'.$locker_uid.'</option> ';
                            }
                            $locker_uid++;
                        }
                    
                        
                            
                        echo '
                            </select>
                        </td>
                    </tr>';
                    }
                }
                ?>
                </tbody>
            </table>
            </div>
            <!-- <div class="row d-flex flex-row-reverse">
                <div class="col-12  d-grid d-lg-flex pt-3 pt-lg-1">
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_offer" value="add_offer" id="submit" >Save</button>
                </div>
            </div> -->
        </div>
  </div>
</main>

<script>
function update_locker_UID(locker_id){
    var locker = new FormData();  
    // validation
    locker.append( 'locker_id', locker_id);  
    locker.append( 'locker_UID', $('#locker_id_'+locker_id).val());  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "update_locker.php",
        data: locker,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          console.log(result);
          if(result == 1){
            //reload
            location.reload();
          }else{
            alert('Error updating locker_UID');
          }
          
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
}
</script>
</body>

</html>