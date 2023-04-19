<?php
// start session
session_start();



if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
  header('location:../admin.php?active='.basename(__DIR__,1)); 
}

// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        
        if(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Modify'){
            
        }else if(isset($_SESSION['admin_attendance_restriction_details']) && $_SESSION['admin_attendance_restriction_details'] == 'Read-Only'){

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



<div class="w-100">
  <h5 class="col-12 fw-bold mb-3">Attendance</h5>
  <div class="row pb-3">
      <div class="form-group col-12 col-sm-4 table-filter-option">
          <label for="keyword" class="fw-bold">Search</label>
          <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control ms-md-2">
      </div>
      <div class="form-group col-12 col-sm-4 table-filter-option">
          <label for="datepicker" class="fw-bold">Date</label>
          <input type="text" name="dates" class="form-control ms-md-2">
      </div>
  </div>
      <div class="table-responsive table-container">

      </div>
  </div>


</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Force Time-Out</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="time" class="form-control">
        <div class="d-flex py-2">
            <hr class="my-auto flex-grow-1">
            <div class="px-4">OR</div>
            <hr class="my-auto flex-grow-1">
        </div>
      </div>
      <div class="container ms-3 pb-3 text-center">
        Force Time-Out Now: <button class="btn btn-outline-dark btn-sm">Force Time-Out</button>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal del -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Attendance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete the Attendance of <span id="cust_name">Customer Name?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="confirm_delete_modal">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="attendance_delete_modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
    $('input[name="dates"]').daterangepicker();
</script>
<script>
    $.ajax({
        type: "GET",
        url: '../attendance/attend_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#attendance-table").DataTable({
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
<script>
    $(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

function delete_attendance(attendance_id){
  $('#confirm_delete_modal').attr('onclick','confirm_delete_attendance('+attendance_id+')')
  $('#cust_name').html($('#user_name_'+attendance_id).html())
}
function confirm_delete_attendance(attendance_id){
  var attendance = new FormData();  
    // validation
    attendance.append( 'attendance_id', attendance_id);  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "delete_attendance.php",
        data: attendance,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          console.log(result);
          if(result == 1){
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
          }else{
            alert('Error time in attendance');
          }
          $('#attendance_delete_modal').click();

        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
      });
}
</script>

