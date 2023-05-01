<div class="w-100 py-4 px-1 px-lg-2" style="min-height: 450px;">
<div class="card border-0 shadow-lg rounded-3">
        <!-- <div class="box-title d-flex justify-content-end my-3 me-2">
            <button type="button" class="btn bg-transparent" id="mark_all_as_read">Mark as All Read</button>
        </div> -->
        <div class="d-flex flex-row-reverse bd-highlight my-1">
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
        <table class="table" id="notif_tbl">
            <thead>
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"></th>
            </thead>
            <!-- No Notifcations -->
            <!-- <tbody>
                <tr>
                    <td colspan="2" class="text-center fw-bold">Notifications will appear here</td>
                </tr>
            </tbody> -->
            <tbody id ="notification-content">
                
            </tbody>
        </table>
</div>
<div id="custom-pagination" class="d-flex justify-content-center justify-content-lg-end mt-3">
    
</div>
<script>
$('#notif_tbl').DataTable({
"dom": '<"top"f>rt<"bottom"lp><"clear">',
"bLengthChange": false,
"ordering": false,

initComplete: (settings, json)=>{
    $('.dataTables_paginate').appendTo('#custom-pagination');
},
});
$.ajax({
    type: "GET",
    url: 'notification/notification_list.php',
    success: function(result)
    {
        $('#notification-content').html(result);
    },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    } 
});
function delete_notification(notification_id){
        var notification = new FormData();  
        notification.append( 'notification_id', notification_id);   
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "notification/delete_notification.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification/notification_list.php',
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
            url: "notification/mark_all_as_read.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification/notification_list.php',
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
            url: "notification/update_notification.php",
            data: notification,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                $.ajax({
                    type: "GET",
                    url: 'notification/notification_list.php',
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

    var notificatiton_arr = [];
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
            url: "notification/delete_multiple_notification.php",
            data: {notificatiton_arr:notificatiton_arr},
            success: function ( result ) {
                // parse result
                notificatiton_arr = [];
                $.ajax({
                    type: "GET",
                    url: 'notification/notification_list.php',
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
            url: "notification/mark_as_read_multiple_notification.php",
            data: {notificatiton_arr:notificatiton_arr},
            success: function ( result ) {
                // parse result
                notificatiton_arr = [];
                $.ajax({
                    type: "GET",
                    url: 'notification/notification_list.php',
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
</div>





