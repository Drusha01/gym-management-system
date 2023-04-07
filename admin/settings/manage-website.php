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
   <style>
    /* The heart of the matter */
    .testimonial-group > .row {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
    }
    .testimonial-group > .row > .col-lg-4 {
    display: inline-block;
    }
   </style>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
    <div class="w-100">
        <div class="row">
            <h5 class="col-7 col-lg-4 fw-bold mb-3">Manage Website</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="settings.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>

        <!-- start of carousel -->
        <div class="row">
            <div class="col-lg-9">
                <h5 class="fw-regular">Carousel Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_carousel" id="add_carousel_modal"> Add Carousel</button>
            </div>
        </div>
        <hr>

        
        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2" id="carousel_container">
                <?php 
                    require_once('../../classes/landing_page.class.php');
                    $landing_pageObj = new landing_page();

                    if($carousel_data = $landing_pageObj->fetch_all_by_type('Carousel')){
                        foreach ($carousel_data as $key => $value) {
                            echo '
                        <div class="col-12 col-lg-4 " id="content_'.htmlentities($value['landing_page_id']).'">
                            <div class="card container-fluid py-2 shadow-sm">
                                <label for="input_1">Title</label>
                                <input type="text" class="form-control" value="'.htmlentities($value['landing_page_title']).'" id="title_'.htmlentities($value['landing_page_id']).'">
                                <div class="py-1 text-center">
                                    <img src="../../img/carousel/carousel-resized/'.htmlentities($value['landing_page_file']).'" class="img-fluid img-thumbnail" id="image_src'.htmlentities($value['landing_page_id']).'"style="max-height: 207px;">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Change Image</label>
                                    <input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'.htmlentities($value['landing_page_id']).'" required>
                                </div>
                                <div class="d-flex justify-content-lg-end">
                                    <button class="btn btn-success btn-sm me-1" onclick="function_save('.htmlentities($value['landing_page_id']).',\''.htmlentities($value['landing_page_type_details']).'\')">Save</button>
                                    <button class="btn btn-danger btn-sm" onclick="function_delete('.htmlentities($value['landing_page_id']).')" >Delete</button>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                    //else{
                    //     echo 'No data';
                    // }
                ?>
                <script>
                    function function_delete(id){
                        var carousel = new FormData();
                        carousel.append('landing_page_id',id);
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "delete_landing_page.php",
                            data: carousel,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function ( result ) {
                                console.log( result );
                                // if success get the file name and append new child in the list
                                if(result ==1){
                                    $("#content_"+id).remove();
                                }else{
                                    alert('error deleting');
                                }
                            }
                        });
                        
                        
                    }


                    function function_save(id,landing_page_type_details){
                        var carousel = new FormData();    
                        if($('#title_'+id).val().length<=0){
                            alert('Please add title');
                        }else{
                            console.log($('#title_'+id).val());
                            carousel.append('title',$('#title_'+id).val());
                            carousel.append('landing_page_id',id);
                        }
                        if($('#image_'+id).val().length>0 ){
                            if(($('#image_'+id)[0].files[0].size/1024)>20 && ($('#image_'+id)[0].files[0].size/1024)<5000){
                                carousel.append( 'file', $('#image_'+id)[0].files[0] );
                            }else{
                                $('#carousel_modal_image').val('');
                            }
                        }

                        // ajax post method here
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "update_landing_page.php",
                            data: carousel,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function ( result ) {
                                console.log( result );
                                // if success get the file name and append new child in the list

                                alert('successfully saved');
                                // parse result
                                var obj =JSON.parse(result)
                                if(obj.landing_page_type_details == 'Carousel'){
                                    $('#image_'+id).val('')
                                    $('#image_src'+id).attr('src','../../img/carousel/carousel-resized/'+obj.landing_page_file)
                                }else if(obj.landing_page_type_details == 'Weights Room'){
                                    $('#image_'+id).val('')
                                    $('#image_src'+id).attr('src','../../img/Weights/Weights-resized/'+obj.landing_page_file)
                                }else if(obj.landing_page_type_details == 'Function Room'){
                                    $('#image_'+id).val('')
                                    $('#image_src'+id).attr('src','../../img/Function/Function-resized/'+obj.landing_page_file)
                                }
                                
                            }
                        });
                    }
                </script>
                </div>
            </div>
        </div>
        <!-- end of carousel -->

        <!-- start of weights room -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Weights Room Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_weights" id="add_weights_modal"> Add Picture</button>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2" id="weights_container">
                <?php 
                    require_once('../../classes/landing_page.class.php');
                    $landing_pageObj = new landing_page();

                    if($carousel_data = $landing_pageObj->fetch_all_by_type('Weights Room')){
                        foreach ($carousel_data as $key => $value) {
                            echo '
                        <div class="col-12 col-lg-4 " id="content_'.htmlentities($value['landing_page_id']).'">
                            <div class="card container-fluid py-2 shadow-sm">
                                <label for="input_1">Title</label>
                                <input type="text" class="form-control" value="'.htmlentities($value['landing_page_title']).'" id="title_'.htmlentities($value['landing_page_id']).'">
                                <div class="py-1 text-center">
                                    <img src="../../img/Weights/Weights-resized/'.htmlentities($value['landing_page_file']).'" class="img-fluid img-thumbnail" id="image_src'.htmlentities($value['landing_page_id']).'"style="max-height: 207px;">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Change Image</label>
                                    <input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'.htmlentities($value['landing_page_id']).'" required>
                                </div>
                                <div class="d-flex justify-content-lg-end">
                                    <button class="btn btn-success btn-sm me-1" onclick="function_save('.htmlentities($value['landing_page_id']).')">Save</button>
                                    <button class="btn btn-danger btn-sm" onclick="function_delete('.htmlentities($value['landing_page_id']).')" >Delete</button>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- end of weights room -->

        <!-- start of function room -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Function Room Landing Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_func" id="add_func_modal"> Add Picture</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2" id="Function_container">
                <?php 
                    require_once('../../classes/landing_page.class.php');
                    $landing_pageObj = new landing_page();

                    if($carousel_data = $landing_pageObj->fetch_all_by_type('Function Room')){
                        foreach ($carousel_data as $key => $value) {
                            echo '
                        <div class="col-12 col-lg-4 " id="content_'.htmlentities($value['landing_page_id']).'">
                            <div class="card container-fluid py-2 shadow-sm">
                                <label for="input_1">Title</label>
                                <input type="text" class="form-control" value="'.htmlentities($value['landing_page_title']).'" id="title_'.htmlentities($value['landing_page_id']).'">
                                <div class="py-1 text-center">
                                    <img src="../../img/Function/Function-resized/'.htmlentities($value['landing_page_file']).'" class="img-fluid img-thumbnail" id="image_src'.htmlentities($value['landing_page_id']).'"style="max-height: 207px;">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Change Image</label>
                                    <input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'.htmlentities($value['landing_page_id']).'" required>
                                </div>
                                <div class="d-flex justify-content-lg-end">
                                    <button class="btn btn-success btn-sm me-1" onclick="function_save('.htmlentities($value['landing_page_id']).',\''.htmlentities($value['landing_page_type_details']).'\')">Save</button>
                                    <button class="btn btn-danger btn-sm" onclick="function_delete('.htmlentities($value['landing_page_id']).')" >Delete</button>
                                </div>
                            </div>
                        </div>';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- end of function room -->

        <!-- start of Our Team -->
        <div class="row mt-4">
            <div class="col-lg-9">
                <h5 class="fw-regular">Our Team About Page</h5>
            </div>
            <div class="col-lg-3 d-grid d-lg-flex justify-content-lg-end">
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic_team" id="add_team_member">Add Person</button>
            </div>
        </div>
        <hr>

        <div class="container">
            <div class="container testimonial-group pb-1">
                <div class="row g-2" id="team_container">
                <?php 
                    require_once('../../classes/teams.class.php');
                    $teamsObj = new teams();

                    if($teams_data = $teamsObj->fetch_all()){
                        foreach ($teams_data as $key => $value) {
                            echo '
                            <div class="col-12 col-lg-4" id="team_'.htmlentities($value['team_id']).'">
                                <div class="card container-fluid py-2 shadow-sm">
                                    <label for="input_1">Name</label>
                                    <input type="text" class="form-control" value="'.htmlentities($value['team_name']).'" id="team_name_'.htmlentities($value['team_id']).'">
                                    <label for="input_1">Position</label>
                                    <input type="text" class="form-control" value="'.htmlentities($value['team_position_details']).'" id="team_detail_'.htmlentities($value['team_id']).'">
                                    <div class="py-1 text-center">
                                        <img src="../../img/team/team-resized/'.htmlentities($value['team_file']).'" class="img-fluid img-thumbnail" style="max-height: 207px;" id="team_image_'.htmlentities($value['team_id']).'">
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileSm" class="form-label">Change Image</label>
                                        <input class="form-control form-control-sm" type="file" accept="image/*" id="team_image_2_'.htmlentities($value['team_id']).'">
                                    </div>
                                    <div class="d-flex justify-content-lg-end">
                                        <button class="btn btn-success btn-sm me-1" onclick="save_team('.htmlentities($value['team_id']).')">Save</button>
                                        <button class="btn btn-danger btn-sm" onclick="delete_team('.htmlentities($value['team_id']).')">Delete</button>
                                    </div>
                                </div>
                            </div>
                       ';
                        }
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function delete_team(id){
        var team = new FormData();  
        team.append( 'team_id', id); 
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "delete_team_member.php",
            data: team,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function ( result ) {
                console.log( result );
                if(result ==1 ){
                    $("#team_"+id).remove();
                    alert('Deleted successfully');
                }else{
                    alert('Deletion failed');
                }
            }
        });
    }

    function save_team(id){
        var team = new FormData();  
        team.append( 'team_id', id); 
        if($('#team_name_'+id).val().length>0){
            if($('#team_detail_'+id).val().length>0){
                // check image
                team.append('team_name',$('#team_name_'+id).val());
                team.append('position',$('#team_detail_'+id).val());
                if($('#team_image_2_'+id).val().length>0 ){
                    if(($('#team_image_2_'+id)[0].files[0].size/1024)>20 && ($('#team_image_2_'+id)[0].files[0].size/1024)<5000){ 
                        team.append( 'file', $('#team_image_2_'+id)[0].files[0] );
                    }else{
                        alert('invalid image size');
                        $('#function_modal_image').val('');
                    }
                }
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "update_team_member.php",
                    data: team,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function ( result ) {
                        // console.log( result );
                        var obj =JSON.parse(result)
                        
                        alert('Team successfully updated');
                        $('#team_name_'+id).val(obj.team_name);
                        $('#team_detail_'+id).val(obj.team_position_details);
                        $('#team_image_'+id).attr('src','../../img/team/team-resized/'+obj.team_file);
                        $('#team_image_2_'+id).val('');
                        // parse result

                        
                    }
                });
            }else{
                alert('please input team position');
            }
        }else{
            alert('please input team name');
        }

        
    }
</script>



<!-- Modal Carousel -->
<div class="modal fade" id="add_carousel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Carousel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters" id="carousel_modal_title" required>

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Add Image</label>
            <input class="form-control form-control-sm"  type="file" accept="image/*" id="carousel_modal_image" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success"  id="carousel_modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="carousel_modal_close">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

    $('#add_carousel_modal').click(function(){
        $('#carousel_modal_title').val('');
        $('#carousel_modal_image').val('');
        $('#carousel_modal').attr('data-bs-dismiss','');
    });
    $('#carousel_modal').click(function(){
        // check title
        if($('#carousel_modal_title').val().length<=0){
            alert('Please add title');
        }else{
            // check picture
            // read the picture
            // at least 20kb and less than 5mb
            if($('#carousel_modal_image').val().length>0 ){
                if(($('#carousel_modal_image')[0].files[0].size/1024)>20 && ($('#carousel_modal_image')[0].files[0].size/1024)<5000){
                    var carousel = new FormData();    
                    carousel.append( 'file', $('#carousel_modal_image')[0].files[0] );
                    // 
                    console.log($('#carousel_modal_image')[0].files[0].size/1024);
                    console.log($('#carousel_modal_image')[0].files[0].size);
                    carousel.append('title',$('#carousel_modal_title').val());
                    carousel.append('type','Carousel');

                    

                    // close the modal
                    
                        // ajax post method here
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "add_landing_page.php",
                        data: carousel,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function ( result ) {
                            console.log( result );
                            var obj =JSON.parse(result)
                            $('#carousel_container').append('<div class="col-12 col-lg-4 " id="content_'+obj.landing_page_id+'"><div class="card container-fluid py-2 shadow-sm"><label for="input_1">Title</label><input type="text" class="form-control" value="'+obj.landing_page_title+'" id="title_'+obj.landing_page_id+'"><div class="py-1 text-center"><img src="../../img/carousel/carousel-resized/'+obj.landing_page_file+'" class="img-fluid img-thumbnail" style="max-height: 207px;" id="image_src'+obj.landing_page_id+'"></div><div class="mb-3"><label for="formFileSm" class="form-label">Change Image</label><input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'+obj.landing_page_id+'" required> </div><div class="d-flex justify-content-lg-end"><button class="btn btn-success btn-sm me-1" onclick="function_save('+obj.landing_page_id+')">Save</button><button class="btn btn-danger btn-sm" onclick="function_delete('+obj.landing_page_id+')" >Delete</button></div></div></div>');
                            $('#carousel_modal_close').trigger('click');
                            alert('successfully added');
                            
                            // parse result

                            // if success get the file name and append new child in the list
                            
                        }
                    });
                }else{
                    alert('invalid image size');
                    $('#carousel_modal_image').val('');
                }
                

                
            }else{
                alert('Please attach an image');
            }
        }
        
        
    });
    
</script>

<!-- Modal Weights -->
<div class="modal fade" id="add_pic_weights" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Picture for Weight Room</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters" id="weights_modal_title" required>

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Add Image</label>
            <input class="form-control form-control-sm"  type="file" accept="image/*" id="weights_modal_image" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-success" id="weights_modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="weights_modal_close">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

    $('#add_weights_modal').click(function(){
        $('#weights_modal_title').val('');
        $('#weights_modal_image').val('');
    });
    $('#weights_modal').click(function(){
        // check title
        if($('#weights_modal_title').val().length<=0){
            alert('Please add title');
        }else{
            // check picture
            // read the picture
            // at least 20kb and less than 5mb
            if($('#weights_modal_image').val().length>0 ){
                if(($('#weights_modal_image')[0].files[0].size/1024)>20 && ($('#weights_modal_image')[0].files[0].size/1024)<5000){
                    var carousel = new FormData();    
                    carousel.append( 'file', $('#weights_modal_image')[0].files[0] );
                    // 
                    console.log($('#weights_modal_image')[0].files[0].size/1024);
                    console.log($('#weights_modal_image')[0].files[0].size);
                    carousel.append('title',$('#weights_modal_title').val());
                    carousel.append('type','Weights Room');

                    

                    // close the modal
                    
                        // ajax post method here
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "add_landing_page.php",
                        data: carousel,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function ( result ) {
                            console.log( result );
                            alert('successfully added');
                            
                            // parse result

                            // if success get the file name and append new child in the list
                            var obj =JSON.parse(result)
                            $('#weights_container').append('<div class="col-12 col-lg-4 " id="content_'+obj.landing_page_id+'"><div class="card container-fluid py-2 shadow-sm"><label for="input_1">Title</label><input type="text" class="form-control" value="'+obj.landing_page_title+'" id="title_'+obj.landing_page_id+'"><div class="py-1 text-center"><img src="../../img/Weights/Weights-resized/'+obj.landing_page_file+'" class="img-fluid img-thumbnail" style="max-height: 207px;" id="image_src'+obj.landing_page_id+'"></div><div class="mb-3"><label for="formFileSm" class="form-label">Change Image</label><input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'+obj.landing_page_id+'" required> </div><div class="d-flex justify-content-lg-end"><button class="btn btn-success btn-sm me-1" onclick="function_save('+obj.landing_page_id+')">Save</button><button class="btn btn-danger btn-sm" onclick="function_delete('+obj.landing_page_id+')" >Delete</button></div></div></div>');
                           
                            $('#weights_modal_close').trigger('click');
                        }
                    });
                }else{
                    alert('invalid image size');
                    $('#weights_modal_image').val('');
                }
                

                
            }else{
                alert('Please attach an image');
            }
        }
        
        
    });
    
</script>

<!-- Modal Function -->
<div class="modal fade" id="add_pic_func" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Picture for Function Room</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Title</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters" id="function_modal_title" required>

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Add Image</label>
            <input class="form-control form-control-sm"  type="file" accept="image/*" id="function_modal_image" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-success" id="function_modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="function_modal_close">Close</button>
      </div>
    </div>
  </div>
</div>



<script>

    $('#add_func_modal').click(function(){
        $('#function_modal_title').val('');
        $('#function_modal_image').val('');
    });
    $('#function_modal').click(function(){
        // check title
        if($('#function_modal_title').val().length<=0){
            alert('Please add title');
        }else{
            // check picture
            // read the picture
            // at least 20kb and less than 5mb
            if($('#function_modal_image').val().length>0 ){
                if(($('#function_modal_image')[0].files[0].size/1024)>20 && ($('#function_modal_image')[0].files[0].size/1024)<5000){
                    var carousel = new FormData();    
                    carousel.append( 'file', $('#function_modal_image')[0].files[0] );
                    // 
                    console.log($('#function_modal_image')[0].files[0].size/1024);
                    console.log($('#function_modal_image')[0].files[0].size);
                    carousel.append('title',$('#function_modal_title').val());
                    carousel.append('type','Function Room');

                    

                    // close the modal
                    
                        // ajax post method here
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "add_landing_page.php",
                        data: carousel,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function ( result ) {
                            console.log( result );
                            var obj =JSON.parse(result)
                            $('#Function_container').append('<div class="col-12 col-lg-4 " id="content_'+obj.landing_page_id+'"><div class="card container-fluid py-2 shadow-sm"><label for="input_1">Title</label><input type="text" class="form-control" value="'+obj.landing_page_title+'" id="title_'+obj.landing_page_id+'"><div class="py-1 text-center"><img src="../../img/Function/Function-resized/'+obj.landing_page_file+'" class="img-fluid img-thumbnail" style="max-height: 207px;" id="image_src'+obj.landing_page_id+'"></div><div class="mb-3"><label for="formFileSm" class="form-label">Change Image</label><input class="form-control form-control-sm"  type="file" accept="image/*" id="image_'+obj.landing_page_id+'" required> </div><div class="d-flex justify-content-lg-end"><button class="btn btn-success btn-sm me-1" onclick="function_save('+obj.landing_page_id+')">Save</button><button class="btn btn-danger btn-sm" onclick="function_delete('+obj.landing_page_id+')" >Delete</button></div></div></div>');
                            $('#function_modal_close').trigger('click');
                            alert('function room added');
                            
                            // parse result

                            // if success get the file name and append new child in the list
                            
                        }
                    });
                }else{
                    alert('invalid image size');
                    $('#function_modal_image').val('');
                }
                

                
            }else{
                alert('Please attach an image');
            }
        }
        
        
    });
    
</script>


<!-- Modal team -->
<div class="modal fade" id="add_pic_team" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Person for Our Team</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="input_1">Name</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters" id="team_modal_name" required>
        <label for="input_1">Position</label>
        <input type="text" class="form-control" placeholder="Max 20 Characters" id="team_modal_position" required> 

        <div class="mb-3 mt-2">
            <label for="formFileSm" class="form-label">Change Image</label>
            <input class="form-control form-control-sm"  type="file" accept="image/*" id="team_modal_image">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="team_modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="team_modal_close">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

    $('#add_team_member').click(function(){
        $('#team_modal_name').val('');
        $('#team_modal_position').val('');
        $('#team_modal_image').val('');
    });
    $('#team_modal').click(function(){
        // check title
        if($('#team_modal_name').val().length<=0){
            alert('Please input name');
        }else{
            if($('#team_modal_position').val().length<=0){
                alert('Please input position');
            }else{
                // check picture
                // read the picture
                // at least 20kb and less than 5mb
                if($('#team_modal_image').val().length>0 ){
                    if(($('#team_modal_image')[0].files[0].size/1024)>20 && ($('#team_modal_image')[0].files[0].size/1024)<5000){
                        var team = new FormData();    
                        team.append( 'file', $('#team_modal_image')[0].files[0] );
                        // 
                        console.log($('#team_modal_image')[0].files[0].size/1024);
                        console.log($('#team_modal_image')[0].files[0].size);
                        team.append('team_name',$('#team_modal_name').val());
                        team.append('position',$('#team_modal_position').val());

                        

                        // close the modal
                        
                            // ajax post method here
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "add_team_member.php",
                            data: team,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function ( result ) {
                                console.log( result );
                                var obj =JSON.parse(result)
                                
                                alert('TEAM added');
                                
                                // parse result

                                // if success get the file name and append new child in the list
                                $('#team_container').append('<div class="col-12 col-lg-4" id="team_'+obj.team_id+'"><div class="card container-fluid py-2 shadow-sm"><label for="input_1">Name</label><input type="text" class="form-control" value="'+obj.team_name+'" id="team_name_'+obj.team_id+'"><label for="input_1">Position</label><input type="text" class="form-control" value="'+obj.team_position_details+'" id="team_detail_'+obj.team_id+'"><div class="py-1 text-center"><img src="../../img/team/team-resized/'+obj.team_file+'" class="img-fluid img-thumbnail" style="max-height: 207px;" id="team_image_'+obj.team_id+'"></div><div class="mb-3"><label for="formFileSm" class="form-label">Change Image</label><input class="form-control form-control-sm" type="file" accept="image/*" id="team_image_2_'+obj.team_id+'"></div><div class="d-flex justify-content-lg-end"><button class="btn btn-success btn-sm me-1" onclick="save_team('+obj.team_id+')">Save</button><button class="btn btn-danger btn-sm" onclick="delete_team('+obj.team_id+')">Delete</button></div></div></div>');
                                $('#team_modal_close').trigger('click');
                            }
                        });
                    }else{
                        alert('invalid image size');
                        $('#function_modal_image').val('');
                    }
                }else{
                    alert('Please attach an image');
                }
            }
        }
    });
    
</script>
</body>

</html>