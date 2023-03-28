<?php
if($_SESSION['admin_user_type_details'] != 'admin'){
    header('location:../dashboard/dashboard.php');
}
?>


<div class="row g-2 mb-2 mt-1">
    <div class="form-group col-12 col-sm-5 table-filter-option">
        <label for="keyword">Search</label>
        <input type="search" name="keyword" id="keyword" placeholder="Enter Name" class="form-control ms-md-2">
    </div>
    <div class="table-responsive table-container table-exist-1 ">
        
    </div>
 </div>

