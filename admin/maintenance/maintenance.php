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
        // do nothing
      }elseif(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Read-Only'){
        
      }else{
          //do not load the page
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
    <div class="row g-2 mb-2 mt-1">
        <div class="col-12 col-sm-4 col-xs-12 form-group table-filter-option">
            <label>Condition</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Gym-Use Subscription">Good</option>
                <option value="Trainer Subscription">In-Maintenance</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-5 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Equipment Here" class="form-control ms-md-2">
        </div>
        <?php if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){ ?>
          <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="add-maintenance.php" class="btn btn-success" role="button">Add Equipment</a>
          </div>
        <?php }?>
        
    </div>
        <div class="table-responsive table-container">
          <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
            <thead class="bg-dark text-light">
                  <tr>
                  <th class="d-lg-none"></th>
                  <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                  <th>EQUIPMENT NAME</th>
                  <th class="text-center ">CONDITION</th>
                  <th scope="col" class="text-center">QUANTITY</th>
                  <?php if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){ ?>
                  <th scope="col" class="text-center">ACTION</th>
                  <?php }?>
                  </tr>
              </thead>
              <tbody>
              <?php
                require_once '../../classes/equipments.class.php';
                require_once '../../tools/functions.php';


                $equipmentsObj = new equipments();
                $equipments_data = $equipmentsObj->fetchAll();
                $counter=1;
                foreach ($equipments_data as $key => $value) {
                  echo '<tr>';
                  echo'<th class="d-lg-none"></th>';
                  echo'<th scope="row" class="text-center d-none d-sm-table-cell">'.htmlentities($counter).'</th>';
                  echo'<td>'.htmlentities($value['equipment_name']).'</td>';
                  echo'<td class="text-center ">'.htmlentities($value['equipment_condition_details']).'</td>';
                  echo'<td class="text-center">'.htmlentities($value['equipment_quantity']).'</td>';
                  if(isset($_SESSION['admin_maintenance_restriction_details']) && $_SESSION['admin_maintenance_restriction_details'] == 'Modify'){
                    echo'<td class="text-center"><a href="edit-maintenance.php?equipment_id='.htmlentities($value['equipment_id']).'" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="modalCreate('.htmlentities($counter).','.htmlentities($value['equipment_id']).')">Delete</button></td>';
                  }
                  echo'</tr>';
                  $counter++;
                }

              ?>

              
              
                  
                  
              </tbody>
          </table>
        </div>
    </div>
  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Equipment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Equipment?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal" onclick="deletefunction()">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<script>

  function modalCreate(index,id){
    console.log('called');
    console.log(index);
    $('.modal-body').html('Are you sure you want to delete the equipment #'+index+' ?');
    $("#btn-success").attr("onclick","deletefunction("+id+")");
    console.log(id);
  }

  function deletefunction(id){
    console.log(id);
    $.ajax({
    //
    type: "GET",
    url: 'delete-maintenance.php?equipment_id='+id,
    success: function(result)
    {
      if(result ==1){
        // delete the hmtl
        location.reload();
      }else{
        alert('deletion failed');
      }
        console.log('deleted');
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
});
  }
</script>
</body>
</html>