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
        
        if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){
            // query the user information with id
            if(isset($_GET['user_id'])){
                // 
                require_once '../../classes/users.class.php';
                require_once '../../tools/functions.php';
                $userObj = new users();
                $userObj->setuser_id($_GET['user_id']);
                if($user_data = $userObj->get_user_details()){
                    date_default_timezone_set('Asia/Singapore');
                }else{
                    return 'error';
                }
                    
                require_once '../../classes/subscriptions.class.php';
    
                $subscriptionsObj = new subscriptions();
                $subscription_data = $subscriptionsObj->fetchUserActiveAndPendingSubscription($_GET['user_id']);
                if(!$subscription_data){
                   // header('location:avail.php?active=subs');
                }
            }else{
                header('location:avail.php?active=subs');
            }
        }elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
            header('location:avail.php?active=subs');
        }else{
            //do not load the page
            header('location:../dashboard/dashboard.php');
        }

    }else if($_SESSION['admin_user_status_details'] == 'inactive'){
        // do this
    }else if($_SESSION['admin_user_status_details'] == 'deleted'){
        // go to deleted user page
    }

}else{
    // go to admin login
    header('location:../admin_control_log_in2.php');
}

?>



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Activate</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="avail.php?active=subs"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
         </div>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <img src="../../img/profile-resize/<?php echo_safe($user_data['user_profile_picture']);?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4><?php echo_safe($user_data['user_name']);?></h4>
                        <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                        <p class="text-muted font-size-sm"><?php echo_safe($user_data['user_address']); ?></p>
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
                                <?php echo_safe($user_data['user_lastname'].', '.$user_data['user_firstname'].' '.$user_data['user_middlename'])?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_gender_details']); ?>
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
                                <?php echo_safe($user_data['user_address']); ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo_safe($user_data['user_phone_number']); ?>
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
                                <?php echo_safe(getAge($user_data['user_birthdate'])); echo' Years Old'; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                <?php echo_safe($user_data['user_email']); ?>
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
                </div>

                </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
        <?php
            if($subscription_data && $subscription_data[0]['subscription_status_details']  == 'Active'){
                echo '<div class="p-2 bd-highlight"><button type="button" class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#deleteactive">Delete </button></div>';
            }else if($subscription_data && $subscription_data[0]['subscription_status_details']  == 'Pending'){
                echo '<div class="p-2 bd-highlight"><button type="button" class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#delete">Delete </button></div>';
            }

            if($subscription_data && $subscription_data[0]['subscription_status_details']  == 'Active'){
                echo '<div class="p-2 bd-highlight"><a href="../payment/viewpayment.php?user_id='.htmlentities($user_data['user_id']).'&name='.htmlentities($user_data['user_lastname'].', '.$user_data['user_firstname'].' '.$user_data['user_middlename']).'" class="btn btn-outline-success" role="button">Pay</a></div>';
            }else{
                echo '<div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-dark"  role="button" data-bs-toggle="modal" data-bs-target="#activate">Activate </button></div>';
            }
        ?>
        <div class="p-2"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_subs" onclick="getsubscription_data(<?php echo $_GET['user_id'];?>)">Add Subscription</button></div>
        </div>
        <div class="table-responsive table-container">
            <table id="example" class="table table-striped table-bordered" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="col" class="text-center d-none d-lg-table-cell">#</th>
                    <th scope="col">Offer Name</th>
                    <th class="text-center" scope="col">Qty</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Days</th>
                    <th class="text-center" scope="col">Total Days</th>
                    <th class="text-center" scope="col">Calculation</th>
                    <th class="text-center" scope="col">Sub Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $counter =1;
                    foreach ($subscription_data as $key => $value) {
                        echo '
                        <tr>
                            <td class="d-lg-none"></td>
                            <td scope="row" class="text-center d-none d-lg-table-cell">'.htmlentities($counter).'</td>
                            <td>'.htmlentities($value['subscription_offer_name']).'</td>
                            <td class="text-center " >'.htmlentities($value['subscription_quantity']).'</td>
                            <td class="text-center" >₱'.htmlentities(number_format($value['subscription_price'],2)).'</td>
                            <td class="text-center" >'.htmlentities($value['subscription_duration']).'</td>
                            <td class="text-center" >'.htmlentities($value['subscription_total_duration']).'</td>
                            <td class="text-center" >'.htmlentities($value['subscription_quantity'].' X ('.$value['subscription_total_duration'].' / '.$value['subscription_duration']).') X ₱'.number_format($value['subscription_price'],2).'  = </td>
                            <td class="text-center" >₱'.htmlentities(number_format($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']),2)).'</td>';
                       echo'
                        </tr>';
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

  </div>
</main>

<div class="modal fade" id="activate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activate subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row ms-2 ms-lg-5">
            <div class="col-6">
                <label class="pb-1 ms-1" for="end">Choose Date</label>
                <input type="date" class="form-control" value="<?php echo (date("Y-m-d"))?>" min="<?php echo (date("Y-m-d"))?>" id="start_date" name="start_date" placeholder="Enter End Date"  required>
            </div>
            <div class="col-6 d-flex align-items-end ">
                <button class="btn btn-success" onclick="activate_subscription_with_start_date(<?php echo $_GET['user_id'];?>)">Confirm Date</button>
            </div>
        </div>
        <div class="d-flex px-3 pt-3">
            <hr class="my-auto flex-grow-1">
            <div class="px-4">OR</div>
            <hr class="my-auto flex-grow-1">
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-auto d-flex align-items-end">
                Activate the Subscription Now?
            </div>
            <div class="col-auto">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="activateSubscription(<?php echo $_GET['user_id'];?>)">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="deleteSubscription(<?php echo $_GET['user_id'];?>)">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteactive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Are you sure you want to delete the activated subscription?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="deleteActivatedSubscription(<?php echo $_GET['user_id'];?>)">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_subs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subscription</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p class="fs-5">Gym-Use Days Remaining: <span class="fs-5">60</span></p> 
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="type_of_subs">Locker Subscription</label>
                    <select class="form-select" aria-label="Default select example" name="type_of_subs" id="type_of_subs">
                        <option selected>Open this select menu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="col-6 col-lg-1">
                    <label class="" for="gym_use_total_duration">Days</label>
                    <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration">
                </div>
                <div class="col-6 col-lg-1">
                    <label class="" for="gym_use_total_duration">Quantity</label>
                    <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration">
                </div>
                <hr class="d-none d-lg-inline" style="border:none; border-right:1px solid hsla(200, 10%, 50%,100);height:62px;width:1px;">
                <div class="col-6 col-lg-auto d-flex align-items-end pb-3 pb-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        Exact Amount
                        </label>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="" for="priceperday">Price Per Day</label>
                    <input type="number" class="form-control" name="priceperday" min="0" id="priceperday" placeholder="₱00.00">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="type_of_subs">Trainer Subscription</label>
                    <select class="form-select" aria-label="Default select example" name="type_of_subs" id="type_of_subs">
                        <option selected>Open this select menu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1">
                    <label class="" for="gym_use_total_duration">Days</label>
                    <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration">
                </div>
                <hr class="d-none d-lg-inline" style="border:none; border-right:1px solid hsla(200, 10%, 50%,100);height:62px;width:1px;">
                <div class="col-6 col-lg-auto d-flex align-items-end pb-3 pb-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        Exact Amount
                        </label>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="" for="priceperday">Price Per Day</label>
                    <input type="number" class="form-control" name="priceperday" min="0" id="priceperday" placeholder="₱00.00">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="type_of_subs">Search Trainer</label>
                    <select class="form-select" aria-label="Default select example" name="type_of_subs" id="type_of_subs">
                        <option selected>Open this select menu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1 btn-group align-self-end pb-1 py-2" >
                    <button type="button" class="btn btn-sm btn-success"><i class='bx bx-plus-circle pt-1'></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class='bx bx-minus-circle pt-1'></i></button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="type_of_subs">Program Subscription</label>
                    <select class="form-select" aria-label="Default select example" name="type_of_subs" id="type_of_subs">
                        <option selected>Open this select menu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1">
                    <label class="" for="gym_use_total_duration">Days</label>
                    <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration">
                </div>
                <div class="col-12 col-lg-1 btn-group align-self-end pb-3 py-2" >
                    <button type="button" class="btn btn-sm btn-success"><i class='bx bx-plus-circle pt-1'></i></button>
                    <button type="button" class="btn btn-sm btn-danger"><i class='bx bx-minus-circle pt-1'></i></button>
                </div>
                <hr class="d-none d-lg-inline" style="border:none; border-right:1px solid hsla(200, 10%, 50%,100);height:62px;width:1px;">
                <div class="col-6 col-lg-auto d-flex align-items-end pb-3 pb-lg-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        Exact Amount
                        </label>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <label class="" for="priceperday">Price Per Day</label>
                    <input type="number" class="form-control" name="priceperday" min="0" id="priceperday" placeholder="₱00.00">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Add Subscription</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body>
<script>
    function activateSubscription(user_id){
        console.log('activating');
        $.ajax({url: "activate_pendingSubs.php?user_id="+user_id, success: function(result){
            console.log(result);
            if(result ==1){
                // update datatables
                // $( "#offer_id_"+id ).remove();
                // update selected
                alert('activated successfully');
                console.log(result)
            }else{
                alert('activation failed');
                
            }
            location.reload();
        }});
    }

    function deleteSubscription(user_id){
        console.log('deleting');
        $.ajax({
            url: "delete_pendingSubs.php?user_id="+user_id, success: function(result){
            console.log(result);
            if(result ==1){
                // update datatables
                // $( "#offer_id_"+id ).remove();
                // update selected
                alert('deleted successfully');
                window.location.href = "avail.php?active=subs";
                console.log(result)
            }else{
                alert('deletion failed');
                location.reload();
            }
            //location.reload();
        }});
    }
    function deleteActivatedSubscription(user_id){
        console.log('deleting');
        $.ajax({url: "delete_activatedSubs.php?user_id="+user_id, success: function(result){
            console.log(result);
            if(result ==1){
                // update datatables
                // $( "#offer_id_"+id ).remove();
                // update selected
                alert('deleted successfully');
                window.location.href = "avail.php?active=subs";
                console.log(result)
            }else{
                alert('deletion failed');
                location.reload();
            }
            //location.reload();
        }});
    }

    function activate_subscription_with_start_date(user_id){
        var start_date = $('#start_date').val();

        var activate_sub = new FormData();  
        activate_sub.append( 'user_id', user_id);  
        activate_sub.append( 'start_date', start_date);  
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "activate_subscription_with_start_date.php",
            data: activate_sub,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                console.log(result)
                if(result == 1){
                    alert('activated successfully');
                }
                location.reload();
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        "bPaginate": false,
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );



var gym_sub;
var locker_sub;
var trainer_sub;
var program_sub=[];
function getsubscription_data(user_id){
    console.log('nice')
    var getsubscription_data = new FormData();  

    $.ajax({
        type: "GET",
        url: 'get_ActivePendingSubs.php?user_id='+user_id,
        success: function(result)
        {
            
            // parse result
            var subscriptions = JSON.parse(result);
            console.log(subscriptions);
            console.log(Object.keys(subscriptions.subscriptions).length);
            console.log(subscriptions.subscriptions.length);
            // get gym sub
            var sublength = Object.keys(subscriptions.subscriptions).length
            for (let index = 0; index < sublength; index++) {
                if(subscriptions.subscriptions[index].type_of_subscription_details == 'Gym Subscription'){
                    gym_sub = subscriptions.subscriptions[index];
                }else if(subscriptions.subscriptions[index].type_of_subscription_details == 'Locker Subscription'){
                    locker_sub = subscriptions.subscriptions[index];
                }else if(subscriptions.subscriptions[index].type_of_subscription_details == 'Trainer Subscription'){
                    trainer_sub = subscriptions.subscriptions[index];
                }else if(subscriptions.subscriptions[index].type_of_subscription_details == 'Program Subscription'){
                    program_sub.push(subscriptions.subscriptions[index]);
                }
            }
            console.log(gym_sub);
            console.log(locker_sub);
            console.log(trainer_sub);
            console.log(program_sub);
            // get locker sub
            // get trainer sub
            // get program sub
            
            
        }
    });
}
</script>
</html>