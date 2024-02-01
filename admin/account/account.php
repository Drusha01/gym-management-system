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
    header('location:../admin_control_log_in.php');
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
            <div class="tab">
            
            </div>
                <!-- end of acc table -->
        </div>  
    </div>
</main>

<!-- Modal -->


<script>



$(".nav-item").on("click", function(){
    const url = new URL(location);
    url.searchParams.set("active", $(this).attr('id') );
    const state = { active: $(this).attr('id')};
    if(url != window.location.href){
        history.pushState(state, "", url);
    }
    $(".nav-item").removeClass("active");
    $(this).addClass("active");
    console.log($(this).attr('id'))
    if($(this).attr('id') =='user'){
        $.ajax({
            type: "GET",
            url: 'user-table-header.php',
            responseType:'application/json',
            success: function(result)
            {
                $('#add-button').html('Add Customer');
                $('#add-button').attr('href','user-add.php');
                $('div.tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'usertable.php?page=1',
                    success: function(result)
                    {
                        $('div.table-responsive-1').html(result);
                        dataTable = $("#example").DataTable({
                            "dom": '<"top"f>rt<"bottom"lp><"clear">',
                            responsive: true,
                        });
                        $('input#keyword').on('input', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
                        })
                        $('select#categoryFilter').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([7]).search(status).draw();
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
                $('div.tab').html(result);
                $.ajax({
                    type: "GET",
                    url: 'trainertable.php',
                    success: function(result)
                    {
                        $('div.table-responsive-1').html(result);
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

function changeActiveTab(tab){
    var myParam = location.search.split('active=')[1];

    const url = new URL(location);
    url.searchParams.set("active", tab);
    const state = { active: $(this).attr('id')};
    if(url != window.location.href){
        history.pushState(state, "", url);
    }
}

window.onload = (event) =>{
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const active = urlParams.get('active')
  console.log(active);
  if(active != null){
    $('#'+active).trigger('click');
  }

}


window.onpopstate = (event) => {
    const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const active = urlParams.get('active')
  console.log(active);
  if(active != null){
    $('#'+active).trigger('click');
  }
    
    
}
</script>

</body>
</html>