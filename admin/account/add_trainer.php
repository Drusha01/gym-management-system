<?php require_once '../includes/header.php';?>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<body>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3 ms-2">Add Trainer</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="account.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
    </div>
    <div class="container-fluid">
        <form action="" method="POST">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row form-group pb-2">
                    <label for="exampleFormControlFile1">Profile Picture</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">First Name</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter First Name" required>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Middle Name</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Middle Name" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Last Name</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Last Name" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Phone Number</label>
                            <input type="number" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Phone Number" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Email</label>
                            <input type="email" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col">
                            <label class="pb-1 ms-1" for="name_offer">Birth Date</label>
                            <input type="date" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Birth Date" required>
                        </div>
                    </div>
                    <div class="row form-group pb-2">
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Gender</label>
                            <select class="form-select" aria-label="Default select example">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                                <option value="3">Helicopter</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="pb-1 ms-1" for="name_offer">Other</label>
                            <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Other" required>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row d-flex">
                    <div class="col-12 col-lg-1 d-grid d-lg-flex pt-3 pt-lg-1">
                        <button type="submit" class="btn btn-success btn-lg border-0 rounded" name="add_account" value="add_account" id="submit">Submit</button>
                    </div>
                </div>
        </form>
    </div>
</main>
</body>