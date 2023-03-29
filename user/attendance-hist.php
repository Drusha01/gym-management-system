<?php require_once '../includes/header-user.php';?>

<body>
<?php require_once '../includes/header.php';?>
<div class="container-fluid p-3 user-trainer-prof ps-4 pe-5" style="min-height: 500px;">
    <div class="row">
        <h5 class="col-8 col-lg-4 fw-bold pb-4">Attendance Profile</h5>
        <a class="col text-decoration-none text-black m-0" aria-current="page" href="user-profile.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a> 
    </div>
    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                <img src="../images/acc_img.png" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                    <h4>James_No_Legday</h4>
                    <p class="text-dark fw-bold mb-1">Status: <span class="text-secondary fw-normal">Active</span></p>
                    <p class="text-muted font-size-sm">San Jose, Zamboanga City</p>
                </div>
                </div>
            </div>
            </div>
        </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label>Minimum Date</label>
                                <input type="text" id="min" name="min" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label>Maximum Date</label>
                                <input type="text" id="max" name="max" class="form-control">
                            </div>
                        </div>
                        <div class="table-responsive table-container">
                            <table id="example" class="table  table-striped table-borderless" style="width:100%;border: 3px solid black;">
                                <thead class="bg-dark text-light">
                                    <tr>
                                    <th class="d-lg-none"></th>
                                    <th>#</th>
                                    <th>DATE</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td class="d-lg-none"></td>
                                    <td>1</td>
                                    <td>2023-03-25</td>
                                    <td>3:00 PM</td>
                                    <td>4:30 PM</td>
                                    </tr>
                                    <tr>
                                    <td class="d-lg-none"></td>
                                    <td>2</td>
                                    <td>2023-03-29</td>
                                    <td>3:00 PM</td>
                                    <td>4:30 PM</td>
                                    </tr>
                                    <tr>
                                    <td class="d-lg-none"></td>
                                    <td>3</td>
                                    <td>2023-03-30</td>
                                    <td>3:00 PM</td>
                                    <td>4:30 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
<?php require_once '../includes/footer.php';?>
<script>
var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[2] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#example').DataTable({
        "dom": '<"top"f>rt<"bottom"lp><"clear">',
        responsive: true
     });
     
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
     });
 });
</script>
</html>