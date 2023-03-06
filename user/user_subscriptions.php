<div class="container-sub">
    <div class="row g-2 mb-2 ">
        <h5 class="col-12 fw-bold">Current Subscription</h5>
        
        <div class="table-responsive table-1">
        <table id="example" class="table table-striped table-bordered" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Offer Name</th>
                    <th class="text-center" scope="col">Qty</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Days</th>
                    <th class="text-center" scope="col">Start Date</th>
                    <th class="text-center" scope="col">End Date</th>
                    <th class="text-center" scope="col">Sub Total Price</th>
                    <th class="text-center" scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    require_once '../classes/subscriptions.class.php';

                    $subscriptionsObj = new subscriptions();
                    $subscription_data = $subscriptionsObj->fetchUserActiveAndPendingSubscription($_SESSION['user_id']);
                    $counter =1;
                    if($subscription_data){
                        foreach ($subscription_data as $key => $value) {
                            echo '
                            <tr>
                                <th scope="row">'.htmlentities($counter).'</th>';
                            if($value['type_of_subscription_details'] =='Trainer Subscription'){
                                echo ' <td>'.htmlentities($value['subscription_offer_name']).' <a href="user-profile.php?active=trainer-tab"><button type="button" class="btn btn-info" >Trainer Info</button></a></td>';
                            }else{
                                echo ' <td>'.htmlentities($value['subscription_offer_name']).'</td>';
                            }
                            echo' 
                                <td class="text-center " >'.htmlentities($value['subscription_quantity']).'</td>
                                <td class="text-center" >₱'.htmlentities($value['subscription_price']).'</td>
                                <td class="text-center" >'.htmlentities($value['subscription_total_duration']).'</td>';
                            if($value['subscription_status_details'] == 'Active'){
                                echo ' <td class="text-center" >'.htmlentities(date_format(date_create($value['subscription_start_date']), "F d, Y")).'</td>';
                            }else{
                                echo '<td class="text-center" > - - - - - </td>' ;
                            }
                                
                            if(isset($value['subscription_end_date'])){
                                echo ' <td class="text-center" >'.htmlentities(date_format(date_create($value['subscription_end_date']), "F d, Y")).'</td>';
                            }else{
                                echo '<td class="text-center" > - - - - - </td>' ;
                            }

                            echo'
                                <td class="text-center" >'.htmlentities($value['subscription_quantity'].' X ('.$value['subscription_total_duration'].' / '.$value['subscription_duration']).') X ₱'.number_format($value['subscription_price'],2).'  =  ₱'.number_format($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']),2).'</td>';
                            echo '<th class="text-center" scope="col">';
                                if($value['subscription_status_details'] == 'Pending'){
                                echo '<a href="user-cancel-subscription.php?subscription_id='.htmlentities($value['subscription_id']).'"><button class="btn btn-danger btn-sm" >Cancel</button></a>';
                            }else if($value['subscription_status_details'] == 'Active' && $value['subscription_days_to_end']<=5){
                                echo '<button type="button" class="btn btn-success">Renew</button>';
                            }else if($value['subscription_status_details'] == 'Active' && $value['subscription_days_to_end']>5){
                                echo '<button type="button" class="btn btn-secondary">Renew</button>';
                            }else{
                                echo '    <th class="text-center" scope="col">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Deactivate</button>';
                            }
                        echo'
                                
                                </th>
                            </tr>';
                            $counter++;
                        }
                        echo ' </tbody>
                        </table>';
                        echo '  <div class="form-group col-12 col-sm-5 d-grid justify-content-lg-end align-items-end table-filter-option ">
                                    <button class="btn btn-danger"role="button"  disabled>Cancel All</button>
                                    <button class="btn btn-secondary"role="button"  disabled>Renew All</button>
                                </div>';
                    }else{
                        echo '<h4>No Subscription yet!</h4>';
                        echo '<a href="user-avail.php"><button class="btn btn-success"role="button"  >Avail</button></a>';
                    }
                    
                    ?>
                    
                    
                    <!-- <tr>
                        <th scope="row">2</th>
                        <td>Locker Gym</td>
                        <td class="text-center " >1</td>
                        <td class="text-center" >₱1000</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >1 X (60/60) X ₱1000 =</td>
                        <td class="text-center" >₱1000</td>
                        <th class="text-center" scope="col">
                        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Dectivate</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                        </th>
                    </tr> -->
                    
               
            query the completed subscription of this user
            <div class="row g-2 mb-2 ">
            <div class="form-group col-12 col-sm-3 table-filter-option" style="visibility:hidden;">
                <label class="ps-2 pb-2">Type</label>
                <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                    <option value="">All</option>
                    <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                    <option value="Trainer Subscription">Trainer Subscription</option>
                    <option value="Locker Subscription">Locker Subscription</option>
                    <option value="Program Subscription">Program Subscription</option>
                </select>
            </div>
            <div class="form-group col-12 col-sm-4 table-filter-option" style="visibility:hidden;">
                <label for="keyword" class="ps-2 pb-2">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Subscription Here" class="form-control ms-md-2">
            </div>
             <!-- ito kapag malapit na ung expiration -->
            <!-- <div class="form-group col-12 col-sm-5 d-grid justify-content-lg-end align-items-end table-filter-option ">
                <button class="btn btn-success" role="button">Renew</button>
            </div> -->
            <!-- ito kapag bago lng ang subscription -->
            
            
            <!-- ito kapag kaka avail lng ng customer -->
            <!-- <div class="form-group col-12 col-sm-5 d-grid justify-content-lg-end align-items-end table-filter-option ">
                <button class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button>
            </div> -->
        </div>
            <!-- ito kapag wla pa nakapagsubscibe -->
            <!-- <table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                    <th class="col-3">NAME OF SUBSCRIPTION</th>
                    <th class="text-center ">TYPE OF SUBSCRIPTION</th>
                    <th scope="col" class="text-center">DATE SUBSCRIBED</th>
                    <th scope="col" class="text-center">END DATE</th>
                    <th scope="col" class="text-center">DAYS LEFT</th>
                    <th scope="col" class="text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">Not Yet Subscribed Any Offers Yet</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<div class="container-sub">
    <div class="row g-2 mb-2 ">
    <h5 class="col-12 fw-bold">History</h5>
        <div class="form-group col-12 col-sm-3 table-filter-option">
            <label class="ps-2 pb-2">Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                <option value="Trainer Subscription">Trainer Subscription</option>
                <option value="Locker Subscription">Locker Subscription</option>
                <option value="Program Subscription">Program Subscription</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-4 table-filter-option">
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
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                    <td>1-Month Gym-Use (21 and above)</td>
                    <td class="text-center ">Gym-Use Subscription</td>
                    <td class="text-center">October 16, 2022</td>
                    <td class="text-center">November 15, 2022</td>
                    <td class="text-center">Paid</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                    <td>1-Month Trainer</td>
                    <td class="text-center ">Trainer Subscription</td>
                    <td class="text-center">October 16, 2022</td>
                    <td class="text-center">November 15, 2022</td>
                    <td class="text-center">Paid</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">3</th>
                    <td>1-Month Locker</td>
                    <td class="text-center ">Locker Subscription</td>
                    <td class="text-center">October 16, 2022</td>
                    <td class="text-center">November 15, 2022</td>
                    <td class="text-center">Paid</td>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">4</th>
                    <td>----</td>
                    <td class="text-center ">Program Subscription</td>
                    <td class="text-center">----</td>
                    <td class="text-center">----</td>
                    <td class="text-center">----</td>
                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>