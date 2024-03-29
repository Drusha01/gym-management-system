<?php 
session_start();
if(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_avail_restriction_details']) && $_SESSION['admin_avail_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('location:../dashboard/dashboard.php');
}
?>


<?php require_once '../includes/header.php';?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
        <div class="w-100">
            <h5 class="col-12 fw-bold mb-3">Avail</h5>
            <ul class="nav nav-tabs application">
                <li class="nav-item-avail" id="subs">
                    <a class="nav-link" href="#tab-subs" id="a-subs" data-bs-toggle="tab" >Subscription </a>
                </li>
                <li class="nav-item-avail" id="exp">
                    <a class="nav-link" href="#tab-exp" id="a-exp"data-bs-toggle="tab" >Expiration</a>
                </li>
                <li class="nav-item-avail" id="walk">
                    <a class="nav-link" href="#tab-walk" id="a-walk" data-bs-toggle="tab" >Walk-In</a>
                </li>
            </ul>
            <div class="tab-content" >
                
            </div>
        </div>

    </main>
<script>
$(".nav-item-avail").on("click", function(){
    $(".nav-item-avail").removeClass("active");
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
$(document).ready(function () {
    $('table.display').DataTable();
});
</script> -->
<script>
// setting the default into subscription


$(".nav-item-avail").on("click", function(){
    const url = new URL(location);
    url.searchParams.set("active", $(this).attr('id'));
    const state = { active: $(this).attr('id')};
    if(url != window.location.href){
        history.pushState(state, "", url);
    }
    

    if($(this).attr('id') =='subs'){
        $.ajax({
            type: "GET",
            url: 'subscription.php',
            success: function(result)
            {

                $('div.tab-content').html(result);
                $.ajax({
                    type: "GET",
                    url: 'availtable.php',
                    success: function(result)
                    {
                        $('div.table-1').html(result);
                        dataTable = $("#table-1").DataTable({
                            "dom": '<"top"f>rt<"bottom"lp><"clear">',
                            responsive: true
                        });
                        $('input#keyword').on('input', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
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
                $('div.tab-content').html(result);
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
                            dataTable.columns([3]).search(status).draw();
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
        $.ajax({
            type: "GET",
            url: 'walk-in.php',
            success: function(result)
            {
                $('div.tab-content').html(result);
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }


});


window.onload = (event) =>{
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const active = urlParams.get('active')
  console.log(active);
  if(active != null){

    $('#a-'+active).click();
    $('#a-'+active).attr('class','nav-link active');
    $('#tab-'+active).attr('class','tab-pane active show fade')
  }
  

};

window.onpopstate = (event) => {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const active = urlParams.get('active')
    console.log(active);
    
    if(active != null){
        $('#a-subs').attr('class','nav-link');
        $('#a-exp').attr('class','nav-link');
        $('#a-walk').attr('class','nav-link');

        $('#a-'+active).click();
        $('#a-'+active).attr('class','nav-link active');
        $('#tab-'+active).attr('class','tab-pane active show fade')
    }
    console.log(
        `location: ${document.location}, state: ${JSON.stringify(event.state)}`
    );
};

// $(window).on('hashchange', function(e){
//     const queryString = window.location.search;
//     const urlParams = new URLSearchParams(queryString);
//     const active = urlParams.get('active')
//     console.log(active);
    
//     if(active != null){

//         $('#a-'+active).click();
//         $('#a-'+active).attr('class','nav-link active');
//         $('#tab-'+active).attr('class','tab-pane active show fade')
//     }
// });

// jQuery(window).on('hashchange', function(){
//     var hash = window.location.hash;
//     console.log(hash);
// });

// window.onpopstate = function(event) {
//     const queryString = window.location.search;
//     const urlParams = new URLSearchParams(queryString);
//     const active = urlParams.get('active')
//     console.log(active);
    
//     if(active != null){

//         $('#a-'+active).click();
//         $('#a-'+active).attr('class','nav-link active');
//         $('#tab-'+active).attr('class','tab-pane active show fade')
//     }


// };
</script>
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
<!-- <div class="modal fade" id="Modalactivate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;">
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
</div> -->
<!-- End of Modal -->
</body>
</html>