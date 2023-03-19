<div class="container-fluid card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-group rounded">
                <label for="search" class="pb-2 ms-1">Search</label>
                <br>
                <input type="search" id="form1" class="form-control" />
                <select class="form-select" aria-label="Default select example" name='users' id="users" onchange="users_selected_change()">
                        <option value="None" selected>Select User </option>
                        <?php 
                        require_once('../../classes/users.class.php');

                        $userObj = new users();
                        
                        if($users_data = $userObj->fetch_all_users(0,100000)){
                            foreach ($users_data as $key => $value) {
                                # code...
                                echo '<option value="'.$value['user_id'].'" >'.$value['user_fullname'].' </option>';
                            }

                        }
                        ?>
                    </select>
                    
                
                </div>
            </div>
            <div class="col-6 col-lg-1 d-flex align-items-end mb-1 pt-3">
                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalProf"><i class='bx bx-question-mark'></i></button>
            </div>
            <div class="col-6 col-lg-5 d-flex align-items-end mb-1">
                <div class="form-group rounded">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="Gym-Use" name="Gym-Use"  onchange="gym_use_changed()">
                        <label class="form-check-label" for="Gym-Use">
                            Gym-Use
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="form-group rounded">
                <label for="search" class="pb-2 ms-1">Trainer</label>
                    <select class="form-select" aria-label="Default select example" name='trainers' id="trainers" onchange="trainer_selected_change()">
                        <option value="None" selected>Select Trainer </option>
                        <?php 
                        require_once('../../classes/trainers.class.php');

                        $trainerObj = new trainers();
                        
                        if($trainers_data = $trainerObj->fetch_available_trainers()){
                            foreach ($trainers_data as $key => $value) {
                                # code...
                                echo '<option value="'.htmlentities($value['trainer_id']).'" >'.htmlentities($value['user_fullname']).' </option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6 col-lg-1 d-flex align-items-end mb-1 pt-3">
                <button type="button" class="btn btn-dark btn-sm btn-circle" data-bs-toggle="modal" data-bs-target="#ModalTrainer"><i class='bx bx-question-mark'></i></button>
            </div>
            <div class="col-6 col-lg-5 d-flex align-items-end mb-1">
                <div class="form-group rounded">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="Trainer" name="Trainer" onchange="trainer_check_change()">
                        <label class="form-check-label" for="Trainer">
                            Trainer
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-3 pt-lg-0">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-success me-md-2" type="button" id="walk_in" onclick="walk_in_avail()">Avail</button>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                <strong class="me-auto">Avail Walk-In</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Succesfully Availed Walk-In <i class='bx bxs-check-square fs-3 align-bottom' style="color:green;" ></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container">
    <div class="row g-2 mb-2 mt-1">
        <div class="col-12 col-lg-2 align-bottom ">
            <p class="fw-bold fs-5">Recent Walk-In </p>
        </div>
        <div class="form-group col-12 col-sm-5 table-filter-option">
            <label for="keyword">Search</label>
            <input type="text" name="keyword" id="keyword-2" placeholder="Enter Name Here" class="form-control ms-md-2">
        </div>
        <div class="col-12 col-sm-3 d-grid d-lg-inline-flex justify-content-lg-end form-group h-50">
            <a href="walk-in_more.php" class="btn btn-success" role="button">More Details</a>
        </div>
        <div class="table-responsive table-2">
            <table class="table table-striped table-borderless table-custom" style="width:100%;border: 3px solid black;">
                <thead class="bg-dark text-light">
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="col" class="text-center d-none d-sm-table-cell">#</th>
                    <th>NAME</th>
                    <th class="text-center ">AVAILED SERVICE</th>
                    <th scope="col" class="text-center">DATE AVAILED</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">1</th>
                    <td>Trinidad, James Trinidad</td>
                    <td class="text-center ">Gym-Use</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">2</th>
                    <td>Nicholas, Shania Gabrielle</td>
                    <td class="text-center ">Gym-Use</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                    <tr>
                    <th class="d-lg-none"></th>
                    <th scope="row" class="text-center d-none d-sm-table-cell">3</th>
                    <td>Lim, Robbie John</td>
                    <td class="text-center ">Gym-Use/Trainer</td>
                    <td class="text-center">October 16, 2022</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var user_id;
    var trainer_id;
    function trainer_selected_change(){
        if($('#trainers').val() != 'None'){
            // check
            $('#Trainer').prop('checked', true);
            trainer_id = $('#trainers').val();
        }else{
            $('#Trainer').prop('checked', false);
        }
    }
    function users_selected_change(){
        if($('#users').val() != 'None'){
            // check
            $('#Gym-Use').prop('checked', true);
            user_id =$('#users').val();
           
        }else{
            $('#Gym-Use').prop('checked', false);
        }
    }
    function gym_use_changed(){
        if($('#Gym-Use').prop('checked')){
            alert('please select customer');
            $('#Gym-Use').prop('checked',!$('#Gym-Use').prop('checked') );
        }else{
            user_id = null;
            $('#users').val('None')
        }
        
        console.log(check)
    }
    function trainer_check_change(){
        if($('Trainer').prop('checked')){
            alert('please select customer');
            $('#Trainer').prop('checked',!$('#Gym-Use').prop('checked') );
        }else{
            trainer_id = null;
            $('#trainers').val('None')
        }
    }
    function walk_in_avail(){
        console.log(user_id);
        console.log(trainer_id);
        $('#liveToast').toast('show')

        // ajax here 

        // if result is successful show the  toast

        // else if the ajax failed or it didnt proceed as usual, it
    }


</script>

