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
    <h5 class="col-12 fw-bold mb-3">Payment</h5>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
            <div class="form-group col-12 col-sm-5 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
            </div>
<<<<<<< HEAD
              <div class="table-responsive table-1">
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
                                    foreach ($payments_data as $key => $payments_value) {
                                        $amount += ($payments_value['subscription_price']*$payments_value['subscription_quantity']*($payments_value['subscription_total_duration']/$payments_value['subscription_duration']))+$payments_value['subscription_penalty_due'];
                                        $paid_amount +=$payments_value['subscription_paid_amount'];
                                    }
                                }
                                echo'
                                <td class="d-lg-none"></td>
                                <td class="text-center">'.$counter.'</td>
                                <td class="text-center">'.htmlentities($value['user_fullname']).'</td>
                                <td class="text-center">₱'.htmlentities(number_format($amount,2)).'</td>
                                <td class="text-center">₱'.htmlentities(number_format($paid_amount,2)).'</td>
                                <td class="text-center">₱'.htmlentities(number_format($amount -$paid_amount,2)).'</td>
                                <td class="text-center"><a href="viewpayment.php?user_id='.htmlentities($value['subscription_subscriber_user_id']).'&name='.htmlentities($value['user_fullname']).'" class="btn btn-success btn-sm" role="button">View Payment</a></td>';
                                $counter++;
                            }
                        }
                        ?>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
              </div>
=======
                <div class="table-responsive table-container">
                
                </div>
>>>>>>> branch-a-rob
            </div>
        </div>
    </div>
</main>
<script>
 $.ajax({
    type: "GET",
    url: 'paymenttable.php',
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#table-1").DataTable({
            "dom": 'rtip',
            responsive: true
        });
        $('input#keyword').on('input', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
        })
        new $.fn.dataTable.FixedHeader(dataTable);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }  
});

</script>
</body>
</html>