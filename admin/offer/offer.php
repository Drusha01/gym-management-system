<?php
// start session
session_start();

// includes

if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header('location:../admin.php?path='.basename(__DIR__,1).'&active='.basename(__FILE__,1)); 
}

// check if we are normal user
if(isset($_SESSION['user_id'])){
    header('location:../user/user-page.php');
}


if(isset($_SESSION['admin_id'])){
    // check admin user details
    if($_SESSION['admin_user_status_details'] == 'active'){
        // do nothing
        if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){

        }else if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Read-Only'){
            
        }else{
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




    <div class="w-100">
        <h5 class="col-12 fw-bold mb-3">Offers</h5>
        <div class="row g-2 mb-2 mt-1">
            <div class="col-12 col-sm-4 col-xs-12 form-group table-filter-option">
                <label>Type</label>
                <select name="categoryFilter" id="categoryFilter" class="form-select ms-md-2">
                    <option value="">All</option>
                    <option value="Gym Subscription">Gym Subscription</option>
                    <option value="Trainer Subscription">Trainer Subscription</option>
                    <option value="Locker Subscription">Locker Subscription</option>
                    <option value="Program Subscription">Program Subscription</option>
                    <option value="Walk-In Subscription">Walk-In Subscription</option>
                </select>
            </div>
            <div class="form-group col-12 col-sm-5 table-filter-option">
                <label for="keyword">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Name of Offer Here" class="form-control ms-md-2">
            </div>

            <?php  if(isset($_SESSION['admin_offer_restriction_details']) && $_SESSION['admin_offer_restriction_details'] == 'Modify'){?>
            <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
                <div href="addoffer.php" name="add_offer" class="btn btn-success" role="button" id="add_offer.php">Add Offer</div>
            </div>
            <?php }?>
        </div>
            <div class="table-responsive table-container">

            </div>
        </div>
    </div>


<script>

$.ajax({
    //
    type: "GET",
    url: '../offer/offertable.php',
    success: function(result)
    {
        $('div.table-responsive').html(result);
        dataTable = $("#offer-table").DataTable({
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
            dataTable.columns([3]).search(status).draw();
        })
        new $.fn.dataTable.FixedHeader(dataTable);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    }
});

$('div[name="add_offer"]').click(function (){
    var path_name= $(this).attr('id');
    const location_length = (window.location.pathname.split("/").length);
    var offset = 5;
    const location = (window.location.pathname.split("/"));
    var offset = 5;
    location[offset] = 'offer'
    location[offset+1] = path_name
    var url_path = '';
    for (let index = 1; index < location.length; index++) {
        url_path+=('/'+location[index]);
        
    }
    if(window.location.href != window.location.origin+url_path){
        history.pushState({}, "", window.location.origin+url_path);
    }
    $.ajax({
        type: "GET",
        url: '../offer/'+$(this).attr('id'),
        success: function(result)
        {
            $('main#main-content').html(result);
            
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
});


</script>

</body>
</html>