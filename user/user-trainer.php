<div class="container-fluid p-3" style="min-height: 450px;">
    <div class="container-sub">
        <div class="row g-2 mb-2">
            <?php 
            session_start();
            require_once '../tools/functions.php';
            require_once '../classes/subscriber_trainers.class.php';
            require_once '../classes/subscriptions.class.php';
            $subscriber_trainersObj = new subscriber_trainers();

            if($trainers_data = $subscriber_trainersObj->fetch_trainers($_SESSION['user_id'])){
                echo '
            <h5 class="col-12 fw-bold">Availed Trainers</h5>
            <div class="form-group col-12 col-sm-4 table-filter-option">
                <label for="keyword" class="ps-2 pb-2">Search</label>
                <input type="text" name="keyword" id="keyword" placeholder="Enter Trainer Name Here" class="form-control ms-md-2">
            </div>
            <div class="container my-3">
                <div class="shadow rounded-3  table-responsive ">
                    <table id="#" class="table align-middle mb-0 bg-white">
                        <thead class="bg-dark text-light">
                            <tr>
                            <th class="d-lg-none"></th>
                            <th class="col-12 col-lg-4 ps-0 ps-lg-5">NAME OF TRAINER</th>
                            <th class="text-center">AGE</th>
                            <th class="text-center">GENDER</th>
                            <th class="text-center">END OF SUBSCRIPTION</th>
                            <th class="text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($trainers_data as $key => $value) {
                            echo ' <tr>
                            <th class="d-lg-none"></th>
                            <td class="col-12 col-lg-4 ps-0 ps-lg-5">
                                <div class="d-flex align-items-center">
                                <img
                                    src="../img/profile-resize/'.$value['user_profile_picture'].'"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                    />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1"><a href="user-trainer-profile.php" class=" text-decoration-none text-dark">'.htmlentities($value['user_fullname']).'</a></p>
                                </div>
                                </div>
                            </td>
                                <td class="text-center">'.htmlentities(getAge($value['user_birthdate'])).'</td>
                                <td class="text-center">'.htmlentities($value['user_gender_details']).'</td>
                                <td class="text-center">October 14, 2022</td>
                                <td class="text-center"><span class="badge bg-success rounded-pill">'.htmlentities($value['trainer_availability_details']).'</span></td>
                            </tr>';
                        }

                        echo '
                        </tbody>
                    </table>
                </div>
            </div>
                ';
            }else{
                echo '
            <div class="pt-2">
                <h5>Availed Trainer Subscription Go Here.</h5>
                <div class="form-group col-12 pt-3 ">
                    <a class="btn btn-success" role="button" href="user-avail.php">Avail Now</a>
                </div>
            </div>
            ';
            }
            
            
            ?>
        
        </div>
    </div>
</div>


