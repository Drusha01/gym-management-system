<div class="container-sub">
    <div class="row g-2 mb-2 ">
        <h5 class="col-12 fw-bold">Payment</h5>
        <div class="d-flex justify-content-end">
            <ul class="nav mb-1" id="pills-tab" role="tablist">
            <li class="nav-item px-1" role="presentation">
                <button class="btn btn-outline-dark active" id="pills-pay-tab" data-bs-toggle="pill" data-bs-target="#pills-pay" type="button" role="tab" aria-controls="pills-pay" aria-selected="true">Payment <i class='bx bx-money fs-4'style="font-size:30px; vertical-align: middle;"></i></button>
            </li>
            <li class="nav-item px-1" role="presentation">
                <button class="btn btn-outline-dark" id="pills-hist-tab" data-bs-toggle="pill" data-bs-target="#pills-hist" type="button" role="tab" aria-controls="pills-hist" aria-selected="false">History <i class='bx bx-history fs-4' style="font-size:30px; vertical-align: middle;"></i></button>
            </li>
            </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
    <!-- subs -->
            <div class="tab-pane fade show active" id="pills-pay" role="tabpanel" aria-labelledby="pills-pay-tab">
                <div class="table-responsive table-1">
                <?php 
                require_once('../classes/subscriptions.class.php');
                $subscriptionsObj = new subscriptions();

                if($payments_data = $subscriptionsObj->fetch_active_subs_payment($_SESSION['user_id'])){
                    echo '
                    <table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%; border: 3px solid black;">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="text-center text-uppercase">Payment Description</th>
                                <th class="text-center text-uppercase">Amount</th>
                                <th class="text-center text-uppercase">Discount</th>
                                <th class="text-center text-uppercase">Penalties Due</th>
                                <th class="text-center text-uppercase">Paid Amount</th>
                                <th class="text-center text-uppercase">Balance</th>
                            </tr>
                        </thead>
                        <tbody>';
                    $counter=1;
                    $total_balance = 0;
                    foreach ($payments_data as $key => $value) {
                        $amount = ($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']))+$value['subscription_penalty_due'];
                        if($value['subscription_discount']<=0){
                            $subscription_discount = 'None';
                        }else{
                            $subscription_discount = htmlentities('₱'.number_format($value['subscription_discount'],2));
                        }
                        if($value['subscription_penalty_due']<=0){
                            $subscription_penalty_due = 'None';
                        }else{
                            $subscription_penalty_due = htmlentities('₱'.number_format($value['subscription_penalty_due'],2));
                        }
                        echo '
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">'.htmlentities($counter).'</td>
                                <td class="">'.htmlentities($value['subscription_offer_name']).'</td>
                                <td class="text-center">₱'.htmlentities(number_format($amount,2)).'</td>
                                <td class="text-center">'.$subscription_discount.'</td>
                                <td class="text-center">'.$subscription_penalty_due.'</td>
                                <td class="text-center">₱'.htmlentities(number_format($value['subscription_paid_amount'],2)).'</td>';
                                if(($amount+$value['subscription_penalty_due']-$value['subscription_discount']-$value['subscription_paid_amount'])>0){
                                    echo ' <td class="text-center">₱'.htmlentities(number_format(($amount+$value['subscription_penalty_due']-$value['subscription_discount']-$value['subscription_paid_amount']),2)).'</td>';
                                }else{
                                    echo ' <td class="text-center">PAID</td>';
                                }
                            echo'
                            </tr>';
                        $total_balance+=$amount+$value['subscription_penalty_due']-$value['subscription_discount']-$value['subscription_paid_amount'];
                        $counter++;

                        // trigger for updating the subscription !!! note that it must paid fully, and days left is negative or 0
                    }

                            echo '     
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end pe-4">
                    <p class="fw-bold fs-5">Total Balance: <span class="fw-normal">';
                    if($total_balance>0){
                        echo '₱'.number_format($total_balance,2);
                    }else{
                        echo'PAID';
                    }
                    echo '</span></p>
                </div>
            </div>
                            ';
                }else{
                    echo '
                    <h5>No activated subscription/s yet</h5>
                </div>
            </div>
        ';
        }
                ?>
        <div class="tab-pane fade show" id="pills-hist" role="tabpanel" aria-labelledby="pills-hist-tab">
            <div class="row pb-3">
                <div class="form-group col-12 col-lg-4 table-filter-option">
                    <label for="keyword" class="ps-2 pb-2">Search</label>
                    <input type="text" name="keyword" id="keyword" placeholder="Enter Order ID Here" class="form-control ms-md-2">
                </div>
                <div class="form-group col-12 col-lg-3 table-filter-option">
                    <label class="ps-2 pb-2">Offer</label>
                    <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                        <option value="">All</option>
                        <option value="Subscription">Subscription</option>
                        <option value="Walk-In">Walk-In</option>
                    </select>
                </div>
                <div class="form-group col-12 col-lg-3 table-filter-option">
                    <label class="ps-2 pb-2">Payment</label>
                    <select name="categoryFilter_2" id="categoryFilter_2" class="form-select ms-md-2">
                        <option value="">All</option>
                        <option value="Full Payment">Full Payment</option>
                        <option value="Partial Payment">Partial Payment</option>
                        <option value="Void Payment">Void Payment</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive table-container tbl-hist-paid">

            </div>
        </div>
    </div>
</div>  




