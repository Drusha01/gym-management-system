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
        if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Modify'){
            
        }else if(isset($_SESSION['admin_locker_restriction_details']) && $_SESSION['admin_locker_restriction_details'] == 'Read-Only'){

        }else{
            header('location:../dashboard/dashboard.php');
        }
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

    <div class="row">
    <h5 class="fw-bold mb-3">Locker</h5>
    <div class="row mb-3">
        <div class="form-group col-12 col-sm-5 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control ms-md-2">
        </div>
        <div class="form-group col-12 col-sm-7 table-filter-option d-grid d-lg-flex justify-content-lg-end pt-2">
            <button href="#" class="btn btn-outline-dark" role="button" data-bs-toggle="modal" data-bs-target="#lockers_availability" id="show_available_lockers">Show Available Lockers</button>
        </div>
    </div>
    <div class="table-responsive table-container">

    </div>

  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Owned Lockers</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal_body_content">
        <ul class="list-group">
            <li class="list-group-item">Locker_2</li>
            <li class="list-group-item">Locker_5</li>
            <li class="list-group-item">Locker_7</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal availability -->
<div class="modal fade" id="lockers_availability" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Locker Availability</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal_body_content_avail">
        <ul class="list-group">
            <li class="list-group-item">Locker_2</li>
            <li class="list-group-item">Locker_5</li>
            <li class="list-group-item">Locker_7</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
    $.ajax({
        type: "GET",
        url: 'locker_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#locker").DataTable({
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

    function showLockers(subscription_id){
      $.ajax({
        type: "GET",
        url: 'get_lockers.php?subscription_id='+subscription_id,
        success: function(result)
        {
            $('#modal_body_content').html(result);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });

    }

    $('#show_available_lockers').click(function (){
        $.ajax({
            type: "GET",
            url: 'available_locker.php',
            success: function(result)
            {
                $('#modal_body_content_avail').html(result);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });
    });

</script>
</html>