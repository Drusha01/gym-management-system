<div class="container-fluid" style="min-height: 450px;">
<h5 class="col-12 fw-bold">To Train</h5>
    <div class="form-group col-12 col-sm-4 table-filter-option">
        <label for="keyword" class="ps-2 pb-2">Search</label>
        <input type="text" name="keyword" id="keyword" placeholder="Enter Trainer Name Here" class="form-control ms-md-2">
    </div>
    <div class="container-fluid my-3">
        <div class="shadow rounded-3  table-responsive ">
            <table id="#" class="table align-middle mb-0 bg-white">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th class="col-12 col-lg-4 ps-0 ps-lg-5">NAME OF TRAINER</th>
                    <th class="text-center">AGE</th>
                    <th class="text-center">GENDER</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        session_start();
                        require_once '../tools/functions.php';
                        require_once('../classes/subscriber_trainers.class.php');
                        $subscriber_trainersObj = new subscriber_trainers();
                        if($trainees_data = $subscriber_trainersObj->fetch_to_train_list($_SESSION['user_id'])){
                            foreach ($trainees_data as $key => $value) {
                    echo '
                    <tr>
                    <th class="d-lg-none"></th>
                    <td class="col-12 col-lg-4 ps-0 ps-lg-5">
                        <div class="d-flex align-items-center">
                        <img
                            src="../img/profile/'.htmlentities($value['user_profile_picture']).'"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                        <div class="ms-3">
                            <p class="fw-bold mb-1"><a href="trainer-cust-prof.html" class=" text-decoration-none text-dark">'.htmlentities($value['user_fullname']).'</a></p>
                        </div>
                        </div>
                    </td>
                    <td class="text-center">'.htmlentities(getAge($value['user_birthdate'])).'</td>
                    <td class="text-center">'.htmlentities($value['user_gender_details']).'</td>
                    <td class="text-center"><span class="badge bg-success rounded-pill">Active</span></td>
                    <td class="text-center"><button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#viewNoteTrainer">View Note</button></td>
                    </tr>';
                            }
                        }
                    
                    ?>
                   
                </tbody>
            </table>
        </div>
    </div>
<!-- Modal View Note For Trainer -->
<div class="modal fade" id="viewNoteTrainer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Note By: <span>Villanueva, Rob Roche Silay</span></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <h6>Added Note At: <span class="fw-light">May 5, 2023</span></h6>
       <h6 class="fw-normal mt-3">Cardio and lightweight lng sana po</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>