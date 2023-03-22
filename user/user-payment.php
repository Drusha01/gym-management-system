<div class="container-sub">
    <div class="row g-2 mb-2 ">
    <h5 class="col-12 fw-bold">Payment</h5>
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
                    <th class="text-uppercase">Payment Description</th>
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
                echo '<tr>
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
</div>
';
        }else{
            echo '
            <h5>No activated subscription/s yet</h5>
        </div>
    </div>
</div>
 ';
        }
        
        ?>
                    



