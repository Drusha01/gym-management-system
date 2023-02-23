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
    header('location:../admin_control_log_in2.php');
}

?>



<?php require_once '../includes/header.php';?>
<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <h5 class="col-12 fw-bold mb-3">Offers</h5>
            <div class="row g-2 mb-2 mt-1">
                <div class="col-12 col-sm-4 col-xs-12 form-group table-filter-option">
                    <label>Type</label>
                    <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                        <option value="">All</option>
                        <option value="Gym-Use Subscription">Gym-Use Subscription</option>
                        <option value="Trainer Subscription">Trainer Subscription</option>
                        <option value="Locker Subscription">Locker Subscription</option>
                        <option value="Program Subscription">Program Subscription</option>
                    </select>
                </div>
                <div class="form-group col-12 col-sm-5 table-filter-option">
                    <label for="keyword">Search</label>
                    <input type="text" name="keyword" id="keyword" placeholder="Enter Name of Offer Here" class="form-control ms-md-2">
                </div>

                <?php  if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){?>
                <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
                    <a href="addoffer.php" class="btn btn-success" role="button">Add Offer</a>
                </div>
                <?php }?>
            </div>
                <div class="table-responsive table-container">

                </div>
            </div>
        </div>


    </main>
<script>

$.ajax({
    //
    type: "GET",
    url: 'offertable.php?name_offer='+$('#name_offer').val()+'&offer_type='+$('#offer_type').val(),
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#example").DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            responsive: true,
        });
        $('input#keyword').on('input', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
        })
        $('select#categoryFilter').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([3]).search(status).draw();
        })
        $('select#program').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([3]).search(status).draw();
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