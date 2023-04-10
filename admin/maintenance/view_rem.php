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
        if(isset($_GET['equipment_id']) && intval($_GET['equipment_id'])>0){
            require_once '../../classes/equipments.class.php';
            $equipmentsObj = new equipments();
            if(!$equipment_data = $equipmentsObj->fetch_with_id($_GET['equipment_id'])){
                header('location:maintenance.php');
            }
        }else{
          header('location:maintenance.php');
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
  <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3">View Remarks:<span class="fw-normal fs-5"><?php echo htmlentities($equipment_data['equipment_name'])?></span></h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="maintenance.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
            </div>
        </div>
        <div class="row pb-2">
            <div class="form-group col-12 col-sm-5 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter remarks here" class="form-control ms-md-2">
            </div>
            <div class="col-12 col-sm-4 col-xs-12 form-group table-filter-option">
                <label for="categoryFilter">Condition</label>
                <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                    <option value="">All</option>
                    <option value="Good">Good</option>
                    <option value="In-Maintenance">In-Maintenance</option>
                </select>
            </div>
        </div>

        <div class="table-responsive table-container">
            
        </div>
  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Remarks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Max of 20 characters"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Add photo (Not Required)</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
        Condition
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Good</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">In-Maintenance</label>
        </div>
        <div class="py-1">
          <label for="not_list" class="form-label">Not in the List?</label>
          <input class="form-control" type="text" placeholder="Max 20 Characters" id="not_list">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header" >
        <h1 class="modal-title fs-5" id="exampleModalLabel">Remarks by: <span class="fw-light fs-5" id="name">Trinidad, James Lorenz</span> </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal_body">
        <p class="fw-bold">Date and Time: <span class="fw-light" id="time">March 23, 2023 (3:00 PM)</span></p>
        <p class="fw-bold">Description</p>
        <div class="mb-3 container card">
            <p class="mt-2" id="remarks">Still in Good Condition</p>
        </div>
        <p class="fw-bold">Condition: <span class="fw-light" id="condition_details">Good</span></p> 
       
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<input type="number" name="equipment_id" id="equipment_id" value="<?php echo htmlentities($_GET['equipment_id'])?>" style="visibility:hidden;">
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure you want to delete this?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="confirm_delete">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="dismiss_modal">No</button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
  $.ajax({
      type: "GET",
      url: 'tbl/view-rem-tbl.php?equipment_id='+$('#equipment_id').val(),
      success: function(result)
      {
          $('div.table-responsive').html(result);
          dataTable = $("#view-rem").DataTable({
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
          new $.fn.dataTable.FixedHeader(dataTable);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
  });

  function add_delete_remark(id){
    $('#confirm_delete').attr('onclick','delete_remark('+id+')');
  }
  function delete_remark(id){
    
    console.log(id);
    var remark = new FormData();  
    remark.append('remark_id',id);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "delete_remark.php",
        data: remark,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
          if(result ==1){
            $('#dismiss_modal').click();
            $.ajax({
                type: "GET",
                url: 'tbl/view-rem-tbl.php?equipment_id='+$('#equipment_id').val(),
                success: function(result)
                {
                    $('div.table-responsive').html(result);
                    dataTable = $("#view-rem").DataTable({
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
                    new $.fn.dataTable.FixedHeader(dataTable);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
          }else{
            alert('remark deletion failed');
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
  }

  function show_remark(id){
    // console.log(id);
    var remark = new FormData();  
    remark.append('remark_id',id);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "view_remark.php",
        data: remark,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            // parse result
            var obj =JSON.parse(result);
            $('#name').html(obj.user_fullname);
            $('#time').html(obj.remark_time);
            $('#remarks').html(obj.remark_remark);
            $('#condition_details').html(obj.equipment_condition_details);
            $('#img_content_div').remove();
            // console.log(result)
            if(obj.remark_file.length>0){
              $('#modal_body').append('<div class="mb-3" id="img_content_div"><img src="../../img/remarks/remarks-resized/'+obj.remark_file+'" id="img_content" class="img-fluid"></div>');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
      } 
    });
  }
  function edit_remark(id){
    console.log(id);
  }
</script>


</html>