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

<main class="col-md-9 ms-sm-auto col-lg-9 col-xl-10 p-3 p-md-4">
  <div class="w-100">
        <div class="row">
            <h5 class="col-8 col-lg-4 fw-bold mb-3">Add Announcement</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="announcement.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
        <div class="container">
        <div class="row pb-2">
            <div class="col-sm-5">
                <label class="pb-1" for="name_announce">Title of Announcement</label>
                <input type="text" class="form-control" value="" id="name_announce" name="" placeholder="Enter Title of Announcement" required>
            </div>
        </div>
        <div class="row pt-2">
            <label>Type of Announcement</label>
        </div>

            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Text</label>
            </div>
            <div class="form-check form-check-inline pb-2">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Image</label>
            </div>
            <div class="row pb-2">
                <div class="col-sm-5">
                <label for="exampleFormControlTextarea1" class="form-label">Enter Content of Announcement</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-5">
                <label for="formFile" class="form-label">Enter Image</label>
                <input class="form-control" type="file" id="formFile">
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
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Active</label>
            </div>
            <div class="form-check form-check-inline pb-2">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Disabled</label>
            </div>
            <div class="row d-flex flex-row-reverse">
                <div class="col-12 col-lg-8 d-grid d-lg-flex pt-3 pt-lg-1">
                    <button type="submit" class="btn btn-success  border-0 rounded" name="add_offer" value="add_offer" id="submit" >Add Announcement</button>
                </div>
            </div>
        </div>


  </div>
</main>
</body>
<script>
$(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#daterange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

cb(start, end);

});

</script>

</html>