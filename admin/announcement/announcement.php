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
    <h5 class="col-12 fw-bold mb-3">Announcement</h5>
    <div class="row mb-3">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-2 form-group table-filter-option">
            <label>Type</label>
            <select name="categoryFilter_1" id="categoryFilter_1" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Text">Text</option>
                <option value="Image">Image</option>
            </select>
        </div>
        <div class="col-12 col-sm-3  form-group table-filter-option">
            <label>Status</label>
            <select name="categoryFilter_2" id="categoryFilter_2" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Active">Active</option>
                <option value="Disabled">Disabled</option>
            </select>
        </div>
        <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50 py-2 py-lg-0">
            <a href="add_announce.php" class="btn btn-success" role="button">Add Annoucement</a>
        </div>
    </div>
    <div class="table-responsive table-container">

    </div>

  </div>
</main>
</body>
<script>
    $.ajax({
        type: "GET",
        url: 'announce_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#announce").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([2]).search(status).draw();
            })
            $('select#categoryFilter_1').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([3]).search(status).draw();
            })
            $('select#categoryFilter_2').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([5]).search(status).draw();
            })
            new $.fn.dataTable.FixedHeader(dataTable);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
</script>

</html>