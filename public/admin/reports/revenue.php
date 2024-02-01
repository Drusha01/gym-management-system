<div class="table-responsive table-container">
    <table id="table-revenue" class="table table-borderless table-striped" style="width:100%; border: 3px solid black;">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="d-lg-none"></th>
                <th scope="col" class="text-center">Payment ID</th>
                <th scope="col" class="text-center">Full Name</th>
                <th scope="col" class="text-center">Payment amount</th>
                <th scope="col" class="text-center">Payment details</th>
                <th scope="col" class="text-center">Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            require_once('../../classes/payments.class.php');
            $paymentsObj = new payments();

            if($payments_data = $paymentsObj->fetch_reports()){
                foreach ($payments_data as $key => $value) {
                    echo '
                <tr>
                    <th class="d-lg-none"></th>
                    <th class="text-center fw-normal">'.$value['payment_id'].'</th>
                    <th class="text-center fw-normal">'.htmlentities($value['user_fullname']).'</th>
                    <th class="text-center fw-normal">'.htmlentities($value['payment_amount']).'</th>
                    <th class="text-center fw-normal">'.htmlentities($value['payment_type_details']).'</th>
                    <th class="text-center fw-normal">'.htmlentities(date_format(date_create($value['payment_date']), "F d, Y")).'</th>
                </tr>';
                }
            }
            
            ?>
            
        </tbody>
    </table>
</div>
