<table id="table-1" class="table table-striped table-bordered nowrap" style="width:100%;border: 2px solid grey;">
    <thead class="table-light">
        <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">#</th>
            <th class="text-center">Username</th>
            <th class="text-center">Name</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            require_once('../../classes/payments.class.php');
            $paymentsObj = new payments();

            if($payments_data = $paymentsObj->fetch_all_paid()){
                $counter=1;
                foreach ($payments_data as $key => $value) {
                    echo '
        <tr>
            <td class="d-lg-none"></td>
            <td class="text-center d-none d-sm-table-cell">'.$counter.'</td>
            <td class="text-center">'.htmlentities($value['user_name']).'</td>
            <td class="text-center">'.htmlentities($value['user_fullname']).'</td>
            <td class="text-center"><a class="btn btn-primary btn-sm" href="payment_hist.php?user_id='.$value['user_id'].'">Payment History</a></td>
        </tr>';
                     $counter++;
                }
               
            }
        ?>
        
     
    </tbody>
</table>