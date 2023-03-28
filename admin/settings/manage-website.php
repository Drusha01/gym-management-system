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
   <style>
    /* The heart of the matter */
    .testimonial-group > .row {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    }
    .testimonial-group > .row > .col-lg-4 {
    display: inline-block;
    }
   </style>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">Manage Website</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>

        <!-- start of carousel -->
        <div class="row">
            <div class="col-lg-9">
                <h5 class="fw-regular">Carousel Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_carousel"> Add Carousel</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2">
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Quality Yet Affordable Gym" id="input_1">
                            <div class="py-1 text-center">
                                <img src="../../images/home-1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 text-center">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Numerous Gym Equipment" id="input_1">
                            <div class="py-1">
                                <img src="../../images/home-2.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 text-center">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="A Good Place To Workout" id="input_1">
                            <div class="py-1">
                                <img src="../../images/home-3.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 text-center">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Chest Area" id="input_1">
                            <div class="py-1">
                                <img src="../../images/home-1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of carousel -->

        <!-- start of weights room -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Weights Room Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_weights"> Add Picture</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2">
                    <div class="col-12 col-lg-4">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Dumbells">
                            <div class="py-1 text-center">
                                <img src="../../images/weight_room/orig_size/orig_size_1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Machines">
                            <div class="py-1 text-center">
                                <img src="../../images/weight_room/orig_size/orig_size_2.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Warm-Up Area">
                            <div class="py-1 text-center">
                                <img src="../../images/weight_room/orig_size/orig_size_3.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Chest Area">
                            <div class="py-1 text-center">
                                <img src="../../images/weight_room/orig_size/orig_size_4.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of weights room -->

        <!-- start of function room -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Function Room Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_func"> Add Picture</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2">
                    <div class="col-12 col-lg-4">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Dumbells">
                            <div class="py-1 text-center">
                                <img src="../../images/function_room/orig_size/1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Boxing Area">
                            <div class="py-1 text-center">
                                <img src="../../images/function_room/orig_size/2.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Treadmill">
                            <div class="py-1 text-center">
                                <img src="../../images/function_room/orig_size/3.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Title</label>
                            <input type="text" class="form-control" value="Bike Area">
                            <div class="py-1 text-center">
                                <img src="../../images/function_room/orig_size/4.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of function room -->

        <!-- start of Our Team -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Our Team About Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_team">Add Person</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2">
                    <div class="col-12 col-lg-4">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Name</label>
                            <input type="text" class="form-control" value="Ken Steven Lao">
                            <label for="input_1">Position</label>
                            <input type="text" class="form-control" value="Gym-Owner">
                            <div class="py-1 text-center">
                                <img src="../../images/person_1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card container-fluid py-2 shadow-sm">
                            <label for="input_1">Name</label>
                            <input type="text" class="form-control" value="Duke Cati">
                            <label for="input_1">Position</label>
                            <input type="text" class="form-control" value="Employee">
                            <div class="py-1 text-center">
                                <img src="../../images/person_1.jpg" class="img-fluid img-thumbnail" style="max-height: 207px;">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Change Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="d-flex justify-content-lg-end">
                                <button class="btn btn-success btn-sm me-1">Save</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end of function room -->
    </div>
</main>



<!-- Modal Carousel -->
<div class="modal fade" id="add_carousel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Carousel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters">

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Change Image</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Weights -->
<div class="modal fade" id="add_pic_weights" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Picture for Weight Room</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters">

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Change Image</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Function -->
<div class="modal fade" id="add_pic_func" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Picture for Function Room</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters">

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Change Image</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal team -->
<div class="modal fade" id="add_pic_team" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Person for Our Team</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Name</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters">
        <label for="input_1">Position</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters">

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Change Image</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>

</html>