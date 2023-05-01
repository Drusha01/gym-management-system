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
                    </tr>';
                            }
                        }
                    
                    ?>
                   
                </tbody>
            </table>
        </div>
    </div>
    
</div>
</div>