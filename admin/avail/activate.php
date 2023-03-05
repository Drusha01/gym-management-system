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
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Activate</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="avail.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
         </div>
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <img src="../../images/acc_img.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                        <h4>James_No_Legday</h4>
                        <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                        <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Trinidad, James Lorenz
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                Male
                            </div>
                        </div>
                    </div>
                        <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                San Jose, Zamboanga City
                            </div>
                        </div>
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                0921-234-5678
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Age</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                22 Years Old
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-9 text-secondary">
                                James_No_Legday@gmail.com
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="col-lg-3">
                                <h6 class="mb-0">Birth Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                November 14, 2000
                            </div>
                        </div>
                        <div class="col">
                            <div class="col">
                                <h6 class="mb-0">Account Created</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                December 20, 2019
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-dark">Activate All</button></div>
            <div class="p-2 bd-highlight"><a href="#link" class="btn btn-outline-success" role="button">Pay</a></div>
        </div>
        <div class="table-responsive table-container">
            <table id="example" class="table table-striped table-bordered" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Offer Name</th>
                    <th class="text-center" scope="col">Qty</th>
                    <th class="text-center" scope="col">Price</th>
                    <th class="text-center" scope="col">Days</th>
                    <th class="text-center" scope="col">Total Days</th>
                    <th class="text-center" scope="col">Calculation</th>
                    <th class="text-center" scope="col">Sub Total Price</th>
                    <th class="text-center" scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Hanrickson Gym</td>
                        <td class="text-center " >1</td>
                        <td class="text-center" >₱1000</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >1 X (60/60) X ₱1000 =</td>
                        <td class="text-center" >₱1000</td>
                        <th class="text-center" scope="col">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Activate</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Locker Gym</td>
                        <td class="text-center " >1</td>
                        <td class="text-center" >₱1000</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >60</td>
                        <td class="text-center" >1 X (60/60) X ₱1000 =</td>
                        <td class="text-center" >₱1000</td>
                        <th class="text-center" scope="col">
                        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Deactivate</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>

  </div>
</main>

</body>
<script>

</script>
</html>