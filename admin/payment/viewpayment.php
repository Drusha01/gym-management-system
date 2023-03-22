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
    if(isset($_GET['user_id'])&& isset($_GET['name'])){
      require_once('../../classes/subscriptions.class.php');
      $subscriptionsObj = new subscriptions();
      

      if(!$payments_data = $subscriptionsObj->fetch_active_subs_payment($_GET['user_id'])){
        header('location:payment.php');
      }
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
            <h5 class="col-7 col-lg-4 fw-bold mb-3 ms-2">View Payment</h5>
            <a class="col text-decoration-none text-black m-0" aria-current="page" href="payment.php"><span class='bx bxs-left-arrow align-middle fs-5'></span>Go Back</a>
        </div>
            <div class="container-fluid">
                <div class="row pb-2">
                    <div class="col-12 col-lg-10">
                        <h5 class="fw-bold "><?php echo $_GET['name'];?></h5>
                    </div>
                    <div class="col-lg-1 d-none d-lg-flex justify-content-end">
                        <div class="btn-group dropstart">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Save As
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="min-width:30px;">
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">Word <i class='bx bxs-file-doc fs-5'></i></button></li>
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">PDF <i class='bx bxs-file-pdf fs-5' ></i></button></li>
                            <li><button class="dropdown-item d-flex align-items-center justify-content-end" type="button">Print <i class='bx bx-printer fs-5' ></i></button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1 d-grid d-lg-flex justify-content-lg-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmpayment" id="confirm_payment_modal">Confirm Payment</button>
                    </div>
                </div>
                
              <div class="table-responsive table-1">
                <table id="table-1" class="table table-striped table-bordered " style="width:100%;border: 2px solid grey;">
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
                      <?php 
                      $counter=1;
                      $total_balance = 0;
                      $total_amount=0;
                      $total_penalty_due=0;
                      $total_discount =0;
                      $total_paid_amount=0;
                      foreach ($payments_data as $key => $value) {
                          $amount = ($value['subscription_price']*$value['subscription_quantity']*($value['subscription_total_duration']/$value['subscription_duration']))+$value['subscription_penalty_due'];
                          $total_amount+=$amount;
                          $total_paid_amount+=$value['subscription_paid_amount'];
                          if($value['subscription_discount']<=0){
                              $subscription_discount = '<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add_discount" onclick="discount_modal('.htmlentities($value['subscription_id']).')">Add Discount</button>';
                          }else{
                            $total_discount+=$value['subscription_discount'];
                            $subscription_discount = '<button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#edit_discount"><i class="bx bx-edit align-middle" onclick="editdiscount_modal('.htmlentities($value['subscription_id']).')"></i></button>₱'.htmlentities(number_format($value['subscription_discount'],2));
                          }
                          if($value['subscription_penalty_due']<=0){
                              $subscription_penalty_due = 'None';
                          }else{
                            $subscription_penalty_due =htmlentities('₱'.$value['subscription_penalty_due']);
                            $total_penalty_due+=$value['subscription_penalty_due'];
                          }
                          echo ' 
                            <tr>
                              <td class="d-lg-none"></td>
                              <td class="text-center">'.$counter.'</td>
                              <td class="ps-3">'.htmlentities($value['subscription_offer_name']).'</td>
                              <td class="text-end">₱'.htmlentities(number_format($amount,2)).'</td>
                              <td class="text-center">'.$subscription_discount.'</td>
                              <td class="text-end">'.$subscription_penalty_due.'</td>
                              <td class="text-end">₱'.htmlentities(number_format($value['subscription_paid_amount'],2)).'</td>
                              <td class="text-end">₱'.htmlentities(number_format(($amount+$value['subscription_penalty_due']-$value['subscription_discount']-$value['subscription_paid_amount']),2)).'</td>
                            </tr>';

                          $counter++;
                        }
                      
                      ?>
                    </tbody>
                    <tfoot class="table-success">
                        <tr>
                            <td class="d-lg-none"></td>
                            <td colspan="2" class="text-end fw-bolder fs-5 ">Total:</td>
                            <td class="text-end">₱<?php echo htmlentities(number_format($total_amount,2));?></td>
                            <td class="text-end">₱<?php echo htmlentities(number_format($total_discount,2));?></td>
                            <td class="text-end">₱<?php echo htmlentities(number_format($total_penalty_due,2));?></td>
                            <td class="text-end">₱<?php echo htmlentities(number_format($total_paid_amount,2));?></td>
                            <td class="text-end fw-bolder fs-5">₱<?php echo htmlentities(number_format($total_amount-$total_discount+$total_penalty_due - $total_paid_amount,2));?></td>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
            <div class="container">
                <p class="fw-bolder fs-5">Partial Payment</p>
                <hr>
                <div class="row">
                    <div class="col-6 col-lg-1 d-flex align-items-center">
                        <label for="partialfixed" class="text-nowrap pe-3">Partial Fixed</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center">
                        <input type="number" class="form-control" id="partialfixed" placeholder="₱00.00">
                    </div>
                    <div class="col-6 col-lg-1 d-flex align-items-center pt-3 pt-lg-0">
                        <label for="partialpercent" class=" pe-3">Partial Percentage</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                        <input type="number" class="form-control" id="partialpercent" placeholder="00%">
                    </div>
                    
                    <div class="col-12 col-lg-2 d-grid d-lg-inline pt-3 pt-lg-1">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmpartial">Confirm</button>
                    </div>
                </div>
            </div>
            <div class="container pt-3">
                <p class="fw-bolder fs-5">Void Payment</p>
                <hr>
                <div class="row">
                    <div class="col-6 col-lg-1 d-flex align-items-center">
                        <label for="voidfixed" class="text-nowrap pe-3">Void Fixed</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center">
                        <input type="number" class="form-control" id="voidfixed" placeholder="₱00.00">
                    </div>
                    <div class="col-6 col-lg-1 d-flex align-items-center pt-3 pt-lg-0">
                        <label for="voidpercent" class=" pe-3">Void Percentage</label>
                    </div>
                    <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                        <input type="number" class="form-control" id="voidpercent" placeholder="00%">
                    </div>
                    
                    <div class="col-12 col-lg-2 d-grid d-lg-inline pt-3 pt-lg-1">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmvoid">Confirm</button>
                    </div>
                </div>
            </div>
    </div>
</main>

<div class="modal fade" id="confirmpartial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Partial Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: Drusha01
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmvoid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Void Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: Drusha01
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-success" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="confirmpayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Full Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        User: <?php echo htmlentities($_SESSION['admin_user_name'])?>
        <br>
        <div class="form-group pt-1">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" name ="admin_user_password"id="admin_user_password" value="">
            <input type="number" class="form-control" name="customer_user_id" id="customer_user_id" value="<?php echo $_GET['user_id'];?>" style="visibility:hidden;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="confirm_payment" data-bs-dismiss="modal" >Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="add_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-6 col-lg-2 d-flex align-items-center">
                    <label for="fixeddisc" class="pe-3">Fixed</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center">
                    <input type="number" class="form-control" id="fixeddisc" placeholder="₱00.00" min="0" >
                </div>
                <div class="col-6 col-lg-2 d-flex align-items-center pt-3 pt-lg-0">
                    <label for="fixedpercent" class=" pe-3">Percent</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                    <input type="number" class="form-control" id="fixedpercent" placeholder="00%" min="0">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="discount_confirm" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Discount</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row d-flex justify-content-center">
                <div class="col-6 col-lg-2 d-flex align-items-center">
                    <label for="fixeddisc" class="pe-3">Fixed</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center">
                    <input type="number" class="form-control" id="editfixeddisc" placeholder="₱00.00">
                </div>
                <div class="col-6 col-lg-2 d-flex align-items-center pt-3 pt-lg-0">
                    <label for="fixedpercent" class=" pe-3">Percent</label>
                </div>
                <div class="col-6 col-lg-3 d-flex align-items-center pt-3 pt-lg-0">
                    <input type="number" class="form-control" id="editfixedpercent" placeholder="00%">
                </div>
            </div>
            <div class="d-flex">
              <hr class="my-auto flex-grow-1">
              <div class="px-4">or</div>
              <hr class="my-auto flex-grow-1">
            </div>
            <div class="text-center ">
                <button type="button" class="btn btn-danger" id="remove_discount" data-bs-dismiss="modal">Remove Discount <i class='bx bx-minus-circle fs-5' style="vertical-align: middle;"></i></button>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="edit_discount_confirm" data-bs-dismiss="modal">Confirm</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script>
function discount_modal(subscription_id){ 
  $('#discount_confirm').attr('onclick','sub_discount('+subscription_id+')');
  $('#fixedpercent').val('')
  $('#fixeddisc').val('')
}

function editdiscount_modal(subscription_id){
  $('#edit_discount_confirm').attr('onclick','edit_discount('+subscription_id+')');
  $('#remove_discount').attr('onclick','remove_discount('+subscription_id+')');
  $('#editfixedpercent').val('')
  $('#editfixeddisc').val('')
}

function remove_discount(subscription_id){
  $.ajax({url: 'payment_discount.php?subscription_id='+subscription_id+'&type=remove'+'&discount=0', 
      success: function(result){
        console.log(result);
        if(result ==1){
          location.reload();
        }else{
          alert('error removing discount')
        }
      }
    });
}

function edit_discount(subscription_id){
  var type = null;
  var discount =0;
  if($('#editfixedpercent').val()>0){
    type = 'fixedpercent';
    discount =$('#editfixedpercent').val();
  }else if($('#editfixeddisc').val()>0){
    type ="fixeddisc";
    discount =$('#editfixeddisc').val();
  }else{
    alert('invalid didscount');
  }

  if(type!=null){
    $.ajax({url: 'payment_discount.php?subscription_id='+subscription_id+'&type='+type+'&discount='+discount, 
      success: function(result){
        console.log(result);
        if(result ==1){
          location.reload();
        }else{
          alert('error editing discount')
        }
      }
    });
  }
}

function sub_discount(subscription_id){
  console.log(subscription_id)
  var type = null;
  var discount =0;
  if($('#fixedpercent').val()>0){
    type = 'fixedpercent';
    discount =$('#fixedpercent').val();
  }else if($('#fixeddisc').val()>0){
    type ="fixeddisc";
    discount =$('#fixeddisc').val();
  }else{
    alert('invalid discount');
  }

  if(type!=null){
    $.ajax({url: 'payment_discount.php?subscription_id='+subscription_id+'&type='+type+'&discount='+discount, 
      success: function(result){
        console.log(result);
        if(result ==1){
          location.reload();
        }else{
          alert('error adding discount')
        }
      }
    });
  }
}

$('#fixeddisc').change(function (){
  $('#fixedpercent').val('')
});

$('#fixedpercent').change(function (){
  $('#fixeddisc').val('')
});

$('#editfixeddisc').change(function (){
  $('#editfixedpercent').val('')
});

$('#editfixedpercent').change(function (){
  $('#editfixeddisc').val('')
});

$('#confirm_payment_modal').click(function (){
  $('#admin_user_password').val('');
  console.log('notnice');
});

$('#confirm_payment').click(function (){
  console.log($('#admin_user_password').val());
  $.post("full_payment.php",
  {
    password: $('#admin_user_password').val(),
    user_id: $('#customer_user_id').val()
  },
  function(data, status){
    if(data ==1){
      location.reload();
    }else{
      alert('Wrong password / Error');
    }
  });
});
</script>