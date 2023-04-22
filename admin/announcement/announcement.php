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
        // 
        if(isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Modify'){

        }elseif(isset($_SESSION['admin_announcement_restriction_details']) && $_SESSION['admin_announcement_restriction_details'] == 'Read-Only'){
            //
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






  <div class="w-100">
    <h5 class="col-12 fw-bold mb-3">Announcement</h5>
    <div class="row mb-3">
        <div class="form-group col-12 col-sm-4 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword" placeholder="Search" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-2 form-group table-filter-option">
            <label>Type</label>
            <select name="categoryFilter_1" id="categoryFilter_1" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Text">Text</option>
                <option value="Image">Image</option>
            </select>
        </div>
        <div class="col-12 col-sm-3  form-group table-filter-option">
            <label>Status</label>
            <select name="categoryFilter_2" id="categoryFilter_2" class="form-select ms-md-2">
                <option value="">All</option>
                <option value="Active">Active</option>
                <option value="Disabled">Disabled</option>
            </select>
        </div>
        <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-"content-lg-end form-group h-50 py-2 py-lg-0">
            <div href="add_announce.php" class="btn btn-success" id="add_announce" name="add_announcement"role="button">Add Annoucement</div>
        </div>
    </div>
    <div class="table-responsive table-container">

    </div>

  </div>

<!-- Modal del -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Announcement?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="delete_announcement_confirm">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    $.ajax({
        type: "GET",
        url: '../announcement/announce_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#announce").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([2]).search(status).draw();
            })
            $('select#categoryFilter_1').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([3]).search(status).draw();
            })
            $('select#categoryFilter_2').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([5]).search(status).draw();
            })
            new $.fn.dataTable.FixedHeader(dataTable);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });

    function delete_announcement(id){
        $('#delete_announcement_confirm').attr('onclick','confirm_delete('+id+')');
    }

    function confirm_delete(id){
        // ajax here
       
        var announcement = new FormData();  
        announcement.append( 'announcement_id', id);  
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "delete_announcement.php",
            data: announcement,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                var obj =JSON.parse(result)
                if(obj.announcement_id == id){
                    alert('announcement successfully deleted');
                    $.ajax({
                        type: "GET",
                        url: 'announce_tbl.php',
                        success: function(result)
                        {
                            $('div.table-responsive').html(result);
                            dataTable = $("#announce").DataTable({
                                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                                responsive: true,
                            });
                            $('input#keyword').on('input', function(e){
                                var status = $(this).val();
                                dataTable.columns([2]).search(status).draw();
                            })
                            $('select#categoryFilter_1').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
                            })
                            $('select#categoryFilter_2').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([5]).search(status).draw();
                            })
                            new $.fn.dataTable.FixedHeader(dataTable);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        } 
                    });
                }else{
                    alert('deletion failed');
                }
            }
        });
    }

    function move_order_up(id){
        var announcement = new FormData();  
        announcement.append( 'announcement_id', id);  
        announcement.append( 'order', 'up');  
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "update_announcement_order.php",
            data: announcement,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                console.log(result)
                if(result == 1){
                    $.ajax({
                        type: "GET",
                        url: 'announce_tbl.php',
                        success: function(result)
                        {
                            $('div.table-responsive').html(result);
                            dataTable = $("#announce").DataTable({
                                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                                responsive: true,
                            });
                            $('input#keyword').on('input', function(e){
                                var status = $(this).val();
                                dataTable.columns([2]).search(status).draw();
                            })
                            $('select#categoryFilter_1').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
                            })
                            $('select#categoryFilter_2').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([5]).search(status).draw();
                            })
                            new $.fn.dataTable.FixedHeader(dataTable);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        } 
                    });
                }else{
                    alert('order change failed');
                }
                

                
            }
        });
    }
    function move_order_down(id){
        var announcement = new FormData();  
        announcement.append( 'announcement_id', id);  
        announcement.append( 'order', 'down');  
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "update_announcement_order.php",
            data: announcement,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                // parse result
                console.log(result)
                if(result == 1){
                    $.ajax({
                        type: "GET",
                        url: 'announce_tbl.php',
                        success: function(result)
                        {
                            $('div.table-responsive').html(result);
                            dataTable = $("#announce").DataTable({
                                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                                responsive: true,
                            });
                            $('input#keyword').on('input', function(e){
                                var status = $(this).val();
                                dataTable.columns([2]).search(status).draw();
                            })
                            $('select#categoryFilter_1').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([3]).search(status).draw();
                            })
                            $('select#categoryFilter_2').on('change', function(e){
                            var status = $(this).val();
                            dataTable.columns([5]).search(status).draw();
                            })
                            new $.fn.dataTable.FixedHeader(dataTable);
                        },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        } 
                    });
                }else{
                    alert('order change failed');
                }
            }
        });
    }


    $('div[name="add_announcement"]').click(function (){
        var path_name= $(this).attr('id');
        const location_length = (window.location.pathname.split("/").length);
        var offset = 5;
        const location = (window.location.pathname.split("/"));
        var offset = 5;
        location[offset] = 'announcement'
        location[offset+1] = path_name
        var url_path = '';
        for (let index = 1; index < location.length; index++) {
            url_path+=('/'+location[index]);
            
        }
        if(window.location.href != window.location.origin+url_path){
            history.pushState({}, "", window.location.origin+url_path+'.php');
        }
        $.ajax({
            type: "GET",
            url: '../announcement/'+$(this).attr('id')+'.php',
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

