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
<div class="row g-2 mb-2 mt-1">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label>Type</label>
            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="asdads">Available</option>
                <option value="Not Subscribed">Not Available</option>
            </select>
        </div>
        <div class="form-group col-12 col-sm-5 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Enter Name of Offer Here" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="trainer-add.php" class="btn btn-success" role="button">Add Trainer</a>
        </div>
    </div>

    <div class="table-responsive table-container">

    </div>
</div>
