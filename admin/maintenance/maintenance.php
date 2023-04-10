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
        if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
          
        }else if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){

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
  <div class="w-100">
    <h5 class="col-12 fw-bold mb-3">Maintenance</h5>
    <div class="row pb-3">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Equipment Here" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-3 form-group table-filter-option">
            <label for="categoryFilter_1">Type</label>
            <select name="categoryFilter_1" id="categoryFilter_1" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Weights">Weights</option>
                <option value="Machine">Machine</option>
                <option value="Tool">Tool</option>
            </select>
        </div>
        <div class="col-12 col-sm-3 form-group table-filter-option">
            <label for="categoryFilter_2">Condition</label>
            <select name="categoryFilter_2" id="categoryFilter_2" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Good">Good</option>
                <option value="In-Maintenance">In-Maintenance</option>
            </select>
        </div>
        <div class="col-12 col-sm-2 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="add-maintenance.php" class="btn btn-success" role="button">Add Equipment</a>
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
    <input type="number" name="equipment_id" value="" id="equipment_id" style="visibility:hidden;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Remarks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label" id="equipment_label">Remarks for: Equipment Name</label>
            <textarea class="form-control" id="remark" name="remark"rows="3" placeholder="Enter remark"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Add photo (Not Required)</label>
            <input class="form-control form-control-sm" id="file" type="file">
        </div>
        Condition
        <br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="remark_equipment_condition_details" id="remark_equipment_condition_detail_1" value="Good" >
            <label class="form-check-label" for="remark_equipment_condition_detail_1">Good</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="remark_equipment_condition_details" id="remark_equipment_condition_detail_2" value="In-Maintenance">
            <label class="form-check-label" for="remark_equipment_condition_detail_2">In-Maintenance</label>
            
        </div>
        <br>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" onclick="submit_remark()">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="remark_modal_close">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal_body_content">
       Are you sure you want to delete this (Equipment Name)?
      </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="confirm_delete" >Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal">No</button>
      </div>
    </div>
  </div>
</div>

</body>

<script>
  $.ajax({
    type: "GET",
    url: 'tbl/maintenance-tbl.php',
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#maintenance").DataTable({
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
        dataTable.columns([4]).search(status).draw();
        })
        new $.fn.dataTable.FixedHeader(dataTable);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    } 
  });
  
  function delete_equipment(index,id,name){
    $('#modal_body_content').html('Are you sure you want to delete this'+index+'. '+name+' ?');
    $('#confirm_delete').attr('onclick','confirm_delete_equipment('+id+')');
  }

  function confirm_delete_equipment(id){
    // console.log(id)
    var equipment = new FormData();  
    equipment.append( 'equipment_id', id);  
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "delete_maintenance.php",
        data: equipment,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            // parse result
            console.log(result)
            if(result == 1){
              alert('announcement successfully deleted');
              $.ajax({
                type: "GET",
                url: 'tbl/maintenance-tbl.php',
                success: function(result)
                {
                    $('div.table-responsive').html(result);
                    dataTable = $("#maintenance").DataTable({
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
                    dataTable.columns([4]).search(status).draw();
                    })
                    new $.fn.dataTable.FixedHeader(dataTable);
                },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              });
            }else{
                alert('deletion failed');
            }
        }
    });
  }

  function add_remarks(index,id,equipment_name){
    // change the id of modal
    $('#equipment_id').val(id);
    $('#equipment_label').html('Remarks for '+index+'. '+equipment_name);
    // clear
    $('#remark').val('');
    $('#file').val('');
    $('#remark_equipment_condition_detail_1').prop( "checked", true );
    // console.log(id);
  }

  function submit_remark(){
    var remarks = new FormData();  
    // validation
    if($('#remark').val().length<=0){
      alert('Please add remark');
      return;
    }else{
      remarks.append( 'equipment_id', $('#equipment_id').val());  
      remarks.append( 'remarks', $('#remark').val());  
    }
    if($('#file').val().length>0){
      remarks.append( 'file',$('#file')[0].files[0]);  
    }
    if($('[name="remark_equipment_condition_details"]').val().length<=0){
      alert('Please select condition');
    }else{
      remarks.append( 'remark_equipment_condition_details', $('[name="remark_equipment_condition_details"]').val());  
    }

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "add_remarks.php",
        data: remarks,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function ( result ) {
            // parse result
            // close modal
            $('#remark_modal_close').click();
            if(result!= 0){
              $.ajax({
                type: "GET",
                url: 'tbl/maintenance-tbl.php',
                success: function(result)
                {
                    $('div.table-responsive').html(result);
                    dataTable = $("#maintenance").DataTable({
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
                    dataTable.columns([4]).search(status).draw();
                    })
                    new $.fn.dataTable.FixedHeader(dataTable);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
              });

            }else{
              alert('failed adding remark ')
            }
        }
    });
  }
</script>

</html>