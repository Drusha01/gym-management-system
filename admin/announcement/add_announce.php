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
        if($_SESSION['admin_announcement_restriction_details'] =='Modify'){
            // check post var and file var
            if(isset($_POST['add_announcement']) && isset($_POST['content'])&& isset($_POST['announcement_title']) && isset($_POST['announcement_type']) && 
            isset($_POST['status'])&& isset($_POST['start_date'])&& isset($_POST['end_date'])){
                require_once('../../classes/annoucements.class.php');
                $annoucementObj = new annoucements();
                $annoucement_title = trim($_POST['announcement_title']);
                $announcement_type_details = trim($_POST['announcement_type']);
                $announcement_status_details = trim($_POST['status']);
                $announcement_content = trim($_POST['content']);
                $announcement_start_date = $_POST['start_date'];
                $announcement_end_date = $_POST['end_date'];
                $announcement_file_image = '';
                
                $announcement_order = $annoucementObj->get_number_of_annoucements()['number_of_announcements'];

                if(isset($_FILES['announcement_image'])){
                    require_once '../../tools/functions.php';
                    $type = array('png', 'bmp', 'jpg');

                    $size = (1024 * 1024) * 5; // 2 mb
                    if (validate_file($_FILES, 'announcement_image', $type, $size)) {
                        
                        $announcement_file_dir = dirname(__DIR__,2) . '/img/announcement/';
                        $announcement_file_dir_original =$announcement_file_dir. 'original/';
                        $announcement_file_resized = $announcement_file_dir.'announcement-resized/';
                        
                        
                        if(!is_dir($announcement_file_dir)){
                            // create directory
                            mkdir($announcement_file_dir);
                        }
                        
                        // check if the folder exist  
                        if(!is_dir($announcement_file_dir_original)){
                            // create directory
                            mkdir($announcement_file_dir_original);
                        }
                        $extension = getFileExtensionfromFilename($_FILES['announcement_image']['name']);
                        $filename = md5($_FILES['announcement_image']['name']).'.'.$extension;
                        $counter = 0;
                        // only move if the filename is unique
                        while(file_exists($announcement_file_dir_original.$filename)){
                            $counter++;
                            $filename = md5($_FILES['announcement_image']['name'].$counter).'.'.$extension;
                        }
                        switch($extension){
                            case 'png':
                                $img = imagecreatefrompng($_FILES['announcement_image']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$announcement_file_dir_original.$filename,100);
                                break;
                            case 'bmp':
                                $img = imagecreatefrompng($_FILES['announcement_image']['tmp_name']);
                                // convert jpeg
                                imagejpeg($img,$announcement_file_dir_original.$filename,100);
                                break;
                            case 'jpg':
                                move_uploaded_file($_FILES['announcement_image']['tmp_name'], $announcement_file_dir_original.$filename);
                                break;
                        }
                        // check if the profile-resize folder exist
                        if(!is_dir($announcement_file_resized)){
                            // create directory
                            mkdir($announcement_file_resized);
                        }
                        // resize file
                    
                        // 
                        $result = resizeImage_2($announcement_file_dir_original,$announcement_file_resized,$filename,$filename,80,1920,1080);
                        if($result){
                            $announcement_file_image = $filename;
                        }else{
                            echo '0';
                            return;
                        }                        
                    }
                }
                // insert db here

                if($annoucementObj->insert($announcement_status_details,$announcement_type_details,$annoucement_title,$announcement_content,$announcement_file_image,$announcement_order,$announcement_start_date,$announcement_end_date)){
                    header('location:announcement.php');
                }
            }
        }else if($_SESSION['admin_announcement_restriction_details'] =='Read-Only'){
            header('location:announcement.php');
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



<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_admin.php';?>
<?php require_once '../includes/side_nav.php';?>

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Add Announcement</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="announcement.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row pb-2">
                <div class="col-sm-5">
                    <label class="pb-1" for="announcement_title">Title of Announcement</label>
                    <input type="text" class="form-control" value="" id="announcement_title" name="announcement_title" placeholder="Enter Title of Announcement" required>
                </div>
            </div>
            <div class="row pt-2">
                <label>Type of Announcement</label>
            </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="announcement_type" id="announcement_type_txt" value="Text" required>
                <label class="form-check-label" for="announcement_type_txt">Text</label>
                </div>
                <div class="form-check form-check-inline pb-2">
                <input class="form-check-input" type="radio" name="announcement_type" id="announcement_type_img" value="Image" required>
                <label class="form-check-label" for="announcement_type_img">Image</label>
                </div>
                <div class="row pb-2">
                    <div class="col-sm-5">
                    <label for="exampleFormControlTextarea1" class="form-label">Enter Content of Announcement</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3" required></textarea>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-5">
                    <label for="formFile" class="form-label">Enter Image</label>
                    <input class="form-control" type="file" id="announcement_image" name="announcement_image" accept="image/*" required>
                </div>
                </div>
                <div class="row form-group py-2">
                    <label for="daterange" class="pb-2">Start Date to End Date</label>
                    <div class="col-12 col-lg-5 pb-2 d-flex justify-content-end">
                        <div id="daterange" class="pull-right rounded" style="background: #fff; cursor: pointer; padding: 4px 10px; border: 1px solid #ccc; width:100%;">
                            <i class='bx bxs-calendar'></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                <label>Set Status</label>
                </div>

                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="Active" value="Active" required>
                <label class="form-check-label" for="Active">Active</label>
                </div>
                <div class="form-check form-check-inline pb-2">
                <input class="form-check-input" type="radio" name="status" id="Disabled" value="Disabled" required>
                <label class="form-check-label" for="Disabled">Disabled</label>
                </div>
                <div class="row d-flex flex-row-reverse">
                    <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                        <input type="submit" class="btn btn-success  border-0 rounded" name="add_announcement" value="Add Announcement" id="add_announcement" >
                    </div>
                </div>
            </div>
            <input type="date" name="start_date" id="start_date" style="visibility:hidden;">
            <input type="date" name="end_date" id="end_date" style="visibility:hidden;">
        </form>


  </div>
</main>
</body>
<script>
$(function() {

var start = moment().add(0, 'days');
var end = moment().add(0, 'days');

function cb(start, end) {
    $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    $('#start_date').val(start.format('YYYY-MM-DD'));
    $('#end_date').val(end.format('YYYY-MM-DD'));
    console.log(start.format('MMMM D, YYYY'));
    console.log(end.format('MMMM D, YYYY'));
}

$('#daterange').daterangepicker({
    startDate: moment().add(0, 'days'),
    endDate: moment().add(0, 'days'),
    minDate:  moment().add(0, 'days'),
    ranges: {
       'Today': [moment(), moment()],
       'One Day': [moment().add(0, 'days'), moment().add(1, 'days')],
       'One Week': [moment().add(0, 'days'), moment().add(7, 'days')],
       'One Month': [moment().add(0, 'days'), moment().add(1, 'month')],
       'Two Month': [moment().add(0, 'days'), moment().add(2, 'month')]
    }
}, cb);

cb(start, end);

});

</script>

</html>