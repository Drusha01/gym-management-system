<table id="table-1" class="table table-striped table-borderless table-custom table-hover" style="width: 100%">
    <thead class="bg-dark text-light">
        <tr>
        <th class="d-lg-none"></th>
        <th class="text-center d-none d-sm-table-cell">#</th>
        <th>NAME</th>
        <th class="text-center ">AGE</th>
        <th class="text-center">SUBSCRIPTION STATUS</th>
        <th class="text-center">USER STATUS</th>
        <th class="text-center">ACTION</th>
        </tr>
    </thead>
    <tbody>


<select class="form-select-sm" aria-label="Default select example">
        <option value="1">Paid</option>
        <option value="2">Pending</option>
        <option value="3">Partial</option>
        <option value="4">Unpaid</option>
        <option value="5">Overdue</option>
    </select>
    <?php 
        // include
        require_once '../../classes/users.class.php';
        require_once '../../classes/user_status.class.php';
        require_once '../../tools/functions.php';

        $userObj =new users();
        $user_status = new user_status();
        if($user_status_data =$user_status->get_user_status()){
            if($users_data = $userObj->fetch_all_users()){
                //print_r($users_data)  ;
                $counter=1;
                foreach ($users_data as $key => $value) {
                    echo '<tr>';
                    echo '<th class="d-lg-none"></th>';
                    echo '<th class="text-center d-none d-sm-table-cell">';echo $counter;echo'</th>';
                    echo '<td><a href="acc_prof.php?user_id=';echo_safe($value['user_id']);echo'" class="text-decoration-none text-dark">';echo_safe($value['user_lastname'].', '.$value['user_firstname'].' '.$value['user_middlename']);echo'</a></td>';
                    echo '<td class="text-center ">'; echo_safe(getAge($value['user_birthdate']));'</td>';
                    echo '<td class="text-center">TO BE IMPLEMENTED</td>';
                    echo '<td class="text-center">';
                        echo '<select class="form-select-sm" aria-label="Default select example">';
                            foreach ($user_status_data as $key => $user_status_value) {
                                if($value['user_status_details'] == $user_status_value['user_status_details']){
                                    echo '<option value="';echo_safe($user_status_value['user_status_id']);echo'" selected>';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }else{
                                    echo '<option value="';echo_safe($user_status_value['user_status_id']);echo'">';echo_safe($user_status_value['user_status_details']);echo'</option>';
                                }
                                
                            }
                    echo'</td>';
                    echo '<td class="text-center"><a class="btn btn-primary btn-sm px-3" href="acc_prof.php?user_id=';echo_safe($value['user_id']);echo'">Edit</a> <button class="btn btn-danger btn-sm" onclick="confirmfunction(';echo $counter; echo')">Delete</button></td>';
                    echo '</tr>';
                    $counter++;
                    
                }
            }
        }
    ?>
    </tbody>
</table>
<script> 
function confirmfunction(id){
    let text = "Are you sure you want to delete #"+id+"?";
    if (confirm(text) == true) {
        $.ajax({url: "account-delete.php?id="+id, success: function(result){
            if(result ==1){
                // update datatables
                $( "#offer_id_"+id ).remove();
                alert('deleted successfully');
                console.log(result)
            }else{
                alert('deletion failed');
            }
        }});
    } else {
        return;
        text = "You canceled!";
    }
    
}
</script>



        <thead class="bg-dark text-light">
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">#</th>
            <th>NAME</th>
            <th class="text-center ">AGE</th>
            <th class="text-center">STATUS</th>
            <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">1</th>
            <td><a href="acc_prof.php" class="text-decoration-none text-dark">Trinidad, James Trinidad</a></td>
            <td class="text-center ">23</td>
            <td class="text-center">Subscribe</td>
            <td class="text-center"><a href="acc_prof_edit.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
            </tr>
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">2</th>
            <td>Nicholas, Shania Gabrielle</td>
            <td class="text-center ">23</td>
            <td class="text-center">Subscribe</td>
            <td class="text-center"><a href="acc_prof_edit.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
            </tr>
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">3</th>
            <td>Lim, Robbie John</td>
            <td class="text-center ">23</td>
            <td class="text-center">Not Availed</td>
            <td class="text-center"><a href="acc_prof_edit.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
            </tr>
            <tr>
            <th class="d-lg-none"></th>
            <th class="text-center d-none d-sm-table-cell">4</th>
            <td>Villanueva, Rob Roche</td>
            <td class="text-center ">23</td>
            <td class="text-center">Subscribe</td>
            <td class="text-center"><a href="acc_prof_edit.php" class="btn btn-primary btn-sm" role="button">Edit</a> <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button></td>
            </tr>
        </tbody>
    </table>

