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
        if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){

        }elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
            //d
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
    header('location:../admin_control_log_in2.php');
}

?>

<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
    <h5 class="col-12 fw-bold mb-3">Accounts</h5>
        <div class="container-fluid">
            <ul class="nav nav-tabs application">
                        <li class="nav-item active "id="user">
                            <a class="nav-link" href="#tab-user" data-bs-toggle="tab">Customer</a>
                        </li>
                        <li class="nav-item" id="trainer">
                            <a class="nav-link" href="#tab-trainer" data-bs-toggle="tab" >Trainer</a>
                        </li>
                    </ul>
            <div class="tab-content">
                <div class="tab-pane active show fade" id="tab-user">
                    <div class="row g-2 mb-2 mt-1">
                        <div class="form-group col-12 col-sm-4 table-filter-option">
                            <label>User Status</label>
                            <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                                <option value="">Active</option>
                                <option value="">All</option>
                                <option value="Subscribe">Deleted</option>
                                <option value="Not Availed">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-4 table-filter-option">
                            <label for="keyword">Search</label>
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Name of Customer Here" class="form-control ms-md-2">
                        </div>
                        <?php  if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){?>
                            <div class="col-12 col-sm-4 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
                            <a href="user-add.php" class="btn btn-success" role="button" id="add-button">Add Customer</a>
                        </div>
                        <?php }?>
                        
                    </div>
                    <div class="table-responsive table-container">

                    </div>

                 </div>
                 <!-- end of acc table -->

                <!-- <div class="tab-pane show fade" id="tab-trainer">
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
                        <div class="table-container">
                            <?php //require_once 'trainertable.php'; ?>
                        </div>
                    </div> -->
            </div>
                <!-- end of acc table -->

           
    </div>
</main>

<!-- Modal -->


<script>



$(".nav-item").on("click", function(){
    $(".nav-item").removeClass("active");
    $(this).addClass("active");
    console.log($(this).attr('id'))
    if($(this).attr('id') =='user'){
        $.ajax({
            type: "GET",
            url: 'user-table-header.php',
            success: function(result)
            {
                $('#add-button').html('Add Customer');
                $('#add-button').attr('href','user-add.php');
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'usertable.php?page=1',
                    success: function(result)
                    {
                        $('div.table-responsive').html(result);
                        dataTable = $("div.table-responsive").DataTable({
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
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }else if($(this).attr('id') =='trainer'){
        $.ajax({
            type: "GET",
            url: 'trainer-table-header.php',
            success: function(result)
            {
                $('#add-button').html('Add Trainer');
                $('#add-button').attr('href','trainer-add.php');
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'trainertable.php',
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
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }

});

// default as usertable
$.ajax({
    type: "GET",
    url: 'user-table-header.php',
    success: function(result)
    {
        
        $('div#tab').html(result);
        $.ajax({
            type: "GET",
            url: 'usertable.php?page=1',
            success: function(result)
            {
                $('div.table-responsive').html(result);
                dataTable = $("div.table-responsive").DataTable({
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
        
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
});


// function createModal(val){
//     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
//         <div class="modal-dialog modal-dialog-centered">
//             <div class="modal-content">
//             <div class="modal-header">
//                 <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
//                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//             </div>
//             <div class="modal-body">
//                 Are you sure you want to delete this?
//             </div>
//             <div class="modal-footer">
//                 <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
//                 <button type="button" class="btn btn-danger">Delete</button>
//             </div>
//             </div>
//         </div>
//     </div>
// }
</script>

</body>
</html>