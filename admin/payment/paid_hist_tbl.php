<table id="hist" class="table table-striped table-bordered nowrap" style="width:100%;border: 2px solid grey;">
    <thead class="table-light">
        <tr>
            <th class="d-lg-none"></th>
            <th class="text-center">Oder_ID</th>
            <th class="text-center">Type of Offer</th>
            <th class="text-center">Amount Paid</th>
            <th class="text-center">Type of Payment</th>
            <th class="text-center">Date Paid</th>
    
        </tr>
    </thead>
    <tbody>
    <?php 
            require_once('../../classes/payments.class.php');
            $paymentsObj = new payments();
            if($payments_data = $paymentsObj->fetch_all_paid_by_user($_GET['user_id'])){
                $counter =1;
                foreach ($payments_data as $key => $value) {
                    echo '
        <tr>
            <td class="d-lg-none"></td>
            <td class="text-center">'.htmlentities( $value['payment_id']).'</td>
            <td class="text-center">'.htmlentities( $value['type_of_subscription_details']).'</td>
            <td class="text-center">₱'.htmlentities(number_format($value['payment_amount'],2)).'</td>
            <td class="text-center">'.htmlentities( $value['payment_type_details']).'</td>
            <td class="text-center">'.htmlentities(date_format(date_create($value['payment_date']), "F d, Y")).'</td>
           
        </tr>';
                }
            }
    ?>
       

       
    </tbody>
</table>