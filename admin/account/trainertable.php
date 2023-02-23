<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width:100%;border: 3px solid black;">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>USERNAME</th>
        <th>NAME</th>
        <th class="text-center ">AGE</th>
        <th class="text-center">GENDER</th>
        <th class="text-center">TRAINER STATUS</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        require_once('../../classes/trainers.class.php');
        require_once('../../classes/trainer_availability.class.php');
        require_once('../../tools/functions.php');

        // trainer availability instance
        $trainer_availabilityObj = new trainer_availability();
        $trainer_availability_data = $trainer_availabilityObj->fetch_trainer_availability();

        // trainer instance
        $trainerObj = new trainers();

        // fetch
        $counter =1;
        if($trainers_data =$trainerObj->fetch_tainers()){
            foreach ($trainers_data as $key => $value) {
                echo
                '
                <tr>
                <th class="d-lg-none"></th>';
                echo '<th class="text-center d-none d-sm-table-cell">';echo  $counter; echo'</th>';
                echo '<td class="">'; echo_safe($value['user_name']);'</td>';
                echo '<td><a href="trainer-profile.php?trainer_id=';echo_safe($value['trainer_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_fullname']);echo'</a></td>';
                echo '<td class="text-center ">';echo_safe(getAge($value['user_birthdate']));echo '</td>';
                echo '<td class="text-center">';echo_safe($value['user_gender_details']);echo'</td>';
                echo '<td class="text-center">';
                echo '<select class="form-select-sm" aria-label="Default select example" name="trainer_availability">';
                    foreach ($trainer_availability_data as $key => $trainer_availability_value) {
                        if($trainer_availability_value['trainer_availability_details'] == $value['trainer_availability_details']){
                            echo '<option value="';echo_safe($trainer_availability_value['trainer_availability_details']);echo'" selected>';echo_safe($trainer_availability_value['trainer_availability_details']);echo'</option>';
                        }else{
                            echo '<option value="';echo_safe($trainer_availability_value['trainer_availability_details']);echo'">';echo_safe($trainer_availability_value['trainer_availability_details']);echo'</option>';
                        }
                        
                    }
                    
                echo "</select>";
                echo '</td>';
                echo '<td class="text-center"><a href="account-profile-edit.php?user_id=';echo_safe($value['user_id']);echo'&trainer=1" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
                </tr>';
                $counter++;
            }
        }


    ?>
        
    </tbody>
</table>
