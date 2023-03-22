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
        if($_SESSION['admin_user_type_details'] != 'admin'){
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
    <h5 class="col-12 fw-bold mb-3">Settings</h5>
    <div class="container-fluid">
        <div class="row g-2 mb-2 mt-1">
            <div class="d-block d-lg-none pb-3">
                <h5 class="col-12 fw-regular ">Account</h5>
                <hr>
                <a href="../profile/profile.php" class="btn btn-outline-dark" role="button">View Profile</a>
            </div>
        <!-- first part -->
            <h5 class="col-12 fw-regular ">Add Account</h5>
            <hr>
            <div class="col-12 col-sm-12 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
                <a href="add-admin.php" class="btn btn-success" role="button">Add User</a>
            </div>
                <div class="table-responsive table-container">
                    <table id="table-2" class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
                        <thead class="bg-dark text-light">
                            <tr>
                            <th class="d-lg-none"></th>
                            <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                            <th class="text-center ">USER NAME</th>
                            <th>NAME</th>
                            <th scope="col" class="text-center">ADMIN TYPE</th>
                            <!-- <th scope="col" class="text-center">OFFER</th>
                            <th scope="col" class="text-center">AVAIL</th>
                            <th scope="col" class="text-center">ACCOUNT</th>
                            <th scope="col" class="text-center">PAYMENT</th>
                            <th scope="col" class="text-center">MAINTENANCE</th>
                            <th scope="col" class="text-center">REPORT</th> -->
                            <th scope="col" class="text-center">DATE CREATED</th>
                            <th scope="col" class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../../classes/admins.class.php';

                            $adminObj = new admins();
                            $admin_datas = $adminObj->fetchAll_exceptMe($_SESSION['admin_id']);
                            $counter=1;
                            foreach ($admin_datas as $key => $value) {
                                echo '<tr>';
                                echo '<th class="d-lg-none"></th>';
                                echo '<th scope="row" class="text-center d-none d-sm-table-cell">'.$counter.'</th>';
                                echo '<td class="text-center ">'.htmlentities($value['user_name']).'</td>';
                                echo '<td class="text-center ">'.htmlentities($value['user_fullname']).'</td>';
                                echo '<td class="text-center ">'.htmlentities($value['user_type_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_offer_restriction_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_avail_restriction_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_account_restriction_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_payment_restriction_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_maintenance_restriction_details']).'</td>';
                                // echo '<td class="text-center ">'.htmlentities($value['admin_report_restriction_details']).'</td>';
                                echo '<td class="text-center ">'.htmlentities($value['admin_date_created']).'</td>';
                                echo '<td class="text-center"><a href="edit-admin.php?admin_id='.htmlentities($value['admin_id']).'" class="btn btn-primary btn-sm" role="button">Edit</a>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="UpdateModal('.htmlentities($counter).','.htmlentities($value['admin_id']).',\''.htmlentities($value['user_name']).'\')">Delete</button></td>';
                                echo '</tr>';
                                $counter++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <div class="container d-flex justify-content-center justify-content-lg-end ">
                <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>

                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>

                            <li class="page-item" aria-current="page">
                                <a class="page-link text-dark" href="#">2</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link text-dark" href="#">3</a>
                            </li>

                            <li class="page-item">
                            <a class="page-link text-dark" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- end of first part -->
        <!-- 2nd part -->
        <h5 class="col-12 fw-regular ">Notifications</h5>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                Select Number of Days to notify about expiration
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
        </div>
        <br>
        <!-- end of second aprt -->
        <h5 class="col-12 fw-regular ">Lockers</h5>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                Enter Number of Lockers
            </div>
            <div class="col-lg-1 pt-2">
                <?php 
                    require_once('../../classes/number_of_lockers.class.php');
                    $number_of_lockersObj = new number_of_lockers();

                    $number_of_lockersObj->get_number_of_lockers();

                    if($number_of_lockers_data = $number_of_lockersObj->get_number_of_lockers()){
                        echo '<input type="number" class="form-control" value="" id="locker_number" name="locker_number"placeholder="'.$number_of_lockers_data['locker_number'].'" required>';
                    }else{
                        echo '<input type="number" class="form-control" value="" id="locker_number" name="locker_number"placeholder="0" required>';
                    }
                ?>
                
            </div>
        </div>

        <br>
        <!-- 2nd part -->
        <h5 class="col-12 fw-regular ">Contact Info for Footer</h5>
        <hr>
        <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-2 col-xl-auto">
                <label for="address" class="col-form-label">Address</label>
            </div>
            <div class="col-12 col-lg-10 col-xl-3">
                <input type="text" class="form-control" id="address" placeholder="San Jose, Zamboanga City">
            </div>
            <div class="col-12 col-lg-2 col-xl-auto">
                <label for="cont_num" class="col-form-label">Contact Number</label>
            </div>
            <div class="col-12 col-lg-10 col-xl-3">
                <input type="text" class="form-control" id="cont_num" placeholder="09123456789">
            </div>
            <div class="col-12 col-lg-2 col-xl-auto">
                <label for="cont_em" class="col-form-label">Email</label>
            </div>
            <div class="col-12 col-lg-10 col-xl-3">
                <input type="email" class="form-control" id="cont_em" placeholder="youremail@gmail.com">
            </div>
        </div>
        <div class="d-grid d-lg-inline">
            <button type="button" class="btn btn-success my-3">Save</button>
        </div>
        
        <!-- end of second aprt -->
        <br>

        <h5 class="col-12 fw-regular">Overdue</h5>
        <hr>
        <div class="row">
            <div class="col-lg-3 ">
                Choose percentage of Penalty of Payment Per Day
            </div>
            <div class="col-lg-1 pt-2">
                <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="30" required>
            </div>
        </div>
        <br>


    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="deleteModalBody">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger"data-bs-dismiss="modal" id="DeleteThisButton">Yes</button>
      </div>
    </div>
  </div>
</div>

<script>
    function UpdateModal(number,admin_id,user_name){
        console.log(user_name);
        $('#deleteModalBody').html('Are you sure you want to '+number+'. '+user_name+'?');
        $('#DeleteThisButton').attr('onclick','DeleteThisUser('+admin_id+',\''+user_name+'\')');
    }

    function DeleteThisUser(admin_id,user_name){
        console.log('deleted'+user_name);
        $.ajax({url: "delete-admin.php?admin_id="+admin_id, 
            success: function(result){
            console.log(result);
            if(result ==1){
                alert('deleted successfully');
                console.log(result)
            }else{
                alert('deletion failed');
            }
            location.reload();
        }});
    }

    $('#locker_number').change(function(){
        $.ajax({url: 'update_locker_number.php?number_of_locker='+$('#locker_number').val(), 
            success: function(result){
                console.log(result);
                if(result ==1){
                    alert('successfully change number of lockers');
                }else{
                    alert('error change')
                }
            }
        });
    });
</script>
</body>
</html>