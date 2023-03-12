<?php
if($_SESSION['admin_user_type_details'] != 'admin'){
    header('location:../dashboard/dashboard.php');
}
?>


<div class="row g-2 mb-2 mt-1">
    <div class="form-group col-12 col-sm-4 table-filter-option">
        <label>Type</label>
        <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
            <option value="">All</option>
            <option value="Subscribe">Subscribe</option>
            <option value="Not Availed">Not Availed</option>
        </select>
    </div>
    <div class="form-group col-12 col-sm-5 table-filter-option">
        <label for="keyword">Search</label>
        <input type="search" name="keyword" id="keyword" placeholder="Enter Name" class="form-control ms-md-2">
    </div>
    <div class="table-responsive ">
        <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
            <thead class="bg-dark text-light">
                
                <tr>
                <th class="d-lg-none"></th>
                <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                <th>USER NAME</th>
                <th>NAME</th>
                <th scope="col" class="text-center">AGE</th>
                <th scope="col" class="text-center">GENDER</th>
                <th scope="col" class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once '../../classes/users.class.php';
                    $userObj = new users();

                    $users_data = $userObj->fetch_all_users(0,1000000);

                    $counter=1;
                    foreach ($users_data as $key => $value) {
                        if($value['user_status_details'] == 'active'){
                        echo '<tr>';
                        echo '<th class="d-lg-none"></th>';
                        echo '<th scope="row" class="text-center d-none d-sm-table-cell">'.htmlentities($counter).'</th>';
                        echo '<td>'.htmlentities($value['user_name']).'</td>';
                        echo '<td>'.htmlentities($value['user_fullname']).'</td>';
                        echo '<td class="text-center">'.htmlentities(intval(date('Y', time() - strtotime($value['user_birthdate']))) - 1970).'</td>';
                        echo '<td class="text-center">'.htmlentities($value['user_gender_details']).'</td>';
                        echo '<td class="text-center"><a  class="btn btn-primary btn-sm" role="button" href="add-new-admin.php?user_id='.htmlentities($value['user_id']).'">Add</a></td>';
                        echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
 </div>

