<div class="w-100 py-4 px-1 px-lg-2" style="min-height: 450px;">
<div class="card border-0 shadow-lg rounded-3">
    <table class="table">
        <thead>
            <tr>
            <th colspan="2">
                <div class="box-title py-2 d-flex justify-content-end">
                    <button type="button" class="btn bg-transparent" id="mark_all_as_read">Mark as All Read</button>
                </div>
            </th>
            </tr>
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
<script>
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
</script>
</div>
<div class="container-fluid d-flex justify-content-center justify-content-lg-end pb-3">
<nav aria-label="...">
        <ul class="pagination">
            <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>

            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>

            <li class="page-item" aria-current="page">
                <a class="page-link text-dark" href="#">2</a>
            </li>

            <li class="page-item">
                <a class="page-link text-dark" href="#">3</a>
            </li>

            <li class="page-item">
            <a class="page-link text-dark" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>




