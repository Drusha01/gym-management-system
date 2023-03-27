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
    <h5 class="col-12 fw-bold mb-3">Attendance</h5>
    <div class="row pb-3">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword" class="fw-bold">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control ms-md-2">
        </div>
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="datepicker" class="fw-bold">Date</label>
            <input type="text" name="dates"" class="form-control ms-md-2">
        </div>
    </div>
        <div class="table-responsive table-container">

        </div>
    </div>


  </div>
</main>



</body>
<script>
    $('input[name="dates"]').daterangepicker();
</script>
<script>
    $.ajax({
        type: "GET",
        url: 'attend_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#attendance").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
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
</html>