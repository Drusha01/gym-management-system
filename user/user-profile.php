<?php
// start session
session_start();

// includes
require_once '../tools/functions.php';
require_once '../classes/users.class.php';

if(isset($_SESSION['admin_id'])){
  header('location:../admin/admin_control_log_in.php');
}
// check if we are logged in
if(isset($_SESSION['user_id'])){
  // check if the user is active
  if($_SESSION['user_status_details'] =='active'){
    // check what type of user are we
    if($_SESSION['user_type_details'] =='admin'){
      // go to admin
    }else if($_SESSION['user_type_details'] == 'normal'){
      // do nothing
    } 
  }else if($_SESSION['user_status_details'] =='inactive'){
    // handle inactive user details
  }else if($_SESSION['user_status_details'] =='deleted'){
    // handle deleted user details
  }
} else {
  // go to login page
  header('location:../login/log-in.php');
}

?>

<?php require_once '../includes/header-user.php';?>
<body>
  <?php require_once '../includes/header.php';?>
    <!-- Modal -->

    <section class="my_acc">
        <div class="mt-6 custom-nav">
          <div class="container-fluid pb-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="true"  onclick="changeActiveTab('account-tab')">My Account</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab" aria-controls="notification" aria-selected="false"  onclick="changeActiveTab('notification-tab')">Notifications</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="Subscription-tab" data-bs-toggle="tab" data-bs-target="#Subscription" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('Subscription-tab')">My Subscriptions</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="lockers-tab" data-bs-toggle="tab" data-bs-target="#lockers" type="button" role="tab" aria-controls="contact" aria-selected="false" onclick="changeActiveTab('lockers-tab')">My Lockers</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainer-tab" data-bs-toggle="tab" data-bs-target="#trainer" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('trainer-tab')">My Trainers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="contact" aria-selected="false"  onclick="changeActiveTab('payment-tab')">Payment</button>
                  </li>
              </ul>
          </div>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                  <?php require_once 'user-acc.php'; ?>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab" onclick="changeActiveTab('notification-tab')">
                      <?php require_once 'user-notif.php'; ?>
                </div>
                <div class="tab-pane fade" id="Subscription" role="tabpanel" aria-labelledby="Subscription-tab" onclick="changeActiveTab('Subscription-tab')">
                    <div class="container-fluid p-3 " style="min-height: 450px;">
                        <?php require_once 'user_subscriptions.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="lockers" role="tabpanel" aria-labelledby="lockers-tab"  onclick="changeActiveTab('lockers-tab')">
                    <div class="container-fluid p-3 " style="min-height: 450px;">
                      <?php require_once 'user-locker.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab" onclick="changeActiveTab('trainer-tab')">
                    <div class="container-fluid p-3" style="min-height: 450px;">
                      <?php require_once 'user-trainer.php'; ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab" onclick="changeActiveTab('payment-tab')">
                    <div class="container-fluid p-3" style="min-height: 450px;">
                      <?php require_once 'user-payment.php'; ?>
                    </div>
                </div>
              </div>
            </div>
    </section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img class="img-fluid" src="<?php echo_safe('../img/valid-id/'.$_SESSION['user_valid_id_photo'])?>">

      </div>
    </div>
  </div>
</div>


<!-- Modal full payment -->
<div class="modal fade" id="hist-view-full" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Full Payment (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">1-Month Gym-Use</td>
                                <td class="text-end">₱800.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱800.00</td>
                                <td class="text-end">₱0.00</td>
                            </tr>

                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">2</td>
                                <td class="ps-3">1-Month Locker</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱100.00</td>
                                <td class="text-end">₱0.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱900.00</td>
                                <td class="text-end fw-bolder fs-5">₱0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal full partial -->
<div class="modal fade" id="hist-view-partial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Partial Payment (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">1-Month Gym-Use</td>
                                <td class="text-end">₱800.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱500.00</td>
                                <td class="text-end">₱300.00</td>
                            </tr>

                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">2</td>
                                <td class="ps-3">1-Month Locker</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱0.00</td>
                                <td class="text-end">₱100.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱500.00</td>
                                <td class="text-end fw-bolder fs-5">₱400.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal full void -->
<div class="modal fade" id="hist-view-void" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Void Payment (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">1-Month Gym-Use</td>
                                <td class="text-end">₱800.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱500.00</td>
                                <td class="text-end">₱300.00</td>
                            </tr>

                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">2</td>
                                <td class="ps-3">1-Month Locker</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱0.00</td>
                                <td class="text-end">₱100.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱400.00</td>
                                <td class="text-end fw-bolder fs-5">₱500.00</td>
                            </tr>
                        </tfoot>
                        <tfoot class="table-danger">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total Void Amount:</td>
                                <td class="text-end">---</td>
                                <td class="text-end">---</td>
                                <td class="text-end fw-bolder fs-5">₱100.00</td>
                                <td class="text-end fw-bolder fs-5">---</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal full walk -->
<div class="modal fade" id="hist-view-walk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Void Payment (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">Walk-In Gym-Use</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱100.00</td>
                                <td class="text-end">₱0.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-end fw-bolder fs-5">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal full walk with trainer-->
<div class="modal fade" id="hist-view-walk-trainer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Void Payment (March 26,2023)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
                        <thead class="table-secondary">
                            <tr>
                                <th class="d-lg-none"></th>
                                <th class="text-center">#</th>
                                <th class="ps-3">Payment Description</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Penalties Due</th>
                                <th class="text-center">Paid Amount</th>
                                <th class="text-center">Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">1</td>
                                <td class="ps-3">Walk-In Gym-Use</td>
                                <td class="text-end">₱100.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱100.00</td>
                                <td class="text-end">₱0.00</td>
                            </tr>
                            <tr>
                                <td class="d-lg-none"></td>
                                <td class="text-center">2</td>
                                <td class="ps-3">Walk-In Trainer</td>
                                <td class="text-end">₱250.00</td>
                                <td class="text-center">None</td>
                                <td class="text-center">None</td>
                                <td class="text-center">₱250.00</td>
                                <td class="text-end">₱0.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-success">
                            <tr>
                                <td class="d-lg-none"></td>
                                <td colspan="3" class="text-end fw-bolder fs-5 ">Total:</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱0.00</td>
                                <td class="text-end">₱250.00</td>
                                <td class="text-end fw-bolder fs-5">₱0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success">Show</button>
                    <button type="button" class="btn btn-outline-dark">Download</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once '../includes/footer.php';?>


</body>
</html>
<script>
    $.ajax({
        type: "GET",
        url: 'tbl/paid_hist_tbl.php',
        success: function(result)
        {
            $('div.tbl-hist-paid').html(result);
            dataTable = $("#hist-pay").DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                responsive: true,
            });
            $('input#keyword').on('input', function(e){
                var status = $(this).val();
                dataTable.columns([1]).search(status).draw();
            })
            $('select#categoryFilter').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([2]).search(status).draw();
            });
            $('select#categoryFilter_2').on('change', function(e){
            var status = $(this).val();
            dataTable.columns([4]).search(status).draw();
            })
            new $.fn.dataTable.FixedHeader(dataTable);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
        }
    });
</script>

<script>

// $(document).ready(function() {
//   $('.btn btn-success float-right').magnificPopup({type:'image'});
// });

// $(document).ready(function() {
//   $('#view-valid-id').magnificPopup({type:'image'});
// });

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