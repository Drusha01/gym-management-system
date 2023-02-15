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
        <div class="container-fluid">
            <ul class="nav nav-tabs application">
                <li class="nav-item active ">
                    <a class="nav-link" href="#tab-existing" data-bs-toggle="tab">Existing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-new" data-bs-toggle="tab">New</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="tab-existing">
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
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Name of Offer Here" class="form-control ms-md-2">
                        </div>
                    </div>
                    <div class="table-responsive table-container">

                    </div>
                </div>

                    <!-- new trainer -->
                <div class="tab-pane show fade" id="tab-new"">
                <form action="" method="POST">
                    <div class="row pt-2">
                        <div class="col-12 col-lg-6">
                            <div class="row form-group pb-2">
                            <label for="exampleFormControlFile1">Profile Picture</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="row form-group pb-2">
                                <div class="col">
                                    <label class="pb-1 ms-1" for="name_offer">Username</label>
                                    <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Username" required>
                                </div>
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
                        </div>
                            <div class="col-12 col-lg-6"">
                                <div class="row form-group pb-2">
                                    <div class="col">
                                        <label class="pb-1 ms-1" for="name_offer">Address</label>
                                        <input type="text" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Address" required>
                                    </div>
                                </div>
                                <div class="row form-group pb-2">
                                    <div class="col-12 col-lg-6">
                                        <label class="pb-1 ms-1" for="name_offer">Password</label>
                                        <input type="password" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Enter Password" required>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="pb-1 ms-1" for="name_offer">Confirm Password</label>
                                        <input type="password" class="form-control" value="" id="offer_name" name="offer_name"placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="row form-group pb-2">
                                    <label for="exampleFormControlFile1">ID or Birth Certificate</label>
                                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
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
                
            </div>
        </div>
        
        
    </div>
</main>

<!-- modal -->
<div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Existing User to Trainer</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="message" class="form-label">Are you sure you want to add existing user to Trainer?</label>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#secondModal" data-bs-dismiss="modal">Yes</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="secondModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Succesfully Added!</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Existing User is added to Trainer</p>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });

        $.ajax({
    type: "GET",
    url: 'exist_user_table.php',
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#table-1").DataTable({
            "dom": '<"top"f>rt<"bottom"lp><"clear">',
            responsive: true,
        });
        $('input#keyword').on('input', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
        })
        $('select#categoryFilter').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([4]).search(status).draw();
        })
        $('select#program').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([4]).search(status).draw();
        })
        new $.fn.dataTable.FixedHeader(dataTable);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
});

</script>
</body>