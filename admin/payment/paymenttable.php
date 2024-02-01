<table id="table-1" class="table table-striped table-bordered nowrap" style="width:100%;border: 2px solid grey;">
    <thead class="table-light">
        <tr>
            <th class="d-lg-none"></th>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Total Amount</th>
            <th class="text-center">Total Paid</th>
            <th class="text-center">Total Balance</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    require_once '../../classes/subscriptions.class.php';

    $subscriptionsObj = new subscriptions();

    $counter =1;
    if($list_of_ActiveOrPeding_users = $subscriptionsObj->fetchAllActiveOrPendingSubscriptions('Active','','','','')){
        $counter=1;
        foreach ($list_of_ActiveOrPeding_users as $key => $value) {
            // fetch subscription data
            if($payments_data = $subscriptionsObj->fetch_active_subs_payment($value['subscription_subscriber_user_id'])){
                $amount =0;
                $paid_amount = 0;
                $discount =0;
                $payment_due=0;
                foreach ($payments_data as $key => $payments_value) {
                    $amount += ($payments_value['subscription_price']*$payments_value['subscription_quantity']*($payments_value['subscription_total_duration']/$payments_value['subscription_duration']))+$payments_value['subscription_penalty_due'];
                    $paid_amount +=$payments_value['subscription_paid_amount'];
                    $discount +=$payments_value['subscription_discount'];
                    $payment_due +=$payments_value['subscription_penalty_due'];
                }
            }
            echo'
            <tr>
            <td class="d-lg-none"></td>
            <td class="text-center">'.$counter.'</td>
            <td class="text-center">'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center">₱'.htmlentities(number_format($amount,2)).'</td>
            <td class="text-center">₱'.htmlentities(number_format($paid_amount,2)).'</td>
            <td class="text-center">₱'.htmlentities(number_format($amount -$paid_amount-$discount+$payment_due,2)).'</td>
            <td class="text-center"><a href="viewpayment.php?user_id='.htmlentities($value['subscription_subscriber_user_id']).'&name='.htmlentities($value['user_fullname']).'" class="btn btn-success btn-sm" role="button">View Payment</a></td>';
            echo '</tr>';
            $counter++;
        }
    }
    ?>
    </tbody>
</table>