<?php 
session_start();
if(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Modify'){

}elseif(isset($_SESSION['admin_account_restriction_details']) && $_SESSION['admin_account_restriction_details'] == 'Read-Only'){
    //d
}else{
    //do not load the page
    header('HTTP/1.1 404 Not Found');
    exit();
}
?>

<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width: 100%">
        <thead class="bg-dark text-light">
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">#</th>
            <th>USERNAME</th>
            <th>NAME</th>
            <th class="text-center ">AGE</th>
            <th class="text-center ">GENDER</th>
            <th class="text-center">SUBSCRIPTION STATUS</th>
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
        if($trainers_data = $trainerObj->fetch_non_trainers()){
            foreach ($trainers_data as $key => $value) {
                echo '<tr>';
                echo '<th class="d-lg-none"></th>';
                echo '<th class="text-center d-none d-sm-table-cell">';echo $counter;echo '</th>';
                echo '<td class="" id=row_user_id_';echo_safe($value['user_id']);echo'>'; echo_safe($value['user_name']);'</td>';
                echo '<td><a href="account-profile.php?user_id=';echo_safe($value['user_id']);echo'"  class="text-decoration-none text-dark">';echo_safe($value['user_fullname']);echo'</a></td>';
                echo '<td class="text-center ">'; echo_safe(getAge($value['user_birthdate']));'</td>';
                echo '<td class="text-center ">';echo_safe($value['user_gender_details']);echo '</td>';
                echo '<td class="text-center">TO BE IMPLEMENTED</td>';
                echo '<td class="text-center"> <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal" onclick="createModal(\'';echo_safe($value['user_fullname']);echo'\',';echo_safe($value['user_id']);echo',';echo $counter;echo')">Add</button></td>';
                echo '</tr>';
                $counter++;
            }
        }


        ?>
            
        </tbody>
    </table>
