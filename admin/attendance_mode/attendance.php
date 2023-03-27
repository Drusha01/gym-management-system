<?php require_once '../includes/header.php'; ?>

<body>
<?php require_once '../includes/top_nav_attendance.php'; ?>
<div class="container" style="margin-top: 7%;">
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <img src="../../images/logo.png" class="rounded me-2" alt="logo" style="width: 25px;">
            <strong class="me-auto">KE-NO Fitness Center</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            Succesfully Recorded.✅
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast toast_2" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <img src="../../images/logo.png" class="rounded me-2" alt="logo" style="width: 25px;">
            <strong class="me-auto">KE-NO Fitness Center</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            Succesfully Recorded.✅
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="row">
                <div class="col-6">
                    <h3>Attendance</h3>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <span class="fw-bolder fs-5">Date: <span id="dateDiv" class="fw-light fs-5"></span></span>
                </div>
            </div>
             <!-- Actual search box -->
             <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="search" id="keyword" class="form-control" placeholder="Search" data-lpignore="true">
            </div>

            <div class="table-responsive table-container px-2 mt-2 ">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="container ms-4">
                <div class="row">
                    <div class="col-lg-12">
                    <h3 class="ms-1">Announcements</h3>
                        <div class="owl-single dots-absolute owl-carousel">
                            <img src="../../images/home-0.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                            <img src="../../images/home-1.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                            <div class="card" style="width: 100%; height:282px;">
                              <div class="card-body">
                                <h5 class="card-title">No Gym Between these Dates</h5>
                                <hr>
                                <p class="card-text"><li>March 23, 2022</li></p>
                                <p class="card-text"><li>March 25, 2022</li></p>
                              </div>
                            </div>
                            <img src="../../images/home-3.jpg" alt="Free HTML Template by Untree.co" class="img-fluid rounded-3 w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for exit -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Exit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="username" placeholder="Enter Username" data-lpignore="true">
        <label for="username">Enter Username</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" id="pass" placeholder="Enter Password" data-lpignore="true">
        <label for="pass">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" class="btn btn-success" href="../admin_control_log_in.php">Confirm Exit</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal for confirm attendance time in -->
<div class="modal fade" id="attendance_time_in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Time In</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
        <div><h5 class="fw-bolder fs-5">Customer Name: <span class="fw-light fs-4">Dela, Juan Cruz</span></h5></div>
        <div class="form-floating">
        <input type="password" class="form-control" id="pass" placeholder="Enter Password" data-lpignore="true">
        <label for="pass">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="toastbtn">Confirm Time In</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for confirm attendance time Out -->
<div class="modal fade" id="attendance_time_out" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Time Out</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="form-floating mb-3">
        <div><h5 class="fw-bolder fs-5">Customer Name: <span class="fw-light fs-4">Dela, Juan Cruz</span></h5></div>
        <div class="form-floating">
        <input type="password" class="form-control" id="pass" placeholder="Enter Password" data-lpignore="true">
        <label for="pass">Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="toastbtn_2">Confirm Time Out</button>
      </div>
    </div>
  </div>
</div>






<!-- toast script -->
<script>
document.getElementById("toastbtn").onclick = function() {
  var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  toastList.forEach(toast => toast.show())
}

document.getElementById("toastbtn_2").onclick = function() {
  var toastElList = [].slice.call(document.querySelectorAll('.toast_2'))
  var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  toastList.forEach(toast => toast.show())
}
</script>







<!-- data table script -->
<script>
    $.ajax({
        type: "GET",
        url: 'attendance_tbl.php',
        success: function(result)
        {
            $('div.table-responsive').html(result);
            dataTable = $("#attendance").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
                order: [[0, 'asc']]
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([0]).search(status).draw();
            })
            new $.fn.dataTable.FixedHeader(dataTable);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        } 
    });
</script>

<!-- time script -->
<script>
    function showDate()
    {
    var now = new Date();
    var days = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
    var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
    function fourdigits(number)
    {
    return (number < 1000) ? number + 1900 : number;
    }
    tnow=new Date();
    thour=now.getHours();
    tmin=now.getMinutes();
    tsec=now.getSeconds();
    if (tmin<=9) { tmin="0"+tmin; }
    if (tsec<=9) { tsec="0"+tsec; }
    if (thour<10) { thour="0"+thour; }
    today = days[now.getDay()] + ", " + date + " " + months[now.getMonth()] + ", " + (fourdigits(now.getYear())) ;
    document.getElementById("dateDiv").innerHTML = today;
    }
    setInterval("showDate()", 1000);
</script>

<script>
  $('#attendance_time_out').appendTo("body") 
</script>


<script src="../../js/owl.carousel.min.js"></script>
<script src="../../js/aos.js"></script>
<script src="../../js/custom.js"></script>
</body>
</html>