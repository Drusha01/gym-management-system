<div class="d-flex justify-content-end">
    <ul class="nav mb-1" id="pills-tab" role="tablist">
    <li class="nav-item px-1" role="presentation">
        <button class="btn btn-outline-dark active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Subscription <i class='bx bx-calendar fs-4'style="font-size:30px; vertical-align: middle;"></i></button>
    </li>
    <li class="nav-item px-1" role="presentation">
        <button class="btn btn-outline-dark" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">History <i class='bx bx-history fs-4' style="font-size:30px; vertical-align: middle;"></i></button>
    </li>
    </ul>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- subs -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

    <!-- current subs -->
    <div class="container-sub">
        <div class="row g-2 mb-2">

<?php 
// query my active / pending subscription

    require_once('../classes/subscriptions.class.php');
    $subscriptionsObj = new subscriptions();

    if($subscription_data = $subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id'])){
        if($subscription_data[0]['subscription_status_details'] == 'Pending'){
            echo '
            <div class="row g-2 mb-2 ">
                <h5>Wait for the Admin to activate your availed Subscriptions.</h5>    
            ';
            echo '<div class="form-group col-12 d-grid justify-content-lg-end align-items-end table-filter-option ">
                    <button class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel All</button>
                </div>';
        }
        // check the subs if active
        if($subscription_data){
            echo '<h5 class="col-12 fw-bold">Current Subscription</h5>';
            echo '<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">

                    <thead class="bg-dark text-light">
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                        <th class="col-3">NAME OF SUBSCRIPTION</th>
                        <th class="text-center ">TYPE OF SUBSCRIPTION</th>
                        <th class="text-center">QUANTITY</th>
                        <th class="text-center">START DATE</th>
                        <th class="text-center">END DATE</th>
                        <th class="text-center">DAYS LEFT</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $counter=1;
            foreach ($subscription_data as $key => $value) {
                    $end_date = date_create($value['subscription_start_date']);
                    date_add($end_date, date_interval_create_from_date_string(strval($value['subscription_total_duration'])." days"));
                    if(intval($value['subscription_days_to_end'])>0){
                        echo '<tr>
                        <th class="d-lg-none"></th>
                            <th scope="row" class="text-center d-none d-sm-table-cell">'.$counter.'</th>
                            <td>'.htmlentities($value['subscription_offer_name']).'</td>
                            <td class="text-center ">'.htmlentities($value['type_of_subscription_details']).'</td>
                            <td class="text-center ">'.htmlentities($value['subscription_quantity']).'</td>
                            <td class="text-center ">'.htmlentities(date_format(date_create($value['subscription_start_date']), "F d, Y")).'</td>
                            <td class="text-center ">'.htmlentities(date_format($end_date, "F d, Y")).'</td>
                            <td class="text-center ">'.htmlentities($value['subscription_days_to_end']).'</td>
                            <td class="text-center ">'.htmlentities($value['subscription_status_details']).'</td>
                            <td class="text-center "><button class="btn btn-danger btn-sm" role="button" data-bs-toggle="modal" data-bs-target="#cancelspecificModal">Cancel</button></td>
                            </tr>';
                    }else{
                        echo '<tr>
                        <th class="d-lg-none"></th>
                            <th scope="row" class="text-center d-none d-sm-table-cell">'.$counter.'</th>
                            <td>'.htmlentities($value['subscription_offer_name']).'</td>
                            <td class="text-center ">'.htmlentities($value['type_of_subscription_details']).'</td>
                            <td class="text-center ">'.htmlentities($value['subscription_quantity']).'</td>
                            <td class="text-center ">'.htmlentities(date_format(date_create($value['subscription_start_date']), "F d, Y")).'</td>
                            <td class="text-center ">'.htmlentities(date_format($end_date, "F d, Y")).'</td>
                            <td class="text-center ">'.htmlentities(0).'</td>
                            <td class="text-center ">'.htmlentities($value['subscription_status_details']).'</td>
                            </tr>';
                    }
                
                $counter++;
                
            }
            echo ' </tbody>
            </table>

           </div>
       </div>
   ';
        }
        

    }else{
        echo '
            <div class="row g-2 mb-2">
                <h5>You still haven\'t availed any of our offers.</h5>
                <div class="form-group col-12 ">
                    <a class="btn btn-success" role="button" href="user-avail.php">Avail Now</a>
                </div>
            </div>
        </div>
    </div>';
    }

?>
  </div>

 <!-- end of subs -->
    <!-- history -->
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="container-sub">
        <div class="row g-2 mb-2 ">
            <div class="form-group col-12 col-lg-3 table-filter-option">
                <label class="ps-2 pb-2">Type</label>
                <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                    <option value="">All</option>
                    <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                    <option value="Trainer Subscription">Trainer Subscription</option>
                    <option value="Locker Subscription">Locker Subscription</option>
                    <option value="Program Subscription">Program Subscription</option>
                </select>
            </div>
            <div class="form-group col-12 col-lg-4 table-filter-option">
                <label for="keyword" class="ps-2 pb-2">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Subscription Here" class="form-control ms-md-2">
            </div>
            
            <div class="table-responsive table-1">
                <table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">
                    <thead class="bg-dark text-light">
                        <tr>
                        <th class="d-lg-none"></th>
                        <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                        <th class="col-3">NAME OF SUBSCRIPTION</th>
                        <th class="text-center ">TYPE OF SUBSCRIPTION</th>
                        <th scope="col" class="text-center">DATE SUBSCRIBED</th>
                        <th scope="col" class="text-center">END DATE</th>
                        <th scope="col" class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($subscription_data = $subscriptionsObj->fetch_history($_SESSION['user_id'])){
                                $counter=1;
                                foreach ($subscription_data as $key => $value) {
                                    $end_date = date_create($value['subscription_start_date']);
                                    date_add($end_date, date_interval_create_from_date_string(strval($value['subscription_total_duration'])." days"));
                                    $end_date;
                                    echo '
                                    <tr>
                                    <th class="d-lg-none"></th>
                                    <th scope="row" class="text-center d-none d-sm-table-cell">'.$counter.'</th>
                                    <td>'.htmlentities($value['subscription_offer_name']).'</td>
                                    <td class="text-center ">'.htmlentities($value['type_of_subscription_details']).'</td>
                                    <td class="text-center">'.htmlentities(date_format(date_create($value['subscription_start_date']), "F d, Y")).'</td>
                                    <td class="text-center">'.htmlentities(date_format($end_date, "F d, Y")).'</td>
                                    <td class="text-center">Paid</td>
                                    </tr>';
                                }


                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
  <!-- end of history -->
</div>
<!-- modal cancel specific-->
<div class="modal fade" id="cancelspecificModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Availed Offer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel this (offer_name)?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- modal cancel-->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Availed Offer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="cancelPendingSubs(<?php echo $_SESSION['user_id']?>)">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<script>
    function cancelPendingSubs(user_id){
        console.log('cancel subs');
        $.ajax({url: "delete_pendingSubs.php?user_id="+user_id, success: function(result){
            console.log(result);
            if(result ==1){
                // update datatables
                // $( "#offer_id_"+id ).remove();
                // update selected
                alert('canceled successfully');
                console.log(result)
            }else{
                alert('deletion failed');
            }
            location.reload();
        }});
    }

</script>

<!-- modal add more-->
<!-- <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add More Days</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10 col-lg-8 py-1">
                    <label class="fw-bold pb-2 ps-1">Gym-Use Subscription</label>
                    <select class="form-select" aria-label="Default select example" name="gym_subscription" id="gym_use" onchange="updateGymUseModal()">
                    <option value="0" name=""selected >Select Gym subscription</option>
                        <?php 
                            // requre
                            // require_once '../classes/offers.class.php';
                            // require_once '../tools/functions.php';
                            // // instance
                            // $offersObj = new offers();

                            // // fetch
                            // if($data_result = $offersObj->select_offers_per_sub_type('Gym Subscription')){
                            //     foreach ($data_result as $key => $value) {
                            //         if($value['status_details'] =='active'){
                            //             echo '<option value="';echo_safe($value['offer_id']);echo '" id="gym-use-'.htmlentities($value['offer_id']).'" name=\''.json_encode($value).'\'  duration="'.htmlentities($value['offer_duration']).'">';echo_safe($value['offer_name']);echo ' (₱';echo_safe($value['offer_price']);echo') DAYS('.htmlentities($value['offer_duration']).')</option>';
                            //         }
                            //     }
                            // }
                        ?>
                    </select>
                    
                </div>
                <div class="col-2 col-lg-1 align-self-end mb-2">
                    <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#exampleModal"><strong>?</strong></button>
                </div>

                <div class="col-4 col-md-2 py-1 ">
                    <label class="fw-bold pb-2 ps-1">Days</label>
                    <input type="number" class="form-control" name="gym_use_total_duration" min="0" id="gym_use_total_duration" onchange="gym_use_total_durationChange()">
                </div>

            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9998;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gym-Use Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="../images/home-1.jpg" class="img-fluid">
                </div>
                <div class="col-12 col-lg-6 pt-3 pt-lg-0">
                    <h5 class="fw-bold text-wrap">1 Month Gym-Use (21 and Above)</h5>
                    <p>Get fit and feel great with our one-month gym membership offer!
                            Enjoy full access to our state-of-the-art gym facilities,
                            expert staff, and group fitness classes to help you reach your
                            fitness goals. Sign up now and take the first step towards a healthier you!</p>
                </div>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-center">
                <div class="row text-center">
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Age Qualification <span class="fw-normal">21 and Above</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Slots <span class="fw-normal">Unlimited</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Days <span class="fw-normal">60</span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="fw-bold">Price <span class="fw-normal">₱800.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div> -->
<!-- End of Modal -->