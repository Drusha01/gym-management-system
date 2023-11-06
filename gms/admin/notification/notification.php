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
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-md-4 pt-3">
  <div class="w-100">
    <h5 class="col-12 fw-bold mb-3 ps-2">Notification</h5>
    <!-- wag mo to problemahin for reference lng tanggalin lng ito if tapos na -->
    <div class="col-12 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50 pb-3 px-3">
        <a href="referencenotif.php" class="btn btn-success" role="button">Show Reference</a>
    </div>

    <div class="card border-0 shadow rounded-3">
        <div class="d-flex flex-row-reverse bd-highlight mt-1">
            <div class="p-2 bd-highlight">
                <button type="button" class="btn bg-transparent" id="mark_all_as_read">Mark as All Read</button>
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn bg-transparent" id="delete_selected">Delete Selected</button>
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn bg-transparent" id="mark_as_read_selected">Mark As Read Selected</button>
            </div>
        </div>
        <table id="example" class="table">
            <thead>
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"></th>
                <!-- <tr>
                    <th colspan="2">
                        <div class="box-title py-2 d-flex justify-content-end">
                            <button type="button" class="btn bg-transparent" id="mark_all_as_read">Mark as All Read</button>
                        </div>
                    </th>
                </tr> -->
            </thead>
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold">Notifications will appear here</td>
                </tr>
            </tbody> -->
            <tbody id="notification-content">
            </tbody>
        </table>
    </div>
    
    <div id="custom-pagination" class="d-flex justify-content-center justify-content-lg-end">
    </div>


  </div>
  <script>
    $('#example').DataTable({
    "dom": '<"top"f>rt<"bottom"lp><"clear">',
    "bLengthChange": false,
    "ordering": false,

    initComplete: (settings, json)=>{
        $('.dataTables_paginate').appendTo('#custom-pagination');
    },
    });
    function delete_notification(notification_id){
        var notification = new FormData();  
        notification.append( 'notification_id', notification_id);   
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "delete_notification.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification_list.php',
                    success: function(result)
                    {
                        $('#notification-content').html(result);
                    },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
                
                
            }
        });
    }


    $('#mark_all_as_read').click(function(){
        console.log('nice');
        var notification = new FormData();  
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "mark_all_as_read.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification_list.php',
                    success: function(result)
                    {
                        $('#notification-content').html(result);
                    },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
                
                
            }
        });
    });

    function mark_as_read_notification(notification_id){
        var notification = new FormData();  
        notification.append( 'notification_id', notification_id);   
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "update_notification.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification_list.php',
                    success: function(result)
                    {
                        $('#notification-content').html(result);
                    },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
                
                
            }
        });
    }
    
    
    $.ajax({
        type: "GET",
        url: 'notification_list.php',
        success: function(result)
        {
            $('#notification-content').html(result);
        },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });


    function selectionfunc(notification_id){
        if($('#notif_'+notification_id).prop('checked')){
            notificatiton_arr.push(notification_id);
        }else{
            for (let index = 0; index < notificatiton_arr.length; index++) {
                if(notificatiton_arr[index] == notification_id){
                    notificatiton_arr.splice(index, 1);
                }   
            }
        }
}

    $('#delete_selected').click(function(){
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "delete_multiple_notification.php",
            data: {notificatiton_arr:notificatiton_arr},
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification_list.php',
                    success: function(result)
                    {
                        $('#notification-content').html(result);
                    },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
                
                
            }
        });
    });
    $('#mark_as_read_selected').click(function(){
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "mark_as_read_multiple_notification.php",
            data: {notificatiton_arr:notificatiton_arr},
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification_list.php',
                    success: function(result)
                    {
                        $('#notification-content').html(result);
                    },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
                
                
            }
        });
    });
</script>
</main>
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2"class="text-center fw-bold">Notifications will Appear Here</td>
                </tr>
            </tbody> -->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

</html>