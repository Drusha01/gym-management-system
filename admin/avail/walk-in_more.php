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

<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
    <div class="row">
        <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">More Details (Walk-In)</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="avail.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
    </div>
    <div class="row">
        <div class="form-group col-12 col-sm-4 table-filter-option pb-3">
            <label for="categoryFilter">Availed Service</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Gym-Use">Gym-Use</option>
                <option value="Gym-Use/Trainer">Gym-Use/Trainer</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-5 table-filter-option pb-3">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
    </div>
    
    <div class="table-responsive table-container">
            
    </div>

  </div>
</main>
<script>
  $.ajax({
      type: "GET",
      url: 'tables/walkintable.php',
      success: function(result)
      {
          $('div.table-responsive').html(result);
          dataTable = $("#table-1").DataTable({
              "dom": '<"top"f>rt<"bottom"lp><"clear">',
              responsive: true
          });
          $('input#keyword').on('input', function(e){
              var status = $(this).val();
              dataTable.columns([2]).search(status).draw();
          })
          $('select#categoryFilter').on('change', function(e){
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