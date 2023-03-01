
<?php 
session_start();


?>


<?php require_once '../includes/header.php';?>
<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <h5 class="col-12 fw-bold mb-3">Avail</h5>
            <ul class="nav nav-tabs application">
                        <li class="nav-item active " id="subs">
                            <a class="nav-link" href="#tab-subs" data-bs-toggle="tab" >Subscription </a>
                        </li>
                        <li class="nav-item" id="exp">
                            <a class="nav-link" href="#tab-exp" data-bs-toggle="tab" >Expiration</a>
                        </li>
                        <li class="nav-item" id="walk">
                            <a class="nav-link" href="#tab-walk_in" data-bs-toggle="tab" >Walk-In</a>
                        </li>
                    </ul>
            <div class="tab-content" >
                <div class="tab-pane active show fade" id="tab-subs">
                    <?php require_once 'subscription.php';?>
                </div>
                <div class="tab-pane show fade" id="tab-exp">
                    <?php require_once 'expiration.php';?>
                </div>
                <div class="tab-pane show fade" id="tab-walk_in">
                    <?php require_once 'walk-in.php';?>
                </div>
            </div>
        </div>

    </main>
<script>
$(".nav-item").on("click", function(){
            $(".nav-item").removeClass("active");
            $(this).addClass("active");

        });
        
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', () => {
    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}
</script>
<!-- <script>
// setting the default into subscription
$.ajax({
    type: "GET",
    url: 'subscription.php',
    success: function(result)
    {
        
        $('div#tab').html(result);
        $.ajax({
            type: "GET",
            url: 'availtable.php',
            success: function(result)
            {
                
                $('div.table-1').html(result);
                dataTable = $("#table-1").DataTable({
                    "dom": '<"top"f>rt<"bottom"lp><"clear">',
                    responsive: true,
                });
                
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

$(".nav-item").on("click", function(){
            
    if($(this).attr('id') =='subs'){
        $.ajax({
            type: "GET",
            url: 'subscription.php',
            success: function(result)
            {
                
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'availtable.php',
                    success: function(result)
                    {
                        
                        $('div.table-1').html(result);
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
                            dataTable.columns([3]).search(status).draw();
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
        
        
        
    }else if($(this).attr('id') =='exp'){
        $.ajax({
            type: "GET",
            url: 'expiration.php',
            success: function(result)
            {
                
                $('div#tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'exptable.php',
                    success: function(result)
                    {
                        $('div.table-2').html(result);
                        dataTable = $("#table-2").DataTable({
                            "dom": '<"top"f>rt<"bottom"lp><"clear">',
                            responsive: true,
                        });
                        $('input#keyword').on('input', function(e){
                            var status = $(this).val();
                            dataTable.columns([2]).search(status).draw();
                        })
                        $('select#categoryFilter').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
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
    }else if($(this).attr('id') =='walk'){

    }
           

});

</script> -->
<!-- Modal -->
<div class="modal fade" id="ModalTrainer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trainer Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
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
                    <div class="card mt-3">
                        <div class="pt-3 px-3 text-center">
                            <h5 class="fw-bold">Total Person who Availed</h5>
                        </div>
                        <div class="row text-center pt-2 pb-3">
                            <i class='bx bxs-group' style="font-size: 75px;"></i>
                            <h4 class="fw-bold">5</h4>
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
                        <hr>
                        
                    </div>
                </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Modal -->
<div class="modal fade" id="ModalProf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Profile Info</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
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
                        <hr>
                        
                    </div>
                </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->
<!-- Modal -->
<div class="modal fade" id="Modalactivate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Activation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container-fluid">
        Are you Sure you want to activate this?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        </div>
        </div>
    </div>
</div>
<!-- End of Modal -->
</body>
</html>