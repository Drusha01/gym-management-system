<?php 
session_start();
if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('HTTP/1.1 404 Not Found');
    exit();
}
?>
<div class="tab-pane active show fade" id="tab-user">
    <div class="row g-2 mb-2 mt-1">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label>User Status</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="active">Active</option>
                <option value="deleted">Deleted</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
        <?php  if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){?>
            <div class="col-12 col-sm-4 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="user-add.php" class="btn btn-success" role="button" id="add-button">Add Customer</a>
        </div>
        <?php }?>

    </div>
    <div class="table-responsive-1 table-container">
    </div>
</div>